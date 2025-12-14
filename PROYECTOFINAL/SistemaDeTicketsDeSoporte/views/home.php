<?php ob_start(); ?>

<h2>Bienvenido al Sistema de Tickets</h2>

<div class="card">
    <p>Desde aquí puedes:</p>
    <ul>
        <li>Crear y gestionar tickets de soporte</li>
        <li>Consultar la base de conocimiento</li>
        <li>Dar seguimiento a incidencias</li>
        <li>Medir cumplimiento de SLA</li>
    </ul>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
?>