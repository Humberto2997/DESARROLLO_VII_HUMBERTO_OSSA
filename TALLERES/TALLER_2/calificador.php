<?php
  $calificacion = rand(0,100);
  $letra;

  if ($calificacion >= 91) {
    $letra = "A";
} elseif ($calificacion >= 81) {
    $letra = "B";
} elseif ($calificacion >= 71) {
    $letra = "C";
} elseif ($calificacion >= 61) {
    $letra = "D";
} else {
    $letra = "F";
}

echo $calificacion . "<br>";
echo "Tu calificacion es $letra <br>";

$resultadoTernario = ($letra == "F") ? "Reprobado" : "Aprobado";
echo "$resultadoTernario<br><br>";

switch ($letra) {
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
    default:
        echo "Debes esforzarte más.<br>";
}
echo "<br>";
?>