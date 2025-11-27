<?php
require_once "config_mysqli.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Vistas Avanzadas - MySQLi</title>
</head>
<body>

<h1>Reportes con Vistas Avanzadas (MySQLi)</h1>

<?php
// 1. Productos con bajo stock
echo "<h2>1. Productos con Bajo Stock (menos de 5 unidades)</h2>";
echo "<p>Incluye total vendido y monto generado.</p>";

$sql = "SELECT * FROM vista_productos_bajo_stock";
$result = mysqli_query($conn, $sql);

echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th>Producto</th><th>Categoría</th><th>Stock</th><th>Total Vendido</th><th>Ingresos Generados</th></tr>";

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $ingresos = number_format($row['ingresos_generados'], 2);
        echo "<tr>
                <td>" . $row['producto'] . "</td>
                <td>" . $row['categoria'] . "</td>
                <td>" . $row['stock'] . "</td>
                <td>" . $row['total_vendido'] . "</td>
                <td>$" . $ingresos . "</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No hay productos con bajo stock.</td></tr>";
}
echo "</table>";
mysqli_free_result($result);

echo "<hr>";

// 2. Historial de clientes
echo "<h2>2. Historial Completo de Compras por Cliente</h2>";
echo "<p>Últimas 10 transacciones.</p>";

$sql = "SELECT * FROM vista_historial_clientes ORDER BY fecha_venta DESC LIMIT 10";
$result = mysqli_query($conn, $sql);

echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th>Cliente</th><th>Email</th><th>Producto</th><th>Cantidad</th><th>Subtotal</th><th>Fecha</th><th>Estado</th></tr>";

while ($row = mysqli_fetch_assoc($result)) {
    $subtotal = number_format($row['subtotal'], 2);
    echo "<tr>
            <td>" . $row['cliente'] . "</td>
            <td>" . $row['email'] . "</td>
            <td>" . $row['producto_comprado'] . "</td>
            <td>" . $row['cantidad'] . "</td>
            <td>$" . $subtotal . "</td>
            <td>" . $row['fecha_venta'] . "</td>
            <td>" . $row['estado'] . "</td>
          </tr>";
}
echo "</table>";
mysqli_free_result($result);

echo "<hr>";

// 3. Rendimiento por categoría
echo "<h2>3. Métricas de Rendimiento por Categoría</h2>";
$sql = "SELECT * FROM vista_rendimiento_categorias";
$result = mysqli_query($conn, $sql);

echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th>Categoría</th><th>Productos</th><th>Unidades</th><th>Ingresos</th><th>Por Producto</th><th>Top</th></tr>";

while ($row = mysqli_fetch_assoc($result)) {
    $ingresos = number_format($row['ingresos_totales'], 2);
    $por_producto = number_format($row['ingreso_por_producto'] ?? 0, 2);
    $top = $row['producto_mas_vendido'] ?? 'Ninguno';
    echo "<tr>
            <td>" . $row['categoria'] . "</td>
            <td>" . $row['productos_en_categoria'] . "</td>
            <td>" . $row['unidades_vendidas'] . "</td>
            <td>$" . $ingresos . "</td>
            <td>$" . $por_producto . "</td>
            <td>" . $top . "</td>
          </tr>";
}
echo "</table>";
mysqli_free_result($result);

echo "<hr>";

// 4. Tendencias
echo "<h2>4. Tendencias de Ventas por Mes</h2>";
$sql = "SELECT * FROM vista_tendencias_ventas_mensual";
$result = mysqli_query($conn, $sql);

echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th>Año</th><th>Mes</th><th>Ventas</th><th>Ingresos</th><th>Anterior</th><th>Crecimiento %</th></tr>";

while ($row = mysqli_fetch_assoc($result)) {
    $ingresos_mes = number_format($row['ingresos_mes'], 2);
    $ingresos_anterior = number_format($row['ingresos_mes_anterior']?? 0, 2);
    $crec = $row['crecimiento_porcentual'] !== null ? $row['crecimiento_porcentual'] . "%" : "N/A";
    echo "<tr>
            <td>" . $row['año'] . "</td>
            <td>" . $row['mes'] . "</td>
            <td>" . $row['total_ventas'] . "</td>
            <td>$" . $ingresos_mes . "</td>
            <td>$" . $ingresos_anterior . "</td>
            <td>" . $crec . "</td>
          </tr>";
}
echo "</table>";
if (mysqli_num_rows($result) == 0) echo "<p>No hay datos de ventas completadas.</p>";
mysqli_free_result($result);

