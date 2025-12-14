<?php

class Knowledge {
    public ?int $id;
    public string $title;
    public string $content;
    public ?string $tags; 
    public ?int $created_by;
    public ?string $created_at;

    public function __construct(array $data = []) {
        $this->id = $data['id'] ?? null;
        $this->title = $data['title'] ?? '';
        $this->content = $data['content'] ?? '';
        $this->tags = $data['tags'] ?? null;
        $this->created_by = isset($data['created_by']) ? (int)$data['created_by'] : null;
        $this->created_at = $data['created_at'] ?? null;
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'tags' => $this->tags,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
        ];
    }

    public function validate(): array {
        $errors = [];
        if (trim($this->title) === '') $errors[] = 'El título es requerido.';
        if (trim($this->content) === '') $errors[] = 'El contenido es requerido.';
        return $errors;
    }

    // Convierte tags CSV a array
    public function tagsArray(): array {
        if (!$this->tags) return [];
        return array_filter(array_map('trim', explode(',', $this->tags)));
    }
}
?>
