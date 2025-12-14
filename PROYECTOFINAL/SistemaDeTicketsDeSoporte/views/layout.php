<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema de Tickets</title>

  <!-- CSS -->
  <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/css/style.css">
</head>
<body>

<header class="site-header">
  <div class="container header-row">

    <div class="brand">
      <a href="<?= BASE_URL ?>/index.php">
        <h1>Portal de Soporte</h1>
      </a>
    </div>

    <nav class="main-nav">

      <a href="<?= BASE_URL ?>/index.php?action=tickets">
        <img src="<?= BASE_URL ?>/public/assets/img/icon_ticket.svg" width="16">
        Tickets
      </a>

      <a href="<?= BASE_URL ?>/index.php?action=ticket_new">
        <img src="<?= BASE_URL ?>/public/assets/img/icon_support.svg" width="16">
        Crear Ticket
      </a>

      <a href="<?= BASE_URL ?>/index.php?action=knowledge">
        <img src="<?= BASE_URL ?>/public/assets/img/icon_book.svg" width="16">
        Base de Conocimiento
      </a>

      <a href="<?= BASE_URL ?>/index.php?action=sla_metrics">
        <img src="<?= BASE_URL ?>/public/assets/img/icon_ticket.svg" width="16">
        SLA
      </a>

      <?php if (!empty($_SESSION['user_id'])): ?>
        <span class="user">
          Hola, <?= htmlspecialchars($_SESSION['name'] ?? $_SESSION['username']) ?>
          (<?= htmlspecialchars($_SESSION['role'] ?? '') ?>)
        </span>

        <a href="<?= BASE_URL ?>/index.php?action=logout">
          <img src="<?= BASE_URL ?>/public/assets/img/icon_home.svg" width="16">
          Cerrar sesión
        </a>
      <?php else: ?>
        <a href="<?= BASE_URL ?>/index.php?action=login">
          <img src="<?= BASE_URL ?>/public/assets/img/icon_home.svg" width="16">
          Iniciar sesión
        </a>
      <?php endif; ?>

    </nav>
  </div>
</header>

<main class="container">
  <?= $content ?? '' ?>
</main>

<footer class="site-footer">
  <div class="container">
    © <?= date('Y') ?> Sistema de Tickets
  </div>
</footer>

<!-- JS -->
<script src="<?= BASE_URL ?>/public/assets/js/main.js"></script>

</body>
</html>
