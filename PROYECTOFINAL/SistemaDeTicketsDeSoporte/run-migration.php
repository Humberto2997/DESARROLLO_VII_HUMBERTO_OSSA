<?php
require __DIR__ . '/config.php';
require __DIR__ . '/database/MigrationManager.php';

// Crear instancia del manejador de migraciones
$migration = new MigrationManager(DB_HOST, DB_PORT, DB_USER, DB_PASS);

try {
    // Crear base de datos si no existe
    $migration->createDatabaseIfNotExists(DB_DATABASE);

    // Ejecutar migraciones dentro de /database/migrations
    $migration->runMigrations(__DIR__ . '/database/migrations');

    echo " Migraciones ejecutadas correctamente.\n";

} catch (Exception $e) {
    echo " Error en migraciones: " . $e->getMessage() . "\n";
}

?>