<?php
function calcular_promocion($antiguedad_meses){
  $descuento = 0.0;
  
  if ($antiguedad_meses < 3){
    $descuento  = 0; 
  }elseif ($antiguedad_meses <= 12){
    $descuento  = 8;
  }elseif ($antiguedad_meses <= 24){
    $descuento  = 12;
  } elseif  ($antiguedad_meses >= 24){
    $descuento  = 20;
  }

  return $descuento;
}


function calcular_seguro_medico($cuota_base){
  $monto_seguro = $cuota_base*0.05;
  return $monto_seguro;

}


function calcular_cuota_final($cuota_base, $descuento_porcentaje, $seguro_medico){
  $descuento = ($cuota_base * $descuento_porcentaje)/100;

  $cuota_final = $cuota_base -  $descuento + $seguro_medico;
  return $cuota_final;

}

//echo "El descuento de 30 meses es: ". calcular_promocion(30)."% y el seguro es de: ". calcular_seguro_medico(700);
?>