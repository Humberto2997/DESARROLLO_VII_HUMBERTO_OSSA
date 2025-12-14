<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
ob_start();
?>

<h2>Base de Conocimiento</h2>

<?php if (in_array($_SESSION['role'] ?? '', ['Administrador', 'Tecnico'])): ?>
    <a href="index.php?action=kb_new" class="btn-gold" style="margin-bottom:15px; display:inline-block;">
      <img src="public/assets/img/icon_book.svg" width="16" style="vertical-align:middle; margin-right:6px;">
      Nuevo Artículo
    </a>
<?php endif; ?>

<?php if (empty($articles)): ?>
    <p>No hay artículos en la base de conocimiento.</p>
<?php else: ?>
    <table class="tickets">
        <thead>
            <tr>
                <th>Título</th>
                <th>Tags</th>
                <th>Autor</th>
                <th>Fecha</th>
                <th>Acción</th>
            </tr>
        </thead>

        <tbody>
        <?php foreach ($articles as $a): ?>
            <tr>
                <td><?= htmlspecialchars($a['title']) ?></td>
                <td><?= htmlspecialchars($a['tags']) ?></td>
                <td><?= htmlspecialchars($a['author_name'] ?? $a['created_by']) ?></td>
                <td><?= htmlspecialchars($a['created_at']) ?></td>

                <td>
                    <a href="index.php?action=kb_view&id=<?= urlencode($a['id']) ?>">
                        <img src="public/assets/img/icon_book.svg" width="16" style="vertical-align:middle;">
                        Leer
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>