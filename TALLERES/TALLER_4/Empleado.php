<?php

class Empleado{
  public $nombre;
  public $idempleado;
  public $salarioBase;

  public function __construct($nombre, $idempleado, $salarioBase){
    $this->setNombre($nombre);
    $this->setIdEmpleado($idempleado);
    $this->setSalarioBase($salarioBase);
  }

  public function getNombre(){
    return $this->nombre;
  }

  public function setNombre($nombre){
    $this->nombre = trim($nombre);
  }
    
  public function getIdEmpleado(){
    return $this->idempleado;
  }

  public function setIdEmpleado($idempleado){
    $this->idempleado = trim($idempleado);
  }

  public function getSalarioBase(){
    return $this->salariobase;
  }
  
  public function setSalarioBase($salarioBase){
    $this->salariobase = trim($salarioBase);
  }

  public function InfoEmpleado(){
    return "'{$this->getNombre()}' con el ID de empleado:  {$this->getIdEmpleado()}, y salario base de {$this->getSalarioBase()}";
  }

}

// $miEmpleado = new empleado ("Humberto Ossa", "333" , "1200.00");
// echo $miEmpleado->InfoEmpleado();

?>