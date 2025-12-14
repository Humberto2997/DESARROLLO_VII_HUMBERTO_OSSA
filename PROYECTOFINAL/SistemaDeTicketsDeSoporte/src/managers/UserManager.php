<?php

require_once __DIR__ . '/../Database.php';

class UserManager {

    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    // ============================
    // LOGIN
    // ============================
    public function login(string $username, string $password): void {

        $stmt = $this->db->prepare(
            "SELECT * FROM users WHERE username = :username LIMIT 1"
        );
        $stmt->execute([
            ':username' => $username
        ]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || !password_verify($password, $user['password'])) {
            $_SESSION['error'] = 'Usuario o contraseña incorrectos';
            header('Location: index.php?action=login');
            exit;
        }

        // Guardar datos en sesión
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = $user['role'];

        header('Location: index.php');
        exit;
    }

    public function logout(): void {
        session_destroy();
        header('Location: index.php');
        exit;
    }

    public function getTechnicians(): array {
        $stmt = $this->db->query(
            "SELECT id, name FROM users WHERE role = 'Tecnico'"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
