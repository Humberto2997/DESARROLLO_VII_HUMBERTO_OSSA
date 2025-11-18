<?php
function validarUsuario($usuario) {
    return  strlen($usuario) >= 3 ;
}

function validarContrasena($contrasena){
  return strlen($contrasena) >= 5;
}

?>