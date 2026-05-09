<?php
header('Content-Type: application/json; charset=utf-8');

include('conexion.php');

$id = filter_input(INPUT_POST, 'idpro', FILTER_VALIDATE_INT);
$nombre = trim($_POST['nombre'] ?? '');
$precio = filter_input(INPUT_POST, 'precio', FILTER_VALIDATE_FLOAT);
$existencia = filter_input(INPUT_POST, 'existencia', FILTER_VALIDATE_INT);

if ($id === false || $id === null || $nombre === '' || $precio === false || $precio === null || $existencia === false || $existencia === null) {
    http_response_code(422);
    echo json_encode([
        'success' => false,
        'message' => 'Captura un id, nombre, precio y existencia validos.',
    ]);
    exit();
}

$con = conectaDB();
$stmt = $con->prepare('INSERT INTO productos (idpro, nombre, precio, existencia) VALUES (?, ?, ?, ?)');
$stmt->bind_param('isdi', $id, $nombre, $precio, $existencia);

try {
    $stmt->execute();
    http_response_code(201);
    echo json_encode([
        'success' => true,
        'message' => 'Producto registrado correctamente.',
    ]);
} catch (mysqli_sql_exception $error) {
    http_response_code(409);
    echo json_encode([
        'success' => false,
        'message' => 'No se pudo registrar el producto. Verifica que el id no exista.',
    ]);
}

$stmt->close();
$con->close();
?>
