<?php

declare(strict_types=1);

namespace App\Models;

class User
{
    public int $id;
    public string $first_name;
    public string $last_name;
    public string $email;
    public string $phone;
    public string $password;
    public string $created_at;
    public string $updated_at;

}
