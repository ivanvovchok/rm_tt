<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use Config\Database;
use PDO;

class UserRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    /**
     * @param array<string, mixed> $data
     */
    public function create(array $data): bool
    {
        $statement = $this->db->prepare('
            INSERT INTO users (first_name, last_name, email, phone, password)
            VALUES (:first_name, :last_name, :email, :phone, :password)
        ');

        return $statement->execute([
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'email'      => $data['email'],
            'phone'      => $data['phone'],
            'password'   => password_hash($data['password'], PASSWORD_DEFAULT)
        ]);
    }

    public function findByEmail(string $email): ?User
    {
        $statement = $this->db->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
        $statement->execute(['email' => $email]);

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        $user = new User();

        foreach ($row as $key => $value) {
            $user->$key = $value;
        }

        return $user;
    }

    public function existsByEmail(string $email): bool
    {
        $statement = $this->db->prepare('SELECT COUNT(*) FROM users WHERE email = :email');
        $statement->execute(['email' => $email]);

        return $statement->fetchColumn() > 0;
    }

}
