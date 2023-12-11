<?php
require_once 'php/db_connection.php';



$data = json_decode(file_get_contents('php://input'), true);
$consulta = $data['consulta'];

$query = "SELECT * FROM CuentasSpotify WHERE nombre_cuenta LIKE CONCAT('%', ?, '%')";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $consulta);
$stmt->execute();

$result = $stmt->get_result();
$cuentas = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($cuentas);

$stmt->close();
$conn->close();
?>
