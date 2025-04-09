<?php
$host = 'sql212.infinityfree.com';
$db   = 'if0_38579426_election_db';
$user = 'if0_38579426';
$pass = 'AtyrWDfUeVsgtE';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            try {
                $pdo = new PDO($dsn, $user, $pass, $options);
                } catch (\PDOException $e) {
                    throw new \PDOException($e->getMessage(), (int)$e->getCode());
                    }

                    define('ENCRYPTION_KEY', 'my_secret_key_123');
                    define('ENCRYPTION_IV', substr(hash('sha256', ENCRYPTION_KEY), 0, 16));
                    ?>