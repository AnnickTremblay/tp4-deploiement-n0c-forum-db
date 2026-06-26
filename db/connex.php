<?php

$envPath = __DIR__ . '/../.env';

if (!file_exists($envPath)) {
    die("Erreur : le fichier .env est manquant.");
}

$env = parse_ini_file($envPath);

$host = $env['DB_HOST'] ?? 'localhost';
$dbname = $env['DB_NAME'] ?? '';
$user = $env['DB_USER'] ?? '';
$password = $env['DB_PASS'] ?? '';
$charset = $env['DB_CHARSET'] ?? 'utf8mb4';

$connex = mysqli_connect($host, $user, $password, $dbname);

if (!$connex) {
    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
}

mysqli_set_charset($connex, $charset);

?>