<?php

declare(strict_types=1);

namespace App\DTO;

class RegisterData
{
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $phone;
    public string $password;

    /**
     * @param array<string, mixed> $data
     */
    public function __construct(array $data)
    {
        $this->firstName = trim($data['first_name'] ?? '');
        $this->lastName  = trim($data['last_name'] ?? '');
        $this->email     = trim($data['email'] ?? '');
        $this->phone     = trim($data['phone'] ?? '');
        $this->password  = $data['password'] ?? '';
    }
}
