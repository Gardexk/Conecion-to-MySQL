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
$stmt = $con->prepare('DELETE FROM productos WHERE idpro = ?');
$stmt->bind_param('i', $id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode([
        'success' => true,
        'message' => 'Producto eliminado correctamente.',
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
