<?php
require_once 'php/db_connection.php';



$id_cuenta = $_POST['id_cuenta'];
$nombre_cuenta = $_POST['nombre_cuenta'];
$token_acceso = $_POST['token_acceso'];
// ... otros campos según sea necesario

$query = "UPDATE CuentasSpotify SET nombre_cuenta='$nombre_cuenta', token_acceso='$token_acceso' WHERE id_cuenta=$id_cuenta";
if ($conn->query($query) === TRUE) {
    echo "Cuenta actualizada exitosamente";
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}

$conn->close();
?>
