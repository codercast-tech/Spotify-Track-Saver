<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once 'config.php';

$servername = "localhost";
$username = "codercast";
$password = "eJ6nSH@rPcfNZ!)R";
$dbname = "Spotify_DB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$client_id = $config['client_id'];
$client_secret = $config['client_secret'];
$redirect_uri = $config['redirect_uri'];

if (isset($_GET['code'])) {
    $code = $_GET['code'];

    $accessToken = exchangeCodeForAccessToken($code, $client_id, $client_secret, $redirect_uri);

    if ($accessToken) {
        $userData = getUserDataFromSpotify($accessToken);

        if ($userData) {
            $id_usuario = $userData->id;
            $nombre_cuenta = $userData->display_name;
            $correo_electronico = $userData->email;
            $pais = $userData->country;

            // Aquí puedes agregar tu lógica para procesar los datos del usuario
            // y realizar inserciones en tu base de datos si es necesario
            // ...

        } else {
            echo "Error: No se pudieron obtener los datos del usuario de Spotify.";
        }
    } else {
        echo "Error: No se pudo obtener el token de acceso.";
    }
}

$conn->close();

// Redirección comentada para ver los mensajes de error
header('Location: /index.php');
exit;

function exchangeCodeForAccessToken($code, $client_id, $client_secret, $redirect_uri) {
    $url = 'https://accounts.spotify.com/api/token';
    $authorization = base64_encode("$client_id:$client_secret");

    $data = array(
        'grant_type' => 'authorization_code',
        'code' => $code,
        'redirect_uri' => $redirect_uri
    );

    $options = array(
        'http' => array(
            'header' => "Content-type: application/x-www-form-urlencoded\r\nAuthorization: Basic $authorization",
            'method' => 'POST',
            'content' => http_build_query($data)
        )
    );

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    if ($response === FALSE) {
        if (isset($http_response_header)) {
            echo "Error al obtener el token: " . $http_response_header[0];
        } else {
            echo "Error al obtener el token: No se pudo conectar con el servidor de Spotify.";
        }
        return null;
    }

    $response_data = json_decode($response);
    return $response_data->access_token;
}

function getUserDataFromSpotify($accessToken) {
    $url = 'https://api.spotify.com/v1/me';

    $options = array(
        'http' => array(
            'header' => "Authorization: Bearer $accessToken",
            'method' => 'GET'
        )
    );

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    if ($response === FALSE) {
        if (isset($http_response_header)) {
            echo "Error al obtener datos del usuario: " . $http_response_header[0];
        } else {
            echo "Error al obtener datos del usuario: No se pudo conectar con la API de Spotify.";
        }
        return null;
    }

    return json_decode($response);
}
?>
