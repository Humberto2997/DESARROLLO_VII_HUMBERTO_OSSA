<?php ob_start(); ?>

<h2>Nuevo Artículo</h2>

<form method="post" action="index.php?action=kb_save">

    <label>Título
        <input type="text" name="title" required>
    </label>

    <label>Contenido
        <textarea name="content" rows="6" required></textarea>
    </label>

    <label>Tags
        <input type="text" name="tags">
    </label>

    <button type="submit">Guardar</button>
</form>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>