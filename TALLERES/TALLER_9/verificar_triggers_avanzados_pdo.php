<?php
require_once "config_pdo.php";

echo "<h1>Verificación de Triggers Avanzados (PDO)</h1>";

// 1. Actualizar membresía
function probarMembresia($pdo) {
    echo "<h2>1. Actualizar Membresía Automática</h2>";
    
    // Simular una venta completada
    $pdo->exec("INSERT INTO ventas (cliente_id, total, estado, fecha_venta) VALUES (1, 3000.00, 'completada', NOW())");
    $venta_id = $pdo->lastInsertId();
    $pdo->exec("INSERT INTO detalles_venta (venta_id, producto_id, cantidad, precio_unitario, subtotal) VALUES ($venta_id, 1, 1, 3000.00, 3000.00)");

    $stmt = $pdo->prepare("SELECT nivel_membresia FROM clientes WHERE id = 1");
    $stmt->execute();
    $nivel = $stmt->fetchColumn();

    echo "Cliente ID 1 → Nivel de membresía: <strong>$nivel</strong> (debería ser Platinum)<br><br>";
}

// 2. Estadísticas en tiempo real
function probarEstadisticas($pdo) {
    echo "<h2>2. Estadísticas Actualizadas</h2>";
    
    $pdo->exec("UPDATE ventas SET estado = 'completada' WHERE id = (SELECT MAX(id) FROM ventas)");

    $stmt = $pdo->prepare("SELECT * FROM estadisticas_clientes WHERE cliente_id = 1");
    $stmt->execute();
    $stats = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stats) {
        echo "Total compras: " . $stats['total_compras'] . "<br>";
        echo "Total gastado: $" . number_format($stats['total_gastado'], 2) . "<br>";
        echo "Última compra: " . $stats['ultima_compra'] . "<br>";
    } else {
        echo "No se actualizaron las estadísticas.<br>";
    }
}

// 3. Alerta de stock crítico
function probarAlertaStock($pdo) {
    echo "<h2>3. Alerta de Stock Crítico</h2>";
    
    $pdo->exec("UPDATE productos SET stock = 3 WHERE id = 1");

    $stmt = $pdo->prepare("SELECT * FROM alertas_stock ORDER BY fecha_alerta DESC LIMIT 1");
    $stmt->execute();
    $alerta = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($alerta) {
        echo "<strong>Alerta generada:</strong> " . $alerta['mensaje'] . "<br>";
    } else {
        echo "No se generó alerta.<br>";
    }
}

// 4. Historial de estado
function probarHistorialEstado($pdo) {
    echo "<h2>4. Historial de Estado de Clientes</h2>";
    
    $pdo->exec("UPDATE clientes SET estado = 'inactivo' WHERE id = 1");

    $stmt = $pdo->prepare("SELECT * FROM historial_estado_clientes ORDER BY fecha_cambio DESC LIMIT 1");
    $stmt->execute();
    $hist = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($hist) {
        echo "Cambio: " . $hist['estado_anterior'] . " → " . $hist['estado_nuevo'] . "<br>";
        echo "Fecha: " . $hist['fecha_cambio'] . "<br>";
    }
}

// EJECUTAR PRUEBAS
probarMembresia($pdo);
echo "<hr>";
probarEstadisticas($pdo);
echo "<hr>";
probarAlertaStock($pdo);
echo "<hr>";
probarHistorialEstado($pdo);

$pdo = null;
?>