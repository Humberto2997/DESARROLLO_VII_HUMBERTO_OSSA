<?php
ob_start();
?>
<h2>Lista de Tickets</h2>

<?php if (empty($tickets)): ?>
  <p>No hay tickets registrados.</p>
<?php else: ?>
<table class="tickets">
  <thead>
    <tr>
      <th>ID</th>
      <th>Título</th>
      <th>Prioridad</th>
      <th>Estado</th>
      <th>Solicitante</th>
      <th>Asignado</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($tickets as $t): ?>
      <tr>
        <td><?= htmlspecialchars($t['id']) ?></td>
        <td><?= htmlspecialchars($t['title']) ?></td>
        <td><?= htmlspecialchars($t['priority']) ?></td>
        <td><?= htmlspecialchars($t['status']) ?></td>
        <td><?= htmlspecialchars($t['requester_name'] ?? '—') ?></td>
        <td><?= htmlspecialchars($t['technician_name'] ?? $t['assigned_name'] ?? '—') ?></td>
        <td>
          <a href="index.php?action=ticket_view&id=<?= urlencode($t['id']) ?>">Ver</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php endif; ?>

<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
?>
