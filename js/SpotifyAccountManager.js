SpotifyAccountManager.prototype.agregarCuenta = function(cuenta) {
    // Validar datos antes de enviarlos al servidor
    if (!cuentaValida(cuenta)) {
        console.error('Error: Datos de cuenta no válidos');
        // Mostrar mensaje de error en la interfaz de usuario
        return;
    }

    // Enviar la cuenta al backend de manera segura a través de HTTPS
    fetch('/php/add_cuenta.php', {
        method: 'POST',
        body: JSON.stringify(cuenta),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.text())
    .then(response => {
        // Manejar la respuesta del backend
        if (response.includes("exitosamente")) {
            const listaCuentas = document.getElementById("listaCuentas");
            const listItem = document.createElement("li");
            listItem.className = "list-group-item d-flex justify-content-between align-items-center";
            listItem.innerHTML = `
                <div>
                    <strong>${cuenta.nombre} (${cuenta.usuario}):</strong><br>
                    <a href="${cuenta.enlace}" target="_blank">Enlace</a><br>
                    Últimos Likes: ${cuenta.ultimosLikes.join(", ")}<br>
                    Número de Followers: ${cuenta.numFollowers}
                </div>
                <div>
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#manejarCuentaModal">Manejar Cuenta</button>
                </div>
            `;
            listaCuentas.appendChild(listItem);
            this.cuentasAgregadas++;
        } else {
            console.error('Error al agregar la cuenta:', response);
            // Mostrar mensaje de error en la interfaz de usuario
        }
    })
    .catch(error => {
        console.error('Error en la comunicación con el servidor:', error);
        // Mostrar mensaje de error en la interfaz de usuario
    });
};

function cuentaValida(cuenta) {
    // Realizar validación de datos aquí según tus requisitos específicos
    // Por ejemplo, verifica campos requeridos, formatos, longitudes, etc.
    // Devolver true si la cuenta es válida, de lo contrario, false
    // Esto ayuda a prevenir inyecciones de datos maliciosos y asegura que los datos sean seguros
    if (!cuenta.nombre || !cuenta.usuario || !cuenta.enlace || !cuenta.ultimosLikes || cuenta.ultimosLikes.length === 0 || cuenta.numFollowers === undefined) {
        return false;
    }

    // Agrega más validaciones según tus necesidades aquí

    return true;
}
