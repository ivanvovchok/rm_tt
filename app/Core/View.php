<?php

declare(strict_types=1);

namespace App\Core;

class View
{
    /**
     * @param array<string, mixed> $params
     */
    public static function render(string $view, array $params = []): void
    {
        extract($params);

        ob_start();
        include __DIR__ . '/../Views/' . $view . '.php';
        $content = ob_get_clean();

        include __DIR__ . '/../Views/layouts/main.php';
    }
}
