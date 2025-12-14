<?php ob_start(); ?>

<h2>Métricas SLA</h2>

<div class="card">
    <p>Este módulo muestra métricas básicas de cumplimiento SLA.</p>
    <ul>
        <li>Total de tickets</li>
        <li>Tickets dentro del SLA</li>
        <li>Tickets fuera del SLA</li>
    </ul>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>