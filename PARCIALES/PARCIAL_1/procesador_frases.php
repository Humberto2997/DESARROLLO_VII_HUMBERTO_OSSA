<?php
include "operaciones_cadenas.php";

$frases = ["Cinco por cinco son veinticinco",
            "Estudio desarrollo de software",
            "tres por tres da como resultado nueve",
            "Es util estudiar php porque php es un lenguaje muy utilizado"
          ];

foreach ($frases as $frase){
  echo "<h2>La Frase: $frase</h2>";
  print_r(contar_palabras_repetidas($frase)) ;
  echo "<br/>";
  echo "Frase Capitalizada: ".capitalizar_palabras($frase);
}


?>