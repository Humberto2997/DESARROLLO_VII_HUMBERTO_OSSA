<?php
include 'funciones_gimnasio.php';

$membresias = [
    "basica"   => 80,
    "premium"  => 120,
    "vip"      => 180,
    "familiar" => 250,
    "coporativo"=>200
];

$miembros = [
    ["nombre" => "Juan Perez",     "tipo" => "premium", "antiguedad" => 15],
    ["nombre" => "Maria Gomez",    "tipo" => "basica",  "antiguedad" => 3],
    ["nombre" => "Carlos Rodriguez","tipo" => "familiar","antiguedad" => 8],
    ["nombre" => "Ana Lopez",      "tipo" => "premium", "antiguedad" => 25],
    ["nombre" => "Luis Martinez",  "tipo" => "basica",  "antiguedad" => 1]
];

echo "<h2>Gestión de Membresías</h2>";
echo "<table border='1' cellpadding='5' cellspacing='0' >";
echo "<tr>
        <th>Nombre</th>
        <th>Tipo de membresía</th>
        <th>Antigüedad (meses)</th>
        <th>Cuota base</th>
        <th>Descuento aplicado (%)</th>
        <th>Monto del seguro</th>
        <th>Cuota final a pagar</th>
      </tr>";

foreach ($miembros as $miembro) {
    $cuota_base = $membresias[$miembro["tipo"]];
    $descuento = calcular_promocion($miembro["antiguedad"]);
    $seguro = calcular_seguro_medico($cuota_base);
    $cuota_final = calcular_cuota_final($cuota_base, $descuento, $seguro);

    echo "<tr>";
    echo "<td>" . $miembro["nombre"] . "</td>";
    echo "<td>" . $miembro["tipo"] . "</td>";
    echo "<td>" . $miembro["antiguedad"] . "</td>";
    echo "<td>$" . $cuota_base . "</td>";
    echo "<td>" . $descuento . "%</td>";
    echo "<td>$" . $seguro . "</td>";
    echo "<td>$" . $cuota_final . "</td>";
    echo "</tr>";
}

echo "</table>";




?>

