<?php

declare(strict_types=1);

namespace App\Core;

class Lang
{
    /** @var array<string, string>|null */
    protected static ?array $lang = null;

    public static function get(string $key): string
    {
        if (self::$lang === null) {
            self::$lang = require __DIR__ . '/../../config/lang.php';
        }

        return self::$lang[$key] ?? $key;
    }
}
