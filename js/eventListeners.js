
// Función para buscar artistas en tiempo real
document.getElementById("buscarArtista").addEventListener("input", (event) => {
    const consulta = event.target.value.toLowerCase();
    const resultadosBusqueda = document.getElementById("resultadosBusqueda");
    resultadosBusqueda.innerHTML = "";

    const artistas = [
        "Artista 1",
        "Artista 2",
        "Artista 3",
        // Agrega más artistas aquí
    ];

    artistas.forEach((artista) => {
        if (artista.toLowerCase().includes(consulta)) {
            const listItem = document.createElement("li");
            listItem.textContent = artista;

            // Agregar un botón para agregar el artista seleccionado
            const agregarButton = document.createElement("button");
            agregarButton.textContent = "Agregar";
            agregarButton.classList.add("btn", "btn-primary", "btn-sm");
            agregarButton.addEventListener("click", () => {
                agregarArtistaSeleccionado(artista);
            });

            listItem.appendChild(agregarButton);
            resultadosBusqueda.appendChild(listItem);
        }
    });
});

// Función para agregar artistas seleccionados a la lista
function agregarArtistaSeleccionado(artista) {
    const listaArtistasSeleccionados = document.getElementById("listaArtistasSeleccionados");
    const listItem = document.createElement("li");
    listItem.textContent = artista;
    listaArtistasSeleccionados.appendChild(listItem);
}
