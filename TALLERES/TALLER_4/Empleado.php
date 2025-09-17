<?php

class Empleado{
  public $Nombre;
  public $IDEmpleado;
  public $SalarioBase;

  public function __construct($Nombre, $IDEmpleado, $SalarioBase){
    $this->setNombre($Nombre);
    $this->setIdEmpleado($IDEmpleado);
    $this->setSalarioBase($SalarioBase);
  }

  public function getNombre(){
    return $this->nombre;
  }

  public function setNombre($Nombre){
    $this->nombre = trim($Nombre);
  }
    
  public function getIdEmpleado(){
    return $this->idempleado;
  }

  public function setIdEmpleado($IDEmpleado){
    $this->idempleado = trim($IDEmpleado);
  }

  public function getSalarioBase(){
    return $this->salariobase;
  }
  
  public function setSalarioBase($SalarioBase){
    $this->salariobase = trim($SalarioBase);
  }

  public function InfoEmpleado(){
    return "'{$this->getNombre()}' con el ID de empleado:  {$this->getIdEmpleado()}, y salario base de {$this->getSalarioBase()}";
  }

}

// $miEmpleado = new empleado ("Humberto Ossa", "333" , "1200.00");
// echo $miEmpleado->InfoEmpleado();

?>