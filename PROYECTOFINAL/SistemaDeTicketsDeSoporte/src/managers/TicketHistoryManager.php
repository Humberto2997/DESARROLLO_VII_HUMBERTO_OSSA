<?php

require_once __DIR__ . '/../Database.php';

class TicketHistoryManager {

    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    // ============================
    // OBTENER HISTORIAL DE UN TICKET
    // ============================
    public function getByTicket(int $ticketId): array {

        $stmt = $this->db->prepare("
            SELECT h.*, u.name AS user_name
            FROM ticket_status_history h
            LEFT JOIN users u ON h.changed_by = u.id
            WHERE h.ticket_id = :ticket
            ORDER BY h.changed_at ASC
        ");

        $stmt->execute([
            ':ticket' => $ticketId
        ]);

        return $stmt->fetchAll();
    }
}
?>