<?php
require_once 'php/db_connection.php';



$id_cuenta = $_POST['id_cuenta'];

$query = "DELETE FROM CuentasSpotify WHERE id_cuenta=$id_cuenta";
if ($conn->query($query) === TRUE) {
    echo "Cuenta eliminada exitosamente";
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}

$conn->close();
?>
