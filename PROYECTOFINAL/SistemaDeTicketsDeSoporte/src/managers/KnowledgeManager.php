<?php

require_once __DIR__ . '/../Database.php';
require_once __DIR__ . '/../Models/Knowledge.php';

class KnowledgeManager {

    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    // =========================
    // LISTAR ARTÍCULOS
    // =========================
    public function getAll(): array {
        $stmt = $this->db->query("
            SELECT k.*, u.name AS author
            FROM knowledge_base k
            JOIN users u ON k.created_by = u.id
            ORDER BY k.created_at DESC
        ");
        return $stmt->fetchAll();
    }

    // =========================
    // OBTENER ARTÍCULO
    // =========================
    public function getById(int $id): ?array {
        $stmt = $this->db->prepare("
            SELECT k.*, u.name AS author
            FROM knowledge_base k
            JOIN users u ON k.created_by = u.id
            WHERE k.id = :id
        ");
        $stmt->execute([':id' => $id]);
        $article = $stmt->fetch();
        return $article ?: null;
    }

    // =========================
    // CREAR ARTÍCULO
    // =========================
    public function save(array $data): void {

        $stmt = $this->db->prepare("
            INSERT INTO knowledge_base (title, content, tags, created_by)
            VALUES (:title, :content, :tags, :user)
        ");

        $stmt->execute([
            ':title' => trim($data['title']),
            ':content' => trim($data['content']),
            ':tags' => trim($data['tags']),
            ':user' => $_SESSION['user_id'] ?? null,
        ]);

        header('Location: index.php?action=knowledge');
        exit;
    }
}
?>