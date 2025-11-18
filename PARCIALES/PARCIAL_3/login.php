<?php
session_start();
require_once 'usuarios.php';
require_once 'validaciones.php';
require_once 'sanitizacion.php';

$errores = [];
$datos = [];

// Si ya existe una Sesion abierta lo manda al Dashboard del profesor o estudiante
if (isset($_SESSION['user'])) {
if ($_SESSION['user']['role'] === 'Profesor') header('Location: dashboard_profesor.php');
else header('Location: dashboard_estudiante.php');
exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
  $usuario = $_POST['usuario'];
  $contrasena = $_POST['contrasena'];

  $campos =['usuario', 'contrasena'];

  foreach ($campos as $campo){
    if (isset($_POST[$campo])) {
            $valor = $_POST[$campo];
            $valorSanitizado = call_user_func("sanitizar" . ucfirst($campo), $valor);
            $datos[$campo] = $valorSanitizado;

            if (!call_user_func("validar" . ucfirst($campo), $valorSanitizado)) {
                $errores[] = "El campo $campo no es válido.";
            }
        }
  }

  if(!empty($errores)){ // si errores no esta vacio, indica cuales son los errores
    echo "<h2>Errores:</h2>";
        foreach ($errores as $error) {
            echo "$error<br>";
        }
  }else {
    global $USUARIOS;

    $usuarioIngresado = $datos['usuario'];
    $contrasenaIngresada = $datos['contrasena'];

    if (!isset($USUARIOS[$usuarioIngresado])) {
        echo "<p style='color:red;'>El usuario no existe.</p>";
        exit();
    }

    $userData = $USUARIOS[$usuarioIngresado];

    if ($userData['contrasena'] !== $contrasenaIngresada) {
        echo "<p style='color:red;'>La contraseña es incorrecta.</p>";
        exit();
    }

    $_SESSION['user'] = [
        'usuario' => $usuarioIngresado,
        'role' => $userData['role'],
        'name' => $userData['name'],
        'nota' => $userData['nota']
    ];

    if ($userData['role'] === 'Profesor') {
        header("Location: dashboard_profesor.php");
         exit();
    } else {
        header("Location: dashboard_estudiante.php");
        exit();
    }
   
  }

}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php
    if (isset($error)) {
        echo "<p style='color: red;'>$error</p>";
    }
    ?>
    <form method="post" action="">
        <label for="usuario">Usuario:</label><br>
        <input type="text" id="usuario" name="usuario" required><br><br>
        <label for="contrasena">Contraseña:</label><br>
        <input type="password" id="contrasena" name="contrasena" required><br><br>
        <input type="submit" value="Iniciar Sesión">
    </form>
</body>
</html>