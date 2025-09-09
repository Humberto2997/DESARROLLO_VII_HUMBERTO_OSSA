<?php
//$frasePrueba = ["Cinco por cinco son veinti y cinco", "tres por tres da como resultado nueve"];

function  contar_palabras_repetidas($texto){
    $texto = strtolower(trim($texto));
    $palabras = explode(" ", $texto);

    $contador = [];

    foreach ($palabras as $palabra) {
        $palabra = trim($palabra);
        if ($palabra != "") { 
            if (isset($contador[$palabra])) {
                $contador[$palabra]++;
            } else {
                $contador[$palabra] = 1;
            }
        }
    }

    return $contador;
}

function capitalizar_palabras($texto){
  $palabras = explode(" ", trim($texto));

    $resultado = [];

    foreach ($palabras as $palabra) {
        if ($palabra != "") {
            $primera = strtoupper(substr($palabra, 0, 1));
            $resto = strtolower(substr($palabra, 1, strlen($palabra) - 1));
            $resultado[] = $primera . $resto;
        }
    }

    return implode(" ", $resultado);

}


?>