<?php
// Cargar variables de entorno desde .env
$env_path = __DIR__ . '/../.env';
if (file_exists($env_path)) {
    $lines = file($env_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        list($name, $value) = explode('=', $line, 2);
        $_ENV[trim($name)] = trim($value);
    }
}

// Configuración de la conexión a la base de datos
define('DB_HOST', $_ENV['DB_HOST'] ?? 'localhost');
define('DB_NAME', $_ENV['DB_NAME'] ?? 'nombre_base_de_datos');
define('DB_USER', $_ENV['DB_USER'] ?? 'usuario_base_de_datos');
define('DB_PASS', $_ENV['DB_PASS'] ?? 'contraseña_base_de_datos');
define('DB_CHARSET', $_ENV['DB_CHARSET'] ?? 'utf8mb4');

// Opciones de PDO
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// DSN (Data Source Name)
$dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;

try {
    // Crear una instancia de PDO
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
} catch (\PDOException $e) {
    // Si hay un error en la conexión, se muestra un mensaje y se termina el script
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// La variable $pdo ya está disponible para ser usada en otros scripts que incluyan este archivo.
?>
