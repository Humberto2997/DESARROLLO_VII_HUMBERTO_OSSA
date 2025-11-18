<?php
session_start();
require_once 'usuarios.php';


if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Profesor') {

header('Location: login.php');
exit();
}


$estudiantes = [];
foreach ($USUARIOS as $username => $data) {
if ($data['role'] === 'Estudiante') {
$estudiantes[] = ['username' => $username, 'name' => $data['name'], 'nota' => $data['nota']];
}
}


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Dashboard Profesor</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
<div class="card">
<div class="header">
<h1>Dashboard - Profesor</h1>
<div>
Bienvenido, <?php echo htmlspecialchars($_SESSION['user']['name']); ?> |
<a href="logout.php" class="btn">Cerrar sesión</a>
</div>
</div>


<h3>Lista de Estudiantes y Calificaciones</h3>
<table class="table">
<thead>
<tr><th>Usuario</th><th>Nombre</th><th>Calificación</th></tr>
</thead>
<tbody>
<?php foreach ($estudiantes as $s): ?>
<tr>
<td><?php echo htmlspecialchars($s['username']); ?></td>
<td><?php echo htmlspecialchars($s['name']); ?></td>
<td><?php echo htmlspecialchars($s['nota']); ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</div>
</body>
</html>