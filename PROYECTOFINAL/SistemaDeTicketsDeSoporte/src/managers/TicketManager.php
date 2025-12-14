<?php

require_once __DIR__ . '/../Database.php';
require_once __DIR__ . '/../Models/Ticket.php';

class TicketManager {

    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    // =========================
    // OBTENER TODOS LOS TICKETS
    // =========================
    public function getAll(): array {
        $stmt = $this->db->query("
            SELECT t.*, u.name AS requester_name
            FROM tickets t
            JOIN users u ON t.requester_id = u.id
            ORDER BY t.created_at DESC
        ");
        return $stmt->fetchAll();
    }

    // =========================
    // OBTENER TICKET POR ID
    // =========================
    public function getById(int $id): ?array {
        $stmt = $this->db->prepare("
            SELECT * FROM tickets WHERE id = :id
        ");
        $stmt->execute([':id' => $id]);
        $ticket = $stmt->fetch();
        return $ticket ?: null;
    }

    // =========================
    // CREAR TICKET
    // =========================
    public function save(array $data): void {

        $ticket = new Ticket($data);
        $errors = $ticket->validate();

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            header('Location: index.php?action=ticket_new');
            exit;
        }

        $stmt = $this->db->prepare("
            INSERT INTO tickets 
            (title, description, priority, requester_id, sla_hours)
            VALUES (:title, :description, :priority, :requester_id, :sla_hours)
        ");

        $stmt->execute([
            ':title' => $ticket->title,
            ':description' => $ticket->description,
            ':priority' => $ticket->priority,
            ':requester_id' => $ticket->requester_id,
            ':sla_hours' => $ticket->sla_hours,
        ]);

        header('Location: index.php?action=tickets');
        exit;
    }

    // =========================
    // ASIGNAR TÉCNICO
    // =========================
    public function assign(int $ticketId, int $technicianId): void {

        $stmt = $this->db->prepare("
            UPDATE tickets 
            SET assigned_to = :tech, status = 'En Progreso'
            WHERE id = :id
        ");

        $stmt->execute([
            ':tech' => $technicianId,
            ':id' => $ticketId,
        ]);

        header('Location: index.php?action=ticket_view&id=' . $ticketId);
        exit;
    }

    // =========================
    // CAMBIAR ESTADO
    // =========================
    public function changeStatus(int $ticketId, string $status, ?string $notes = null): void {

        $stmt = $this->db->prepare("
            UPDATE tickets SET status = :status WHERE id = :id
        ");

        $stmt->execute([
            ':status' => $status,
            ':id' => $ticketId,
        ]);

        // Historial
        $stmt = $this->db->prepare("
            INSERT INTO ticket_status_history
            (ticket_id, status, notes, changed_by)
            VALUES (:ticket, :status, :notes, :user)
        ");

        $stmt->execute([
            ':ticket' => $ticketId,
            ':status' => $status,
            ':notes' => $notes,
            ':user' => $_SESSION['user_id'] ?? null,
        ]);

        header('Location: index.php?action=ticket_view&id=' . $ticketId);
        exit;
    }
}
?>