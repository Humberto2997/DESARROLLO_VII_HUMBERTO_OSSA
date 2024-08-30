<?php
// Ejemplo de uso de explode()
$frase = "Manzana,Naranja,Plátano,Uva";
$frutas = explode(",", $frase);

echo "Frase original: $frase</br>";
echo "Array de frutas:</br>";
print_r($frutas);

// Ejercicio: Crea una variable con una lista de tus 5 películas favoritas separadas por guiones (-)
// y usa explode() para convertirla en un array
$misPeliculas = "Troya-los Vengadores-Rapidos y furioso-Top Gun-El Exorcista"; // Reemplaza esto con tu lista de películas
$arrayPeliculas = explode("-", $misPeliculas);

echo "</br>Mis películas favoritas:</br>";
print_r($arrayPeliculas);

// Bonus: Usa explode() con un límite
$texto = "Uno,Dos,Tres,Cuatro,Cinco";
$array = explode(",", $texto, 4); //Este imprime 0 uno,1 dos,2 tres,cuatro,cinco(los que restan en el ulitmo valor)
$array = array_slice($array, 0, 3); //array_slice me permite extraer una porcion del arreglo, por eso se sube al 4 el explode para que no esten los demas en la 3 pocicion

echo "</br>Texto original: $texto</br>";
echo "Array con límite:</br>";
print_r($array);
?>
      
