<?php

class User {
    public ?int $id;
    public string $username;
    private ?string $passwordHash; 
    public ?string $name;
    public ?string $role; // 'Administrador', 'Tecnico', 'Cliente'
    public ?string $email;
    public ?string $created_at;

    public function __construct(array $data = []) {
        $this->id = $data['id'] ?? null;
        $this->username = $data['username'] ?? '';
        $this->passwordHash = $data['password'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->role = $data['role'] ?? 'Cliente';
        $this->email = $data['email'] ?? null;
        $this->created_at = $data['created_at'] ?? null;
    }

    // Para establecer contraseña 
    public function setPassword(string $plain): void {
        $this->passwordHash = password_hash($plain, PASSWORD_DEFAULT);
    }

    // Verificar contraseña contra el hash
    public function verifyPassword(string $plain): bool {
        if ($this->passwordHash === null) return false;
        return password_verify($plain, $this->passwordHash);
    }

    // Obtener array listo para insertar/actualizar en DB
    public function toArray(): array {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'password' => $this->passwordHash,
            'name' => $this->name,
            'role' => $this->role,
            'email' => $this->email,
            'created_at' => $this->created_at,
        ];
    }

    // Validaciones simples
    public function validate(): array {
        $errors = [];
        if (trim($this->username) === '') $errors[] = 'El usuario es requerido.';
        if ($this->id === null && $this->passwordHash === null) $errors[] = 'La contraseña es requerida para un nuevo usuario.';
        if ($this->name === null || trim($this->name) === '') $errors[] = 'El nombre es requerido.';
        return $errors;
    }
}
?>