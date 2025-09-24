<?php
require_once 'Empleado.php';
require_once 'Evaluable.php';

class Gerente extends Empleado implements Evaluable {
  public $departamento;
  public $bono;

  public function __construct($nombre, $idEmpleado, $salarioBase,$departamento){
    parent::__construct($nombre, $idEmpleado, $salarioBase);
    $this->departamento = $departamento;
  }

  public function getDepartamento() {
    return $this->departamento;
  }

  public function setDepartamento($departamento) {
    $this->departamento = $departamento;
  }

  public function asignarBono($monto) {
    $this->bono = (float)$monto;
  }

  public function getBono() {
    return $this->bono;
  }

  public function evaluarDesempenio() {
        return "El gerente {$this->getNombre()} ha gestionado exitosamente el departamento de {$this->departamento}.";
  }

  




}



?>