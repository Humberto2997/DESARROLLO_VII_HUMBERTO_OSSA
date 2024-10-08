<?php
function obtenerTituloPagina($pagina) {
    $titulos = [
        'inicio' => 'Página de Inicio',
        'sobre_nosotros' => 'Sobre Nosotros',
        'contacto' => 'Contáctanos'
    ];
    return isset($titulos[$pagina]) ? $titulos[$pagina] : 'Página Desconocida';
}

function generarMenu($paginaActual) {
    $menu = [
        'inicio' => 'Inicio',
        'sobre_nosotros' => 'Sobre Nosotros',
        'contacto' => 'Contacto'
    ];
    
    $html = '<nav><ul>';
    foreach ($menu as $pagina => $titulo) {
        $clase = ($pagina === $paginaActual) ? ' class="activo"' : '';
        //Este cpdigo genero error en la concatenacion
        //$html .= "<li><a href="$pagina.php"$clase>$titulo</a></li>"; 
        
        //Se modifico por este
        $html .= '<li><a href="' . $pagina . '.php"' . $clase . '>' . $titulo . '</a></li>';
    }
    $html .= '</ul></nav>';
    return $html;
}
?>