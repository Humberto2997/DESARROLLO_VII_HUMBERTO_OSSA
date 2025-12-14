<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
ob_start();
?>

<h2>Iniciar Sesión</h2>

<?php if (!empty($_SESSION['error'])): ?>
    <div class="alert alert-error">
        <?= htmlspecialchars($_SESSION['error']) ?>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<form method="post" action="<?= BASE_URL ?>/index.php?action=do_login">

    <label>
        Usuario
        <input type="text" name="username" required>
    </label>

    <label>
        Contraseña
        <input type="password" name="password" required>
    </label>

    <button type="submit">Ingresar</button>
</form>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
