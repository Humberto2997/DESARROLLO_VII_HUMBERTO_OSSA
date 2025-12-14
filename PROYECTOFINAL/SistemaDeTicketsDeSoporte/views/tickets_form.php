<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
ob_start();
?>
<h2>Crear Ticket</h2>

<form method="post" action="index.php?action=ticket_save">
  <label>Título
    <input type="text" name="title" required>
  </label>

  <label>Descripción
    <textarea name="description" rows="6" required></textarea>
  </label>

  <label>Prioridad
    <select name="priority">
      <option value="Media">Media</option>
      <option value="Baja">Baja</option>
      <option value="Alta">Alta</option>
      <option value="Critica">Crítica</option>
    </select>
  </label>

  <label>SLA (horas)
    <input type="number" name="sla_hours" value="48" min="1">
  </label>

  <?php
  // Si el usuario está logueado, envía requester_id automáticamente
  if (!empty($_SESSION['user_id'])): ?>
    <input type="hidden" name="requester_id" value="<?= htmlspecialchars($_SESSION['user_id']) ?>">
  <?php else: ?>
    <label>ID del solicitante
      <input type="number" name="requester_id" required>
    </label>
  <?php endif; ?>

  <div style="margin-top:10px;">
    <button type="submit">Crear ticket</button>
  </div>
</form>

<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
?>