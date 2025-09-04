<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inventario</title>
    <!-- Enlace a tu archivo CSS -->
    <link rel="stylesheet" href="inventario.css">
</head>
<body>

<?php
// Leer el inventario desde el archivo JSON.
$archivo = file_get_contents("inventario.json");
$inventario = json_decode($archivo, true);

//Mostrar un resumen del inventario ordenado alfabéticamente por nombre del producto.
usort($inventario, function($a, $b) {
    if ($a['nombre'] == $b['nombre']) return 0;
    return ($a['nombre'] < $b['nombre']) ? -1 : 1;
});

echo "<h2>Resumen del Inventario</h2>";
echo "<table border='1' cellpadding='5'>";
echo "<tr><th>Nombre</th><th>Precio</th><th>Cantidad</th></tr>";

foreach ($inventario as $producto) {
    echo "<tr>";
    echo "<td>{$producto['nombre']}</td>";
    echo "<td>\${$producto['precio']}</td>";
    echo "<td>{$producto['cantidad']}</td>";
    echo "</tr>";
}
echo "</table><br>";

//Calcular el valor total del inventario.
$total = array_sum(array_map(function($p) {
    return $p['precio'] * $p['cantidad'];
}, $inventario));

echo "<p><strong>Valor total del inventario:</strong> \$$total</p><br>";

//Generar un informe de productos con stock bajo.

$stockBajo = array_filter($inventario, function($p) {
    return $p['cantidad'] < 10;
});

if (!empty($stockBajo)) {
    echo "<h3>Productos con Stock Bajo (menos de 10 unidades)</h3>";
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>Nombre</th><th>Precio</th><th>Cantidad</th></tr>";
    foreach ($stockBajo as $producto) {
        echo "<tr>";
        echo "<td>{$producto['nombre']}</td>";
        echo "<td>\${$producto['precio']}</td>";
        echo "<td>{$producto['cantidad']}</td>";
        echo "</tr>";
    }
    echo "</table><br>";
} else {
    echo "<p>No hay productos con stock bajo.</p>";
}

?>


</body>
</html>