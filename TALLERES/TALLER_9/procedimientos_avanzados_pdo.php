<?php
require_once "config_pdo.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Procedimientos Avanzados - PDO</title>
</head>
<body>

<h1>Procedimientos Almacenados Avanzados (PDO)</h1>

<?php
try {
    // 1. Devolución
    echo "<h2>1. Procesar Devolución</h2>";
    $stmt = $pdo->prepare("CALL sp_procesar_devolucion(1, 1, @res)");
    $stmt->execute();
    $res = $pdo->query("SELECT @res AS mensaje")->fetchColumn();
    echo "<p><strong>Resultado:</strong> $res</p>";

    echo "<hr>";

    // 2. Descuento
    echo "<h2>2. Aplicar Descuento</h2>";
    $stmt = $pdo->prepare("CALL sp_aplicar_descuento(1, 1000.00, @d, @f)");
    $stmt->execute();
    $row = $pdo->query("SELECT @d AS descuento, @f AS final")->fetch(PDO::FETCH_ASSOC);
    echo "<p>Descuento: {$row['descuento']}%</p>";
    echo "<p>Monto final: $" . number_format($row['final'], 2) . "</p>";

    echo "<hr>";

    // 3. Bajo Stock
    echo "<h2>3. Reporte Bajo Stock</h2>";
    $stmt = $pdo->prepare("CALL sp_reporte_bajo_stock(5)");
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr><th>Producto</th><th>Categoría</th><th>Stock</th><th>Vendido</th><th>Sugerido</th></tr>";
    foreach ($rows as $row) {
        echo "<tr>
                <td>" . htmlspecialchars($row['producto']) . "</td>
                <td>" . htmlspecialchars($row['categoria']) . "</td>
                <td>{$row['stock']}</td>
                <td>{$row['vendido_ultimo_mes']}</td>
                <td>" . round($row['sugerido_reposicion']) . "</td>
              </tr>";
    }
    echo "</table>";

    echo "<hr>";

    // 4. Comisiones
    echo "<h2>4. Comisiones</h2>";
    $stmt = $pdo->prepare("CALL sp_calcular_comisiones('2025-11-01', '2025-11-30')");
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr><th>Venta</th><th>Cliente</th><th>Total</th><th>Productos</th><th>Comisión</th></tr>";
    foreach ($rows as $row) {
        echo "<tr>
                <td>{$row['venta_id']}</td>
                <td>" . htmlspecialchars($row['cliente']) . "</td>
                <td>\${$row['total']}</td>
                <td>{$row['productos_vendidos']}</td>
                <td>\${$row['comision']}</td>
              </tr>";
    }
    echo "</table>";

} catch (PDOException $e) {
    echo "<p><strong>Error:</strong> " . $e->getMessage() . "</p>";
}

$pdo = null;
?>

</body>
</html>