<?php
$host = 'localhost';
$db   = 'vivahub';
$user = 'root';
$pass = '';
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
    // If database doesn't exist, try to connect without dbname and create it
    try {
        $dsn_no_db = "mysql:host=$host;charset=$charset";
        $pdo = new PDO($dsn_no_db, $user, $pass, $options);
        $pdo->exec("CREATE DATABASE IF NOT EXISTS `$db`");
        $pdo->exec("USE `$db`");
        
        // Execute the sql file to create tables
        if (file_exists(__DIR__ . '/database.sql')) {
            $sql = file_get_contents(__DIR__ . '/database.sql');
            $pdo->exec($sql);
        }
        
    } catch (\PDOException $e2) {
         throw new \PDOException($e2->getMessage(), (int)$e2->getCode());
    }
}
?>
