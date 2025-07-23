<?php

declare(strict_types=1);

use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Core\View;

$routes = [
    'GET' => [
        '/'         => [HomeController::class, 'index'],
        '/register' => [AuthController::class, 'showRegisterForm'],
        '/login'    => [AuthController::class, 'showLoginForm'],
    ],
    'POST' => [
        '/register' => [AuthController::class, 'register'],
        '/login'    => [AuthController::class, 'login'],
        '/logout'   => [AuthController::class, 'logout'],
    ],
];

$uri    = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

if (isset($routes[$method][$uri])) {
    [$class, $action] = $routes[$method][$uri];
    new $class()->$action();
} else {
    http_response_code(404);
    View::render('errors/404', ['title' => 'Page not found']);
}
