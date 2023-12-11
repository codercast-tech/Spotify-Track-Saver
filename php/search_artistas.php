<?php
require_once 'php/db_connection.php';



$nombre_artista = $_POST['nombre_artista'];

$query = "SELECT * FROM Artistas WHERE nombre_artista LIKE '%$nombre_artista%'";
$result = $conn->query($query);

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);

$conn->close();
?>
