SpotifyAccountManager.prototype.buscarCuentas = function(consulta) {
    fetch('/php/buscar_cuentas.php', {
        method: 'POST',
        body: JSON.stringify({ consulta: consulta }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(cuentasFiltradas => {
        // Aquí podrías llamar a métodos para actualizar la interfaz de usuario
        // Por ejemplo, mostrar estas cuentas en la página y actualizar el contador
        this.mostrarCuentasEnPagina(cuentasFiltradas);
        this.actualizarContador(cuentasFiltradas.length);
    })
    .catch(error => console.error('Error:', error));
};
