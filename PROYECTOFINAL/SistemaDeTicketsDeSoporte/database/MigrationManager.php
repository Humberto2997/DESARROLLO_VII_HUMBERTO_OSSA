<?php
class MigrationManager {

    private $host;
    private $port;
    private $user;
    private $pass;
    private $pdo;

    public function __construct($host, $port, $user, $pass) {
        $this->host = $host;
        $this->port = $port;
        $this->user = $user;
        $this->pass = $pass;

        // conexión inicial sin base de datos
        $this->pdo = new PDO(
            "mysql:host={$host};port={$port}",
            $user,
            $pass,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }

    /**
     * Crear base de datos si no existe
     */
    public function createDatabaseIfNotExists($dbname) {
        $this->pdo->exec(
            "CREATE DATABASE IF NOT EXISTS `{$dbname}` 
             CHARACTER SET utf8mb4 
             COLLATE utf8mb4_unicode_ci"
        );
    }

    /**
     * Ejecutar migraciones (archivos SQL)
     */
    public function runMigrations($dir) {

        // conectar AHORA a la base de datos creada
        $pdoDb = new PDO(
            "mysql:host={$this->host};dbname=" . DB_DATABASE . ";port={$this->port};charset=utf8mb4",
            $this->user,
            $this->pass,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );

        // obtener archivos SQL
        $files = glob(rtrim($dir, "/") . "/*.sql");
        sort($files); // orden ascendente (001, 002, ...)

        foreach ($files as $file) {

            $sql = file_get_contents($file);

            /**
             * Reemplazo de contraseñas en seed_data.sql
             */
            $sql = str_replace(':admin_pwd',  $pdoDb->quote(password_hash('Admin#123', PASSWORD_DEFAULT)), $sql);

            $sql = str_replace(':tech1_pwd',  $pdoDb->quote(password_hash('Tech#111', PASSWORD_DEFAULT)), $sql);
            $sql = str_replace(':tech2_pwd',  $pdoDb->quote(password_hash('Tech#222', PASSWORD_DEFAULT)), $sql);
            $sql = str_replace(':tech3_pwd',  $pdoDb->quote(password_hash('Tech#333', PASSWORD_DEFAULT)), $sql);

            $sql = str_replace(':client1_pwd', $pdoDb->quote(password_hash('Client#111', PASSWORD_DEFAULT)), $sql);
            $sql = str_replace(':client2_pwd', $pdoDb->quote(password_hash('Client#222', PASSWORD_DEFAULT)), $sql);
            $sql = str_replace(':client3_pwd', $pdoDb->quote(password_hash('Client#333', PASSWORD_DEFAULT)), $sql);

            try {
                $pdoDb->exec($sql);
                echo "✔ Ejecutado: " . basename($file) . PHP_EOL;
            } catch (Exception $e) {
                echo "❌ Error ejecutando " . basename($file) . ": " . $e->getMessage() . PHP_EOL;
                exit;
            }
        }

        echo PHP_EOL . "Migraciones ejecutadas con éxito." . PHP_EOL;
    }
}
