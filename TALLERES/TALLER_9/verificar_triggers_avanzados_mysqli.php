<?php
require_once "config_mysqli.php";

echo "<h1>Verificación de Triggers Avanzados (MySQLi)</h1>";

// 1. Membresía
echo "<h2>1. Membresía Automática</h2>";
mysqli_query($conn, "INSERT INTO ventas (cliente_id, total, estado) VALUES (2, 2500, 'completada')");
$venta_id = mysqli_insert_id($conn);
mysqli_query($conn, "INSERT INTO detalles_venta (venta_id, producto_id, cantidad, subtotal) VALUES ($venta_id, 2, 1, 2500)");

$result = mysqli_query($conn, "SELECT nivel_membresia FROM clientes WHERE id = 2");
$row = mysqli_fetch_assoc($result);
echo "Cliente 2 → Membresía: <strong>{$row['nivel_membresia']}</strong><br>";

// 2. Estadísticas
echo "<h2>2. Estadísticas</h2>";
$result = mysqli_query($conn, "SELECT * FROM estadisticas_clientes WHERE cliente_id = 2");
if ($row = mysqli_fetch_assoc($result)) {
    echo "Gastado: $" . number_format($row['total_gastado'], 2) . "<br>";
}

// 3. Alerta stock
echo "<h2>3. Alerta Stock</h2>";
mysqli_query($conn, "UPDATE productos SET stock = 2 WHERE id = 2");
$result = mysqli_query($conn, "SELECT mensaje FROM alertas_stock ORDER BY id DESC LIMIT 1");
if ($row = mysqli_fetch_assoc($result)) {
    echo "Alerta: " . $row['mensaje'] . "<br>";
}

// 4. Historial estado
echo "<h2>4. Historial Estado</h2>";
mysqli_query($conn, "UPDATE clientes SET estado = 'inactivo' WHERE id = 2");
$result = mysqli_query($conn, "SELECT * FROM historial_estado_clientes ORDER BY id DESC LIMIT 1");
if ($row = mysqli_fetch_assoc($result)) {
    echo "Cambio: {$row['estado_anterior']} → {$row['estado_nuevo']}<br>";
}

mysqli_close($conn);
?>