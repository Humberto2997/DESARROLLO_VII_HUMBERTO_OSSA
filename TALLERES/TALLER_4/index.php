<?php
require_once "Empresa.php";


$miEmpresa = new Empresa();


$gerente1 = new Gerente("Carlos", 101, 2500, "Ventas");
$desarrollador1 = new Desarrollador("Ana", 201, 1800, "PHP", "Senior");
$desarrollador2 = new Desarrollador("Luis", 202, 1500, "JavaScript", "Junior");


$gerente1->asignarBono(500); // Asignar bono al gerente


$miEmpresa->agregarEmpleado($gerente1);
$miEmpresa->agregarEmpleado($desarrollador1);
$miEmpresa->agregarEmpleado($desarrollador2);

echo "=== Lista de Empleados ===\n";
$miEmpresa->listarEmpleados();


echo "\n=== Nómina Total ===\n";
echo "Total: " . $miEmpresa->calcularNominaTotal() . "\n";


echo "\n=== Evaluación de Desempeño ===\n";
$miEmpresa->evaluarEmpleados();
