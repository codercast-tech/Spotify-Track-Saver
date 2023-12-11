<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$servername = "localhost";
$username = "codercast";
$password = "eJ6nSH@rPcfNZ!)R";
$dbname = "Spotify_DB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM CuentasSpotify");

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SBG - Lista de Cuentas Spotify</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<div class="container">
    <h1 class="text-center">Lista de Cuentas Spotify</h1>

    <!-- Botón para iniciar sesión con Spotify -->
    <div class="text-center mt-4">
        <button class="btn btn-spotify" id="loginButton">Loguearse con Spotify</button>
    </div>

    <div>
        <h2>Cuentas Agregadas</h2>
        <ul id="listaCuentas" class="list-group">
            <?php 
            while ($row = $result->fetch_assoc()) {
                echo "<li class='list-group-item'>" . htmlspecialchars($row['username']) . "</li>";
            }
            ?>
        </ul>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="js/SpotifyAccountManager.js"></script>
<script src="js/eventListeners.js"></script>
<script src="js/agregarCuenta.js"></script>
<script src="js/mostrarCuentasEnPagina.js"></script>
<script src="js/buscarCuentas.js"></script>
<script src="js/actualizarContador.js"></script>
<script src="js/buscarArtistasEnVentanaEmergente.js"></script>

<script>
    document.getElementById("loginButton").addEventListener("click", function() {
        const authUrl = "https://accounts.spotify.com/authorize";
        const clientId = "be9174517f6e4f26963d3dc3eb95bc00"; // Reemplaza con tu Client ID de Spotify
        const redirectUri = "https://spotifytest:8890/callback"; // Reemplaza con tu URI de redirección

        const scope = "user-read-private user-read-email";
        const state = Math.random().toString(36).substring(7);

        sessionStorage.setItem("spotify_auth_state", state);

        const authParams = new URLSearchParams({
            client_id: clientId,
            response_type: "code",
            redirect_uri: redirectUri,
            scope: scope,
            state: state,
        });

        window.location.href = `${authUrl}?${authParams}`;
    });
</script>

</body>
</html>
