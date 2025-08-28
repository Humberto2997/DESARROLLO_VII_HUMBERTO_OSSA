<?php

function obtenerLibros() {
    return [
        [
            'titulo' => 'El Quijote',
            'autor' => 'Miguel de Cervantes',
            'anio_publicacion' => 1605,
            'genero' => 'Novela',
            'descripcion' => 'La historia del ingenioso hidalgo Don Quijote de la Mancha.'
        ],
        [
            'titulo' => 'Cien Años de Soledad',
            'autor' => 'Gabriel García Márquez',
            'anio_publicacion' => 1967,
            'genero' => 'Realismo Mágico',
            'descripcion' => 'La saga de la familia Buendía en el pueblo ficticio de Macondo.'
        ],
        [
            'titulo' => '1984',
            'autor' => 'George Orwell',
            'anio_publicacion' => 1949,
            'genero' => 'Distopía',
            'descripcion' => 'Una novela sobre vigilancia totalitaria y control social.'
        ],
        [
            'titulo' => 'Harry Potter y la Piedra Filosofal',
            'autor' => 'J.K. Rowling',
            'anio_publicacion' => 1997,
            'genero' => 'Fantasía',
            'descripcion' => 'La primera aventura del joven mago Harry Potter.'
        ],
        [
            'titulo' => 'El Señor de los Anillos: La Comunidad del Anillo',
            'autor' => 'J.R.R. Tolkien',
            'anio_publicacion' => 1954,
            'genero' => 'Fantasía',
            'descripcion' => 'La épica jornada para destruir el Anillo Único.'
        ]
    ];
}

function mostrarDetallesLibro($libro) {
    $html = '<div class="book-card">';
    $html .= '<h2>' . htmlspecialchars($libro['titulo']) . '</h2>';
    $html .= '<p><strong>Autor:</strong> ' . htmlspecialchars($libro['autor']) . '</p>';
    $html .= '<p><strong>Año de Publicación:</strong> ' . htmlspecialchars($libro['anio_publicacion']) . '</p>';
    $html .= '<p><strong>Género:</strong> ' . htmlspecialchars($libro['genero']) . '</p>';
    $html .= '<p><strong>Descripción:</strong> ' . htmlspecialchars($libro['descripcion']) . '</p>';
    $html .= '</div>';
    return $html;
}

?>