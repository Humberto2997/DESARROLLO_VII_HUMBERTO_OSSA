<?php

$nombre_completo = "Humberto Ossa";
$edad = 27;
$correo = "humberto.ossa@utp.ac.pa";
$telefono = "6433-10110";
define("OCUPACION","estudiante");

$mensaje_2 = "Mi nombre es ".$nombre_completo." y tengo ".$edad." años, mi correo de contacto es ".$correo." o puedes llamarme al ".$telefono." ,actualmente soy ".OCUPACION.".";

echo "Mi nombre es $nombre_completo, tengo $edad años, mi correo de contacto es $correo o pueden llamarme al $telefono, actualmente soy ".OCUPACION;

echo "<br>";
print ($mensaje_2);
echo "<br>";
printf("Me llamo %s, tengo %d años y soy %s, este es mi correo %s.",$nombre_completo,$edad,OCUPACION,$correo);
echo "<br>";
echo "<br>";

echo "Tipo y valor de cada variable";
echo "<br>";

var_dump($nombre_completo);
echo "<br>";
var_dump($edad);
echo "<br>";
var_dump($telefono);
echo "<br>";
var_dump($correo);
echo "<br>";
var_dump(OCUPACION);
echo "<br>";

?>