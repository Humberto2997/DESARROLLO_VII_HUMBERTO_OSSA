<?php
session_start();
require_once 'usuarios.php';


if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Estudiante') {

header('Location: login.php');
exit();
}


$username = $_SESSION['user']['usuario'];
$user = $USUARIOS[$username] ?? null;


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Dashboard Estudiante</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
<div class="card">
<div class="header">
<h1>Dashboard - Estudiante</h1>
<div>
Hola, <?php echo htmlspecialchars($user['name']); ?> |
<a href="logout.php" class="btn">Cerrar sesión</a>
</div>
</div>


<h3>Tu calificación</h3>
<p><strong><?php echo htmlspecialchars($user['nota']); ?></strong></p>


</div>
</div>
</body>
</html>