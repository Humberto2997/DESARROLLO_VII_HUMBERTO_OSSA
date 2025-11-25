<?php 
@require_once "config_pdo.php";
@require_once "config_mysqli.php"; 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consultas Finales - MySQLi y PDO</title>
    <style>
        body {font-family: Arial; margin: 40px; background: #f9f9f9;}
        h1 {color: #2c3e50;}
        h2 {color: #9b34dbff; margin-top: 40px;}
        table {width: 100%; border-collapse: collapse; margin: 20px 0; background: white;}
        th, td {border: 1px solid #ddd; padding: 12px; text-align: left;}
        th {background: #8234dbff; color: white;}
        .ok {color: green; font-weight: bold;}
        .no {color: #e74c3c;}
    </style>
</head>
<body>
<h1>Consultas Avanzadas - MySQLi + PDO</h1>

<!-- 1. Últimas 5 publicaciones -->
<h2>1. Últimas 5 publicaciones con autor</h2>
<?php
echo "<h4>→ Con PDO</h4>";
$stmt = $pdo->query("SELECT p.titulo, u.nombre AS autor, p.fecha_publicacion 
                     FROM publicaciones p 
                     JOIN usuarios u ON p.usuario_id = u.id 
                     ORDER BY p.fecha_publicacion DESC LIMIT 5");
if ($stmt->rowCount() > 0) {
    echo "<table><tr><th>Título</th><th>Autor</th><th>Fecha</th></tr>";
    while ($row = $stmt->fetch()) {
        echo "<tr><td>{$row['titulo']}</td><td>{$row['autor']}</td><td>{$row['fecha_publicacion']}</td></tr>";
    }
    echo "</table>";
} else echo "<p class='no'>No hay publicaciones</p>";

echo "<h4>→ Con MySQLi</h4>";
require_once "config_mysqli.php";
$result = mysqli_query($conn, "SELECT p.titulo, u.nombre AS autor, p.fecha_publicacion 
                               FROM publicaciones p 
                               JOIN usuarios u ON p.usuario_id = u.id 
                               ORDER BY p.fecha_publicacion DESC LIMIT 5");
if (mysqli_num_rows($result) > 0) {
    echo "<table><tr><th>Título</th><th>Autor</th><th>Fecha</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>{$row['titulo']}</td><td>{$row['autor']}</td><td>{$row['fecha_publicacion']}</td></tr>";
    }
    echo "</table>";
} else echo "<p class='no'>No hay publicaciones</p>";
?>

<!-- 2. Usuarios sin publicaciones -->
<h2>2. Usuarios que no han publicado</h2>
<?php
echo "<h4>→ Con PDO</h4>";
$stmt = $pdo->query("SELECT nombre, email FROM usuarios 
                     WHERE id NOT IN (SELECT usuario_id FROM publicaciones WHERE usuario_id IS NOT NULL)");
if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch()) echo "• {$row['nombre']} ({$row['email']})<br>";
} else echo "<span class='ok'>Todos los usuarios han publicado</span>";

echo "<h4>→ Con MySQLi</h4>";
$result = mysqli_query($conn, "SELECT usuarios.nombre, usuarios.email 
                               FROM usuarios 
                               LEFT JOIN publicaciones ON usuarios.id = publicaciones.usuario_id 
                               WHERE publicaciones.id IS NULL");
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) echo "• {$row['nombre']} ({$row['email']})<br>";
} else echo "<span class='ok'>Todos los usuarios han publicado</span>";
?>

<!-- 3. Promedio de publicaciones por usuario -->
<h2>3. Promedio de publicaciones por usuario</h2>
<?php
echo "<h4>→ Con PDO</h4>";
$stmt = $pdo->query("SELECT ROUND(AVG(cant), 2) AS promedio 
                     FROM (SELECT COUNT(p.id) AS cant FROM usuarios u 
                           LEFT JOIN publicaciones p ON u.id = p.usuario_id 
                           GROUP BY u.id) AS sub");
$prom = $stmt->fetchColumn();
echo "Promedio: <strong>$prom</strong> publicaciones por usuario";

echo "<h4>→ Con MySQLi</h4>";
$result = mysqli_fetch_assoc(mysqli_query($conn, "SELECT ROUND(AVG(cant), 2) AS promedio 
                                                  FROM (SELECT COUNT(p.id) AS cant FROM usuarios u 
                                                        LEFT JOIN publicaciones p ON u.id = p.usuario_id 
                                                        GROUP BY u.id) AS sub"));
echo "Promedio: <strong>{$result['promedio']}</strong> publicaciones por usuario";
?>

<!-- 4. Publicación más reciente de cada usuario -->
<h2>4. Publicación más reciente por usuario</h2>
<?php
echo "<h4>→ Con PDO</h4>";
$stmt = $pdo->query("SELECT u.nombre, p.titulo, p.fecha_publicacion
                     FROM publicaciones p
                     JOIN usuarios u ON p.usuario_id = u.id
                     WHERE p.fecha_publicacion = (
                         SELECT MAX(fecha_publicacion) 
                         FROM publicaciones p2 
                         WHERE p2.usuario_id = u.id
                     )");
if ($stmt->rowCount() > 0) {
    echo "<table><tr><th>Usuario</th><th>Última publicación</th><th>Fecha</th></tr>";
    while ($row = $stmt->fetch()) {
        echo "<tr><td>{$row['nombre']}</td><td>{$row['titulo']}</td><td>{$row['fecha_publicacion']}</td></tr>";
    }
    echo "</table>";
} else echo "<p class='no'>No hay publicaciones</p>";

echo "<h4>→ Con MySQLi</h4>";
$result = mysqli_query($conn, "SELECT u.nombre, p.titulo, p.fecha_publicacion
                               FROM publicaciones p
                               JOIN usuarios u ON p.usuario_id = u.id
                               INNER JOIN (
                                   SELECT usuario_id, MAX(fecha_publicacion) AS max_fecha
                                   FROM publicaciones GROUP BY usuario_id
                               ) ultima ON p.usuario_id = ultima.usuario_id AND p.fecha_publicacion = ultima.max_fecha");
if (mysqli_num_rows($result) > 0) {
    echo "<table><tr><th>Usuario</th><th>Última publicación</th><th>Fecha</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>{$row['nombre']}</td><td>{$row['titulo']}</td><td>{$row['fecha_publicacion']}</td></tr>";
    }
    echo "</table>";
} else echo "<p class='no'>No hay publicaciones</p>";

mysqli_close($conn);
?>

</body>
</html>