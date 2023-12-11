<?php
require_once 'php/db_connection.php';



$query = "SELECT COUNT(*) AS total FROM CuentasSpotify";
$result = $conn->query($query);

if ($result) {
    $row = $result->fetch_assoc();
    echo json_encode(['totalCuentas' => $row['total']]);
} else {
    echo json_encode(['totalCuentas' => 0, 'error' => $conn->error]);
}

$conn->close();
?>
