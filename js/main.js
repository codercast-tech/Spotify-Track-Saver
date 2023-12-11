SpotifyAccountManager.prototype.buscarArtistasEnVentanaEmergente = function(consulta) {
    const resultadosArtistas = document.getElementById("resultadosArtistas");
    resultadosArtistas.innerHTML = "";

    // Simulación de búsqueda de artistas
    const artistasSimulados = ["Artista 1", "Artista 2", "Artista 3", "Artista 4", "Artista 5"];
    const artistasFiltrados = artistasSimulados.filter(artista =>
        artista.toLowerCase().includes(consulta.toLowerCase())
    );

    artistasFiltrados.forEach(artista => {
        const resultadoArtista = document.createElement("div");
        resultadoArtista.textContent = artista;
        resultadosArtistas.appendChild(resultadoArtista);
    });
};
