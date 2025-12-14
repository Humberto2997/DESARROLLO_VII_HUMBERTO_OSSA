CREATE TABLE IF NOT EXISTS ticket_status_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ticket_id INT NOT NULL,
    old_status ENUM('Abierto','En Progreso','Resuelto','Cerrado') NOT NULL,
    new_status ENUM('Abierto','En Progreso','Resuelto','Cerrado') NOT NULL,
    notes TEXT NULL,

    changed_by INT NULL,
    changed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_history_ticket
        FOREIGN KEY (ticket_id)
        REFERENCES tickets(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_history_user
        FOREIGN KEY (changed_by)
        REFERENCES users(id)
        ON DELETE SET NULL
);
