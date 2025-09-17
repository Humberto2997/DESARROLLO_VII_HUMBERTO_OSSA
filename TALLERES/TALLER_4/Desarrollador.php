<?php
require_once 'Empleado.php';

class Desarrollador extends Empleado {
  public $LenguajePrincipal;
  public $NivelExperiencia;

  public function __construct($Nombre, $IDEmpleado, $SalarioBase,$LenguajePrincipal,$NivelExperiencia){
    parent::__construct($Nombre, $IDEmpleado, $SalarioBase);
    $this->setLenguajePrincipal($LenguajePrincipal);
    $this->setNivelExperiencia($NivelExperiencia);
  }

  public function getLenguajePrincipal(){
    return $this->lenguajeprincipal;
  }

  public function setLenguajePrincipal($LenguajePrincipal){
    $this->lenguajeprincipal = trim($LenguajePrincipal);
  }

  public function getNivelExperiencia(){
    return $this->nivelexperiencia;
  }

  public function setNivelExperiencia($NivelExperiencia){
    $this->nivelexperiencia = trim($NivelExperiencia);
  }

   public function InfoEmpleado(){
    return parent::InfoEmpleado() . 
    ", lenguaje de programacion principal {$this->getLenguajePrincipal()}, Nivel de Experiencia {$this->getNivelExperiencia()}.";
  }

}

$Desarrollador = new desarrollador("Humberto Ossa", 333 , "1200.00", "PHP", "Avanzado");
echo $Desarrollador->InfoEmpleado();

?>