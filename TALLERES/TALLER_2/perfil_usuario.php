<?php

$nombre_completo = "Humberto Ossa";
$edad = 26;
$correo = "humberto.ossa@utp.ac.pa";
$telefono = "6431-0110";

define("OCUPACION","Agente de ventas");

$texto = "Hola, mi nombre es " . $nombre_completo . " y tengo " . $edad . " años.". " mi correo eletronico es " . $correo . " mi numero de telefono es " . $telefono . " mi ocupacion es " . OCUPACION . ".";


echo($texto);
print("<br>");
print("<br>");
printf("Hola, mi nombre es %s y tengo %d años. mi correo eletronico es %s mi numero de telefono es %s mi ocupacion es %s.",$nombre_completo,$edad,$correo,$telefono, OCUPACION );
echo("<br>");
echo "<br>Información de debugging:<br>";
var_dump($nombre_completo);
echo("<br>");
var_dump($edad);
echo("<br>");
var_dump($correo);
echo("<br>");
var_dump($telefono);
echo("<br>");
var_dump(OCUPACION);
echo("<br>");
?>