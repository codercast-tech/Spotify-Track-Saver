<?php
require_once 'php/db_connection.php';

// Decodificar JSON recibido desde el frontend
$data = json_decode(file_get_contents('php://input'), true);

// Validar y sanear datos
$nombre_cuenta = isset($data['nombre_cuenta']) ? filter_var($data['nombre_cuenta'], FILTER_SANITIZE_STRING) : null;
$token_acceso = isset($data['token_acceso']) ? filter_var($data['token_acceso'], FILTER_SANITIZE_STRING) : null;
// ... Continúa con el saneamiento para otros campos según sea necesario

// Verificar si los datos necesarios están presentes
if (empty($nombre_cuenta) || empty($token_acceso)) {
    http_response_code(400); // Código de respuesta HTTP para indicar una solicitud incorrecta
    echo "Error: Datos incompletos.";
    exit;
}

// Preparar la declaración SQL para evitar inyecciones SQL
$stmt = $conn->prepare("INSERT INTO CuentasSpotify (nombre_cuenta, token_acceso) VALUES (?, ?)");
$stmt->bind_param("ss", $nombre_cuenta, $token_acceso); // 'ss' indica que ambos parámetros son strings

// Ejecutar la declaración y verificar el resultado
if ($stmt->execute()) {
    echo "Cuenta nueva creada exitosamente";
} else {
    http_response_code(500); // Código de respuesta HTTP para indicar un error interno del servidor
    echo "Error al crear la cuenta: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
