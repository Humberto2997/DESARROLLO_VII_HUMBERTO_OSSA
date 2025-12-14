<?php
require_once __DIR__ . '/../src/managers/UserManager.php';
require_once __DIR__ . '/../src/managers/TicketHistoryManager.php';

$tmHist = new TicketHistoryManager();
$um = new UserManager();

ob_start();
if (empty($ticket)) {
    echo "<p>Ticket no encontrado.</p>";
    $content = ob_get_clean();
    include __DIR__ . '/layout.php';
    return;
}
?>

<h2>Ticket #<?= htmlspecialchars($ticket['id']) ?> — <?= htmlspecialchars($ticket['title']) ?></h2>

<div class="card">
  <p><strong>Estado:</strong> <?= htmlspecialchars($ticket['status']) ?></p>
  <p><strong>Prioridad:</strong> <?= htmlspecialchars($ticket['priority']) ?></p>
  <p><strong>Solicitante:</strong>
    <?= htmlspecialchars($ticket['requester_name'] ?? ($ticket['requester_id'] ?? '—')) ?></p>
  <p><strong>Asignado a:</strong>
    <?= htmlspecialchars($ticket['technician_name'] ?? $ticket['assigned_name'] ?? '—') ?></p>
  <p><strong>Creado:</strong> <?= htmlspecialchars($ticket['created_at'] ?? '') ?></p>
  <p><?= nl2br(htmlspecialchars($ticket['description'])) ?></p>
</div>

<hr>

<h3>Asignar ticket</h3>
<form method="post" action="index.php?action=ticket_assign">
  <input type="hidden" name="ticket_id" value="<?= htmlspecialchars($ticket['id']) ?>">
  <label>Seleccionar técnico:
    <select name="assigned_to" required>
      <option value="">-- seleccionar --</option>
      <?php foreach ($um->allTechnicians() as $tech): ?>
        <option value="<?= htmlspecialchars($tech['id']) ?>"
          <?= (isset($ticket['assigned_to']) && $ticket['assigned_to'] == $tech['id']) ? 'selected' : '' ?>>
          <?= htmlspecialchars($tech['name']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </label>
  <button type="submit">Asignar</button>
</form>

<hr>

<h3>Cambiar estado</h3>
<form method="post" action="index.php?action=ticket_status">
  <input type="hidden" name="ticket_id" value="<?= htmlspecialchars($ticket['id']) ?>">
  <label>Nuevo estado:
    <select name="status">
      <option>Abierto</option>
      <option>En Progreso</option>
      <option>Resuelto</option>
      <option>Cerrado</option>
    </select>
  </label>
  <label>Notas / Comentarios
    <textarea name="notes" rows="3"></textarea>
  </label>
  <button type="submit">Guardar estado</button>
</form>

<hr>

<h3>Historial de estados</h3>
<?php
$history = $tmHist->history($ticket['id']);
if (empty($history)) {
    echo "<p>No hay historial.</p>";
} else {
    echo "<ul>";
    foreach ($history as $h) {
        echo "<li><strong>" . htmlspecialchars($h['status']) . "</strong> — " .
             htmlspecialchars($h['user'] ?? $h['changed_by']) . " — " .
             htmlspecialchars($h['changed_at']) .
             ($h['notes'] ? ' — ' . htmlspecialchars($h['notes']) : '') .
             "</li>";
    }
    echo "</ul>";
}
?>

<hr>

<h3>Historial de asignaciones</h3>
<?php
$assigns = $tmHist->assignments($ticket['id']);
if (empty($assigns)) {
    echo "<p>No hay asignaciones registradas.</p>";
} else {
    echo "<ul>";
    foreach ($assigns as $a) {
        echo "<li>" . htmlspecialchars($a['assigned_to_name'] ?? $a['assigned_to']) .
             " asignado por " . htmlspecialchars($a['assigned_by_name'] ?? $a['assigned_by']) .
             " — " . htmlspecialchars($a['assigned_at']) . "</li>";
    }
    echo "</ul>";
}
?>

<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
?>