<?php
$servername = "localhost";
$username = "codercast";
$password = "eJ6nSH@rPcfNZ!)R";
$dbname = "Spotify_DB";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
