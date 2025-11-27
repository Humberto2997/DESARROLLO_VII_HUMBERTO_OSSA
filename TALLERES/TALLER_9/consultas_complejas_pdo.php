<?php
require_once "config_pdo.php";

try {
    // 1. Productos nunca vendidos
    echo "<h3>1. Productos que nunca se han vendido</h3>";
    $sql1 = "SELECT p.id, p.nombre, p.precio, p.stock
             FROM productos p
             LEFT JOIN detalles_venta dv ON p.id = dv.producto_id
             WHERE dv.producto_id IS NULL";

    $stmt = $pdo->query($sql1);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($rows) > 0) {
        foreach ($rows as $row) {
            echo "ID: {$row['id']} | Producto: {$row['nombre']} | Precio: \${$row['precio']} | Stock: {$row['stock']}<br>";
        }
    } else {
        echo "No hay productos sin ventas.<br>";
    }

    echo "<hr>";

    // 2. Categorías con inventario
    echo "<h3>2. Categorías con número de productos y valor de inventario</h3>";
    $sql2 = "SELECT 
                c.nombre AS categoria,
                COUNT(p.id) AS num_productos,
                COALESCE(SUM(p.precio * p.stock), 0) AS valor_inventario
             FROM categorias c
             LEFT JOIN productos p ON c.id = p.categoria_id
             GROUP BY c.id, c.nombre";

    $stmt = $pdo->query($sql2);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Categoría: {$row['categoria']} | Productos: {$row['num_productos']} | Valor: \${$row['valor_inventario']}<br>";
    }

    echo "<hr>";

    // 3. Clientes que compraron todos los smartphones
    echo "<h3>3. Clientes que compraron TODOS los productos de 'Smartphones'</h3>";
    $sql3 = "SELECT c.nombre, c.email
             FROM clientes c
             WHERE NOT EXISTS (
                 SELECT p.id
                 FROM productos p
                 WHERE p.categoria_id = 2
                   AND p.id NOT IN (
                       SELECT dv.producto_id
                       FROM detalles_venta dv
                       JOIN ventas v ON dv.venta_id = v.id
                       WHERE v.cliente_id = c.id
                   )
             )";

    $stmt = $pdo->query($sql3);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($rows) > 0) {
        foreach ($rows as $row) {
            echo "Cliente: {$row['nombre']} | Email: {$row['email']}<br>";
        }
    } else {
        echo "Ningún cliente ha comprado todos los smartphones.<br>";
    }

    echo "<hr>";

    // 4. Porcentaje de ventas por producto
    echo "<h3>4. Porcentaje de ventas por producto</h3>";
    $sql4 = "SELECT 
                p.nombre,
                SUM(dv.subtotal) AS ventas_producto,
                ROUND(
                    (SUM(dv.subtotal) * 100.0) / (
                        SELECT SUM(subtotal) FROM detalles_venta
                    ), 2
                ) AS porcentaje_ventas
             FROM productos p
             JOIN detalles_venta dv ON p.id = dv.producto_id
             GROUP BY p.id, p.nombre
             HAVING ventas_producto > 0";

    $stmt = $pdo->query($sql4);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Producto: {$row['nombre']} | Ventas: \${$row['ventas_producto']} | Porcentaje: {$row['porcentaje_ventas']}% <br>";
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$pdo = null;
?>