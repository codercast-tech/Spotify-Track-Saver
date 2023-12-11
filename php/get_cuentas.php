<?php
require_once 'php/db_connection.php';

$query = "SELECT * FROM CuentasSpotify";
$result = $conn->query($query);

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);

$conn->close();
?>
