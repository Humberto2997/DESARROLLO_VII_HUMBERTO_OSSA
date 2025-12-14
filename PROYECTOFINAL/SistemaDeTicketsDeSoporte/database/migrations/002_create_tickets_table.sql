CREATE TABLE IF NOT EXISTS tickets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,

    priority ENUM('Baja','Media','Alta','Critica') 
        NOT NULL DEFAULT 'Media',

    status ENUM('Abierto','En Progreso','Resuelto','Cerrado') 
        NOT NULL DEFAULT 'Abierto',

    requester_id INT NOT NULL,
    assigned_to INT NULL,

    sla_hours INT NOT NULL DEFAULT 48,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_ticket_requester 
        FOREIGN KEY (requester_id) REFERENCES users(id),

    CONSTRAINT fk_ticket_assigned 
        FOREIGN KEY (assigned_to) REFERENCES users(id)
);
