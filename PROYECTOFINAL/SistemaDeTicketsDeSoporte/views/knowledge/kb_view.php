<?php ob_start(); ?>

<h2><?= htmlspecialchars($article['title']) ?></h2>

<div class="card">
    <p><?= nl2br(htmlspecialchars($article['content'])) ?></p>
    <p><strong>Tags:</strong> <?= htmlspecialchars($article['tags']) ?></p>
    <p><strong>Autor:</strong> <?= htmlspecialchars($article['author_name']) ?></p>
</div>

<a href="index.php?action=knowledge">← Volver</a>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>