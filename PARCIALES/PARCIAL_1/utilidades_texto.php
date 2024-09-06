<?php

function contar_palabras($texto){
  $texto_modificado = str_replace(" ", ",", $texto);
  $palabras = explode(",", $texto_modificado);
  $cant_palabras = count($palabras);
  return "La frase '$texto' tiene $cant_palabras palabras.<br>";
}

function contar_vocales($texto){
  $texto_minuscula = strtolower($texto);
  $arreglo_texto = str_split($texto_minuscula);
  print_r($arreglo_texto);
  $vocales = ["a","e","i","o","u"];

  for ($i=0; $i< count($arreglo_texto); $i++){
    if (in_array($vocales, $arreglo_texto)) {
      echo "$buscar está en la lista de frutas.</br>";
  } else {
      echo "$buscar no está en la lista de frutas.</br>";
  }

  }

  

  
}

function inverti_palabras($texto){
  $texto_modificado = str_replace(" ", ",", $texto);
  $palabras = explode(",", $texto_modificado);
  $cant_palabras = count($palabras);

  for ($i = 0 ; $i<=$cant_palabras; $i++){
    $palabras[i]= $palabras[$cant_palabras-1];
    $cant_palabras -= 1;

    return $palabras ; 
  }

}

contar_vocales("MI NOMBRE ES HUMBERTO");
?>