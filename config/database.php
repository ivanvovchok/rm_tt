<?php

declare(strict_types=1);

namespace Config;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $connection = null;

    public static function connect(): PDO
    {
        if (self::$connection === null) {
            $dotenvPath = dirname(__DIR__) . '/.env';

            if (file_exists($dotenvPath)) {
                $lines = file($dotenvPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

                foreach ($lines as $line) {
                    if (str_starts_with(trim($line), '#')) {
                        continue;
                    }

                    [$name, $value]    = explode('=', $line, 2);
                    $_ENV[trim($name)] = trim($value);
                }
            }

            $host     = $_ENV['DB_HOST'];
            $port     = $_ENV['DB_PORT'];
            $dbname   = $_ENV['DB_DATABASE'];
            $username = $_ENV['DB_USERNAME'];
            $password = $_ENV['DB_PASSWORD'];

            try {
                self::$connection = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $username, $password);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Database connection failed: ' . $e->getMessage());
            }
        }

        return self::$connection;
    }
}
