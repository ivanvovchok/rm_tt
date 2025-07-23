<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Auth;
use App\Core\View;
use App\DTO\LoginData;
use App\DTO\RegisterData;
use App\Services\AuthService;

readonly class AuthController
{
    public function __construct(
        private AuthService $authService = new AuthService()
    ) {
    }
    public function showRegisterForm(): void
    {
        Auth::redirectIfAuthenticated();

        View::render('auth/register', ['title' => 'Register', 'errors' => []]);
    }

    public function register(): void
    {
        $this->verifyCsrf();

        $data = new RegisterData($_POST);

        $errors = $this->authService->validateRegistration($data);

        if (!empty($errors)) {
            View::render('auth/register', ['title' => 'Register', 'errors' => $errors]);

            return;
        }

        $this->authService->register($data);

        header('Location: /login');

        exit;
    }

    public function showLoginForm(): void
    {
        Auth::redirectIfAuthenticated();

        View::render('auth/login', ['title' => 'Login', 'errors' => []]);
    }

    public function login(): void
    {
        $this->verifyCsrf();

        $data   = new LoginData($_POST);
        $errors = $this->authService->login($data);

        if (!empty($errors)) {
            View::render('auth/login', ['title' => 'Login', 'errors' => $errors]);

            return;
        }

        header('Location: /');

        exit;
    }

    public function logout(): void
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /');

            exit;
        }

        session_unset();
        session_destroy();
        header('Location: /');

        exit;
    }

    private function verifyCsrf(): void
    {
        if (!isset($_POST['_csrf'], $_SESSION['_csrf']) || $_POST['_csrf'] !== $_SESSION['_csrf']) {
            http_response_code(419);
            exit('CSRF token mismatch.');
        }
    }

}
