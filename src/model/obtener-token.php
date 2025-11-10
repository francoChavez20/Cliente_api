<?php
header('Content-Type: application/json');
require_once "../library/conexion.php";

$sql = "SELECT token FROM 'cliente-api' LIMIT 1";
$resultado = $conn->query($sql);

if ($fila = $resultado->fetch_assoc()) {
    echo json_encode(["token" => $fila["token"]]);
} else {
    echo json_encode(["token" => null]);
}
?>
