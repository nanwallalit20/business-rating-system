<?php
declare(strict_types=1);

class Database
{
    private static ?PDO $connection = null;

    private function __construct() {}
    private function __clone() {}

    public static function connect(): PDO
    {
        if (self::$connection === null) {

            $host = 'localhost';
            $db   = 'business_rating_system';
            $user = 'root';
            $pass = 'Admin'; // change if required
            $charset = 'utf8mb4';

            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            try {
                self::$connection = new PDO($dsn, $user, $pass, $options);
            } catch (PDOException $e) {
                // Fail fast, fail safe
                http_response_code(500);
                echo json_encode([
                    'status' => false,
                    'message' => 'Database connection failed'
                ]);
                exit;
            }
        }

        return self::$connection;
    }
}
