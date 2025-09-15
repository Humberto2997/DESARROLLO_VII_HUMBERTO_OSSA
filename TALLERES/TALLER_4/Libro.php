<?php
class Libro {
    public $titulo;
    public $autor;
    public $anioPublicacion;

    public function __construct($titulo, $autor, $anioPublicacion) {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->anioPublicacion = $anioPublicacion;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = trim($titulo);
    }

    public function getAutor() {
        return $this->autor;
    }

    public function setAutor($autor) {
        $this->autor = trim($autor);
    }

    public function getAnioPublicacion() {
        return $this->anioPublicacion;
    }

    public function setAnioPublicacion($anio) {
        $this->anioPublicacion = intval($anio);
    }

    public function obtenerInformacion() {
        return "'{$this->titulo}' por {$this->autor}, publicado en {$this->anioPublicacion}";
    }
}

// Ejemplo de uso
$miLibro = new Libro("  El Quijote  ", "Miguel de Cervantes", "1605");
echo $miLibro->obtenerInformacion();
echo "\nTítulo: " . $miLibro->getTitulo();
?>