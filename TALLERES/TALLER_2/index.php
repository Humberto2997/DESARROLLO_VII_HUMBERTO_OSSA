<?php
$nombre = "juan";
$edad = 25;

// concatenacion usando el operados.
$presentacion1 = "Hola, mi nombre es " . $nombre . " y tengo " . $edad . " años.";

// concatenacion dentreo de la comillas dobles
$presentacion2 = "Hola, mi nombre es $nombre y tengo $edad años.";

//Definicion de una constante
define("SALUDO","¡Bienvenido!");

//concatenacion con constante
$mensaje = SALUDO. " " . $nombre;

echo $presentacion1 . "<br>";
echo $presentacion2 . "<br>";
echo $mensaje . "<br>";
?>

