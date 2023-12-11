SpotifyAccountManager.prototype.agregarCuenta = function(cuenta) {
    // Validación básica de los datos de la cuenta
    if (!cuenta.nombre || !cuenta.usuario || !cuenta.enlace || !Array.isArray(cuenta.ultimosLikes) || typeof cuenta.numFollowers !== 'number') {
        console.error('Datos de cuenta inválidos');
        return; // Detener la ejecución si los datos son inválidos
    }

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
};
