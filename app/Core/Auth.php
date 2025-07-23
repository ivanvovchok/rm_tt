<?php

declare(strict_types=1);

namespace App\Core;

class Auth
{
    public static function redirectIfAuthenticated(): void
    {
        if (isset($_SESSION['user_id'])) {
            header('Location: /');
            exit;
        }
    }
}
