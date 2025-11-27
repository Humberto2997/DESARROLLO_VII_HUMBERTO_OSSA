<?php
require_once "config_mysqli.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Procedimientos Avanzados - MySQLi</title>
</head>
<body>

<h1>Procedimientos Almacenados Avanzados (MySQLi)</h1>

<?php
// 1. Procesar Devolución
echo "<h2>1. Procesar Devolución (Detalle ID: 1, Cantidad: 1)</h2>";
$detalle_id = 1;
$cantidad = 1;

$stmt = mysqli_prepare($conn, "CALL sp_procesar_devolucion(?, ?, @resultado)");
mysqli_stmt_bind_param($stmt, "ii", $detalle_id, $cantidad);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

$result = mysqli_query($conn, "SELECT @resultado AS mensaje");
$row = mysqli_fetch_assoc($result);
echo "<p><strong>Resultado:</strong> " . $row['mensaje'] . "</p>";

echo "<hr>";

// 2. Aplicar Descuento
echo "<h2>2. Aplicar Descuento (Cliente ID: 1, Monto: $1000)</h2>";
$cliente_id = 1;
$monto_base = 1000.00;

$stmt = mysqli_prepare($conn, "CALL sp_aplicar_descuento(?, ?, @desc, @final)");
mysqli_stmt_bind_param($stmt, "id", $cliente_id, $monto_base);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

$result = mysqli_query($conn, "SELECT @desc AS descuento, @final AS monto_final");
$row = mysqli_fetch_assoc($result);

echo "<p>Descuento: " . $row['descuento'] . "%</p>";
echo "<p>Monto final: $" . number_format($row['monto_final'], 2) . "</p>";

echo "<hr>";

// 3. Reporte Bajo Stock
echo "<h2>3. Productos con Bajo Stock (Umbral: 5)</h2>";
$umbral = 5;

$stmt = mysqli_prepare($conn, "CALL sp_reporte_bajo_stock(?)");
mysqli_stmt_bind_param($stmt, "i", $umbral);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th>Producto</th><th>Categoría</th><th>Stock</th><th>Vendido</th><th>Sugerido</th></tr>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>{$row['producto']}</td>
            <td>{$row['categoria']}</td>
            <td>{$row['stock']}</td>
            <td>{$row['vendido_ultimo_mes']}</td>
            <td>" . round($row['sugerido_reposicion']) . "</td>
          </tr>";
}
echo "</table>";
mysqli_stmt_close($stmt);

echo "<hr>";

// 4. Comisiones
echo "<h2>4. Comisiones por Ventas (2025-11-01 a 2025-11-30)</h2>";
$inicio = '2025-11-01';
$fin = '2025-11-30';

$stmt = mysqli_prepare($conn, "CALL sp_calcular_comisiones(?, ?)");
mysqli_stmt_bind_param($stmt, "ss", $inicio, $fin);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th>Venta</th><th>Cliente</th><th>Total</th><th>Productos</th><th>Comisión</th></tr>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>{$row['venta_id']}</td>
            <td>{$row['cliente']}</td>
            <td>\${$row['total']}</td>
            <td>{$row['productos_vendidos']}</td>
            <td>\${$row['comision']}</td>
          </tr>";
}
echo "</table>";
mysqli_stmt_close($stmt);

mysqli_close($conn);
?>

</body>
</html>