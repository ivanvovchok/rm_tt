<?php

declare(strict_types=1);

namespace App\DTO;

class LoginData
{
    public string $email;
    public string $password;

    /**
     * @param array<string, mixed> $data
     */
    public function __construct(array $data)
    {
        $this->email    = trim($data['email'] ?? '');
        $this->password = $data['password'] ?? '';
    }
}
