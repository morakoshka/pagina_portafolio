<?php
// Ajusta user/password si has cambiado los datos de XAMPP
$DB_HOST = '127.0.0.1';
$DB_NAME = 'pagina_inicio_db';
$DB_USER = 'root';
$DB_PASS = '';

try {
    $pdo = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4", $DB_USER, $DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo "DB error: " . $e->getMessage();
    exit;
}
?>