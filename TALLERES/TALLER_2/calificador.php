<?php
$calificacion = 80;

if($calificacion >=90){
  echo "Sacaste A.<br>";
} elseif ($calificacion >=80){
  echo "Sacaste B.<br>";
} elseif ($calificacion >=70){
  echo "Sacaste C.<br>";
} elseif ($calificacion >=60){
  echo "Sacaste D, debes mejorar la nota.<br>";
}else {
  echo "Sacaste F.<br>";
}
echo "<br>";

$mensaje = ($calificacion >= 60) ? "Aprobaste" : "Reprobaste";
echo "$mensaje<br>";

echo "<br>";
$letra = ($calificacion>=90) ? "A" : (($calificacion>=80) ? "B" :(($calificacion>=70) ? "C" :($calificacion>=60 ? "D" : "F")));

switch($letra){
  case "A":
    echo "Excelente trabajo.<br>";
    break;
  case "B":
    echo "Buen trabajo.<br>";
    break;
  case "C":
    echo "Trabajo aceptable.<br>";
    break;
  case "D":
    echo "Necesitas mejorar.<br>";
    break;
  case "F":
    echo "Debes esforzarte más.<br>";
    break;
}
?>