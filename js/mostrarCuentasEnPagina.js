SpotifyAccountManager.prototype.agregarCuenta = function(cuenta) {
    // Enviar la cuenta al backend para agregar a la base de datos
    fetch('/php/add_cuenta.php', {
        method: 'POST',
        body: JSON.stringify(cuenta),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.text())
    .then(response => {
        console.log(response);

        // Si la cuenta se agregó correctamente, actualizar la interfaz de usuario
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
    })
    .catch(error => console.error('Error:', error));
};
