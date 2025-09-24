<?php
require_once 'Empleado.php';
require_once "Evaluable.php";

class Desarrollador extends Empleado implements Evaluable {
  public $lenguajePrincipal;
  public $nivelExperiencia;

  public function __construct($nombre, $idempleado, $salarioBase,$lenguajePrincipal,$nivelExperiencia){
    parent::__construct($nombre, $idempleado, $salarioBase);
    $this->setLenguajePrincipal($lenguajePrincipal);
    $this->setNivelExperiencia($nivelExperiencia);
  }

  public function getLenguajePrincipal(){
    return $this->lenguajePrincipal;
  }

  public function setLenguajePrincipal($lenguajePrincipal){
    $this->lenguajePrincipal = trim($lenguajePrincipal);
  }

  public function getNivelExperiencia(){
    return $this->nivelExperiencia;
  }

  public function setNivelExperiencia($nivelExperiencia){
    $this->nivelExperiencia = trim($nivelExperiencia);
  }

  // public function InfoEmpleado(){
  //   return parent::InfoEmpleado() . 
  //   ", lenguaje de programacion principal {$this->getLenguajePrincipal()}, Nivel de Experiencia {$this->getNivelExperiencia()}.";
  // } Prueba para ver la impresion antes del Index

  public function evaluarDesempenio() {
    return "El desarrollador {$this->getNombre()} muestra un desempeño sólido en {$this->lenguajePrincipal} con nivel {$this->nivelExperiencia}.";
  }

}

// $Desarrollador = new desarrollador("Humberto Ossa", 333 , "1200.00", "PHP", "Avanzado");
// echo $Desarrollador->InfoEmpleado();

?>