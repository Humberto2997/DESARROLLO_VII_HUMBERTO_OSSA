<?php

function sanitizarUsuario($usuario) {
    return htmlspecialchars(trim($usuario), ENT_QUOTES, 'UTF-8');
}

function sanitizarContrasena($contrasena) {
    return htmlspecialchars(trim($contrasena), ENT_QUOTES, 'UTF-8');
}


?>