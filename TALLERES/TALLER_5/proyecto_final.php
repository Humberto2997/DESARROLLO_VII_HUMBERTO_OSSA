<?php

// Clase Estudiante
class Estudiante {
    private $id;
    private $nombre;
    private $edad;
    private $carrera;
    private $materias; // Arreglo de materias con calificaciones

    public function __construct($id, $nombre, $edad, $carrera) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->edad = $edad;
        $this->carrera = $carrera;
        $this->materias = [];
    }

    public function agregarMateria($materia, $calificacion) {
        $this->materias[$materia] = $calificacion;
    }

    public function obtenerPromedio() {
        if (count($this->materias) === 0) {
            return 0;
        }
        return array_sum($this->materias) / count($this->materias);
    }

    public function obtenerDetalles() {
        return [
            "ID" => $this->id,
            "Nombre" => $this->nombre,
            "Edad" => $this->edad,
            "Carrera" => $this->carrera,
            "Materias" => $this->materias,
            "Promedio" => $this->obtenerPromedio()
        ];
    }

    // Implementamos __toString para facilitar la impresión del objeto
    public function __toString() {
        return "ID: $this->id, Nombre: $this->nombre, Edad: $this->edad, Carrera: $this->carrera, Promedio: " . number_format($this->obtenerPromedio(), 2);
    }
}

// Clase SistemaGestionEstudiantes
class SistemaGestionEstudiantes {
    private $estudiantes;
    private $graduados;

    public function __construct() {
        $this->estudiantes = [];
        $this->graduados = [];
    }

    public function agregarEstudiante(Estudiante $estudiante) {
        $this->estudiantes[$estudiante->obtenerDetalles()['ID']] = $estudiante;
    }

    public function obtenerEstudiante($id) {
        return $this->estudiantes[$id] ?? null;
    }

    public function listarEstudiantes() {
        return $this->estudiantes;
    }

    public function calcularPromedioGeneral() {
        if (count($this->estudiantes) === 0) return 0;

        $totalPromedios = array_map(function ($estudiante) {
            return $estudiante->obtenerPromedio();
        }, $this->estudiantes);

        return array_sum($totalPromedios) / count($totalPromedios);
    }

    public function obtenerEstudiantesPorCarrera($carrera) {
        return array_filter($this->estudiantes, function($estudiante) use ($carrera) {
            return $estudiante->obtenerDetalles()['Carrera'] === $carrera;
        });
    }

    public function obtenerMejorEstudiante() {
        if (empty($this->estudiantes)) return null;

        return array_reduce($this->estudiantes, function ($mejor, $estudiante) {
            return ($estudiante->obtenerPromedio() > $mejor->obtenerPromedio()) ? $estudiante : $mejor;
        });
    }

    public function generarReporteRendimiento() {
        $materias = [];
        foreach ($this->estudiantes as $estudiante) {
            foreach ($estudiante->obtenerDetalles()['Materias'] as $materia => $calificacion) {
                if (!isset($materias[$materia])) {
                    $materias[$materia] = [];
                }
                $materias[$materia][] = $calificacion;
            }
        }

        $reporte = [];
        foreach ($materias as $materia => $calificaciones) {
            $reporte[$materia] = [
                "Promedio" => array_sum($calificaciones) / count($calificaciones),
                "Calificación más alta" => max($calificaciones),
                "Calificación más baja" => min($calificaciones)
            ];
        }

        return $reporte;
    }

    public function graduarEstudiante($id) {
        if (isset($this->estudiantes[$id])) {
            $this->graduados[] = $this->estudiantes[$id];
            unset($this->estudiantes[$id]);
        }
    }

    public function generarRanking() {
        uasort($this->estudiantes, function($a, $b) {
            return $b->obtenerPromedio() <=> $a->obtenerPromedio();
        });

        return $this->estudiantes;
    }
}

// Zona de prueba
$sistema = new SistemaGestionEstudiantes();

// Creando estudiantes
$estudiante1 = new Estudiante(1, "Carlos Pérez", 21, "Ingeniería Informática");
$estudiante2 = new Estudiante(2, "María García", 22, "Ingeniería Civil");
$estudiante3 = new Estudiante(3, "Ana López", 23, "Ingeniería Industrial");

// Agregando materias y calificaciones
$estudiante1->agregarMateria("Matemáticas", 85);
$estudiante1->agregarMateria("Física", 90);

$estudiante2->agregarMateria("Química", 88);
$estudiante2->agregarMateria("Álgebra", 92);

$estudiante3->agregarMateria("Estadística", 95);
$estudiante3->agregarMateria("Cálculo", 87);

// Añadiendo estudiantes al sistema
$sistema->agregarEstudiante($estudiante1);
$sistema->agregarEstudiante($estudiante2);
$sistema->agregarEstudiante($estudiante3);

// Listar estudiantes
echo "Lista de estudiantes:\n";
foreach ($sistema->listarEstudiantes() as $estudiante) {
    echo $estudiante . "\n";
}

// Calcular promedio general
echo "\nPromedio general de estudiantes: " . number_format($sistema->calcularPromedioGeneral(), 2) . "\n";

// Mejor estudiante
$mejorEstudiante = $sistema->obtenerMejorEstudiante();
echo "\nMejor estudiante: " . $mejorEstudiante->obtenerDetalles()['Nombre'] . " con promedio " . number_format($mejorEstudiante->obtenerPromedio(), 2) . "\n";

// Generar reporte de rendimiento
echo "\nReporte de rendimiento:\n";
$reporte = $sistema->generarReporteRendimiento();
foreach ($reporte as $materia => $detalles) {
    echo "$materia - Promedio: " . number_format($detalles['Promedio'], 2) . ", Alta: {$detalles['Calificación más alta']}, Baja: {$detalles['Calificación más baja']}\n";
}

// Generar ranking
echo "\nRanking de estudiantes:\n";
$ranking = $sistema->generarRanking();
foreach ($ranking as $estudiante) {
    echo $estudiante . "\n";
}

?>
