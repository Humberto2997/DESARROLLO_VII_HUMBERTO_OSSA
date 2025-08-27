<?php
	//1. Crea un patrón de triángulo rectángulo usando asteriscos (*) con un bucle for. El triángulo debe tener 5 filas
	for ($i = 0;$i < 5; $i++){
	  for ($j = 0; $j < $i; $j++) {
        echo "*";
    }
    echo "<br>";
	}
	
	echo "<br>";
	
	// 2.Utilizando un bucle while, genera una secuencia de números del 1 al 20, pero solo muestra los números impares.
	$secuencia = 1;
	while($secuencia <= 20){
		if ($secuencia % 2 == 0){
			$secuencia++;
		}else {
			echo "$secuencia ";
			$secuencia++;
		}
	}
	echo "<br>";
	
	//3.Con un bucle do-while, crea un contador regresivo desde 10 hasta 1, pero salta el número 5.
	$contador = 10;
	do{
		if ($contador != 5 ){
			echo "$contador ";
			$contador--;
		}else {
			$contador--;
		}
		
	}while ($contador >= 1);
	echo "<br><br>";
	
?>