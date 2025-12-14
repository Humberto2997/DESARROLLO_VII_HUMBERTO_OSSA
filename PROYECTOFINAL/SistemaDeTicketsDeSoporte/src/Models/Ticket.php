<?php

class Ticket {
    public ?int $id;
    public string $title;
    public string $description;
    public string $priority; // 'Baja','Media','Alta','Critica'
    public string $status;   // 'Abierto','En Progreso','Resuelto','Cerrado'
    public int $requester_id;
    public ?int $assigned_to;
    public int $sla_hours;
    public ?string $created_at;
    public ?string $updated_at;

    public function __construct(array $data = []) {
        $this->id = $data['id'] ?? null;
        $this->title = $data['title'] ?? '';
        $this->description = $data['description'] ?? '';
        $this->priority = $data['priority'] ?? 'Media';
        $this->status = $data['status'] ?? 'Abierto';
        $this->requester_id = isset($data['requester_id']) ? (int)$data['requester_id'] : 0;
        $this->assigned_to = isset($data['assigned_to']) ? (int)$data['assigned_to'] : null;
        $this->sla_hours = isset($data['sla_hours']) ? (int)$data['sla_hours'] : 48;
        $this->created_at = $data['created_at'] ?? null;
        $this->updated_at = $data['updated_at'] ?? null;
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'priority' => $this->priority,
            'status' => $this->status,
            'requester_id' => $this->requester_id,
            'assigned_to' => $this->assigned_to,
            'sla_hours' => $this->sla_hours,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    public function validate(): array {
        $errors = [];
        if (trim($this->title) === '') $errors[] = 'El título es requerido.';
        if (trim($this->description) === '') $errors[] = 'La descripción es requerida.';
        if ($this->requester_id <= 0) $errors[] = 'El ID del solicitante es inválido.';
        $allowedPriorities = ['Baja','Media','Alta','Critica'];
        if (!in_array($this->priority, $allowedPriorities)) $errors[] = 'Prioridad inválida.';
        $allowedStatus = ['Abierto','En Progreso','Resuelto','Cerrado'];
        if (!in_array($this->status, $allowedStatus)) $errors[] = 'Estado inválido.';
        return $errors;
    }
}
?>