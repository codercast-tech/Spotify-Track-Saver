class SpotifyAccountManager {
    // ... constructor y otros métodos

    mostrarArtistasEnVentanaEmergente(consulta) {
        // ... código anterior

        // Actualizar para utilizar addEventListener
        artistasFiltrados.forEach(artista => {
            const fila = document.createElement("tr");
            const nombreArtista = artista.split('(')[0].trim();
            fila.innerHTML = `<td>${nombreArtista}</td><td><button class="btn btn-primary btn-sm">Agregar</button></td>`;
            fila.querySelector('button').addEventListener('click', () => this.agregarArtista(nombreArtista));
            tablaArtistasProgramados.appendChild(fila);
        });
    }

    agregarArtista(nombreArtista) {
        // ... implementación de agregarArtista
    }

    eliminarArtista(nombreArtista) {
        // ... implementación de eliminarArtista
    }
}

// Instancia y manejo de eventos
const manager = new SpotifyAccountManager();
document.getElementById("inputBusquedaModal").addEventListener("input", (event) => {
    const consulta = event.target.value;
    manager.mostrarArtistasEnVentanaEmergente(consulta);
});
