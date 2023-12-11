SpotifyAccountManager.prototype.actualizarContador = function() {
    fetch('/php/get_total_cuentas.php')
    .then(response => response.json())
    .then(data => {
        const contadorCuentas = document.getElementById("contadorCuentas");
        contadorCuentas.textContent = data.totalCuentas;
    })
    .catch(error => console.error('Error:', error));
};
