<?php
include "utilidades_texto.php";

$frases = ["Mi nombres es Humberto Ossa", "Estudio la Licenciatura de Desarrollo de Software", "Este Semestre estamos aprendiendo PHP en Desarrollo VII"];

foreach ($frases as $frase){
  //Funcion contar Palabras
  echo contar_palabras($frase);
  

  //Funcion contar Vocales 
  //echo contar_vocales($frase);
  
  //Funcion invertir Palabras
  echo invertir_palabras($frase);
  
}

?>