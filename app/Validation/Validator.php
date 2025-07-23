<?php

declare(strict_types=1);

namespace App\Validation;

use App\Core\Lang;

class Validator
{
    public function validateEmail(string $email): ?string
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return Lang::get('invalid_email');
        }
        return null;
    }

    public function validatePhone(string $phone): ?string
    {
        if (!preg_match('/^\+?[0-9]{7,15}$/', $phone)) {
            return Lang::get('invalid_phone');
        }
        return null;
    }

    public function validatePassword(string $password): ?string
    {
        if (strlen($password) < 8) {
            return Lang::get('invalid_password');
        }
        return null;
    }
}
