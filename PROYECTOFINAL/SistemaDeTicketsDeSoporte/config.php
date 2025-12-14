<?php

define('DB_HOST', 'localhost');      
define('DB_PORT', '3306');           
define('DB_USER', 'root');           
define('DB_PASS', '');               
define('DB_DATABASE', 'sistema_tickets'); 


define('BASE_PATH', __DIR__);


$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$domain = $_SERVER['HTTP_HOST'] ?? 'localhost';
$folder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
define('BASE_URL', '/DESARROLLO_VII_HUMBERTO_OSSA/PROYECTOFINAL/SistemaDeTicketsDeSoporte');
?>
