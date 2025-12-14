<?php
require __DIR__ . '/config.php';
require __DIR__ . '/src/Database.php';
require __DIR__ . '/src/managers/UserManager.php';
require __DIR__ . '/src/managers/TicketManager.php';
require __DIR__ . '/src/managers/KnowledgeManager.php';
require __DIR__ . '/src/managers/TicketHistoryManager.php';

session_start();

$action = $_GET['action'] ?? 'home';

switch ($action) {

    case 'login':
        require __DIR__ . '/views/auth/login.php';
        break;

    case 'do_login':
        $manager = new UserManager();
        $manager->login($_POST['username'], $_POST['password']);
        break;

    case 'logout':
        $manager = new UserManager();
        $manager->logout();
        break;


    case 'tickets':
        $tm = new TicketManager();
        $tickets = $tm->getAll();  
        require __DIR__ . '/views/tickets_list.php';
        break;

    case 'ticket_new':
        require __DIR__ . '/views/tickets_form.php';
        break;

    case 'ticket_save':
        $tm = new TicketManager();
        $tm->save($_POST);
        break;

    case 'ticket_view':
        $tm = new TicketManager();
        $ticket = $tm->getById($_GET['id']); 
        require __DIR__ . '/views/tickets_view.php';
        break;

    case 'ticket_assign':
        $tm = new TicketManager();
        $tm->assign($_POST['ticket_id'], $_POST['assigned_to']);
        break;

    case 'ticket_status':
        $tm = new TicketManager();
        $tm->changeStatus($_POST['ticket_id'], $_POST['status'], $_POST['notes'] ?? null);
        break;


    case 'knowledge':
        $km = new KnowledgeManager();
        $articles = $km->getAll();
        require __DIR__ . '/views/knowledge/kb_list.php';
        break;

    case 'kb_view':
        $km = new KnowledgeManager();
        $article = $km->getById($_GET['id']);
        require __DIR__ . '/views/knowledge/kb_view.php';
        break;

    case 'kb_new':
        require __DIR__ . '/views/knowledge/kb_new.php';
        break;

    case 'kb_save':
        $km = new KnowledgeManager();
        $km->save($_POST);
        break;


    
    case 'sla_metrics':
        require __DIR__ . '/views/sla/metrics.php';
        break;

    default:
        require __DIR__ . '/views/home.php';
        break;
}
?>
