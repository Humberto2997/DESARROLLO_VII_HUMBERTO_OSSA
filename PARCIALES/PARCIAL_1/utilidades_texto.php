<?php

function contar_palabras($texto){
  $texto_modificado = str_replace(" ", ",", $texto);
  $palabras = explode(",", $texto_modificado);
  $cant_palabras = count($palabras);
  return "La frase '$texto' tiene $cant_palabras palabras.<br>";
}

function contar_vocales($texto){
$cant_caracteres = explode("",$texto);
print_r($cant_caracteres);
  
}

function inverti_palabras($texto){

}

contar_vocales("MI NOMBRE ES HUMBERTO");
?>