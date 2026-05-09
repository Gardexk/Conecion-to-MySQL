<?php
header('Content-Type: application/json; charset=utf-8');

include('conexion.php');

$id = filter_input(INPUT_POST, 'idpro', FILTER_VALIDATE_INT);

if ($id === false || $id === null) {
    http_response_code(422);
    echo json_encode([
        'success' => false,
        'message' => 'Captura un id valido.',
    ]);
    exit();
}

$con = conectaDB();
$stmt = $con->prepare('SELECT idpro, nombre, precio, existencia FROM productos WHERE idpro = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$producto = $stmt->get_result()->fetch_assoc();

if ($producto) {
    $producto['idpro'] = (int) $producto['idpro'];
    $producto['precio'] = (float) $producto['precio'];
    $producto['existencia'] = (int) $producto['existencia'];

    echo json_encode([
        'success' => true,
        'data' => $producto,
    ]);
} else {
    http_response_code(404);
    echo json_encode([
        'success' => false,
        'message' => 'No se encontro un producto con ese id.',
    ]);
}

$stmt->close();
$con->close();
?>
