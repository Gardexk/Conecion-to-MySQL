<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ventas - Productos</title>
    <link rel="stylesheet" href="estilos.css" type="text/css">
</head>
<body>
    <main class="app">
        <section class="panel">
            <div class="panel__header">
                <h1>Ventas</h1>
                <p>Listado simple de productos registrados.</p>
            </div>
        </section>

        <section class="tabla-contenedor">
            <?php
            include('conexion.php');

            $con = conectaDB();
            $sql = 'SELECT nombre, precio FROM productos ORDER BY idpro';
            $resultado = $con->query($sql);

            echo "<table>";
            echo "<thead>";
            echo "<tr><th>Nombre</th><th>Precio</th></tr>";
            echo "</thead>";
            echo "<tbody>";

            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($fila['nombre'], ENT_QUOTES, 'UTF-8') . "</td>";
                echo "<td>$" . number_format((float) $fila['precio'], 2) . "</td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";

            $con->close();
            ?>
        </section>
    </main>
</body>
</html>
