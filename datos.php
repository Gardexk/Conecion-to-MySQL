<?php
header('Content-Type: application/json; charset=utf-8');

include('conexion.php');

$conexion = conectaDB();
$sql = 'SELECT idpro, nombre, precio, existencia FROM productos ORDER BY idpro';
$resultado = $conexion->query($sql);

$datos = [];
while ($fila = $resultado->fetch_assoc()) {
    $fila['idpro'] = (int) $fila['idpro'];
    $fila['precio'] = (float) $fila['precio'];
    $fila['existencia'] = (int) $fila['existencia'];
    $datos[] = $fila;
}

echo json_encode($datos);
$conexion->close();
?>
