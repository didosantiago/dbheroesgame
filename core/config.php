<?php
    // Arquivo de Configuração do Banco de Dados e Sistema

    // define('DB_HOST', '127.0.0.1');
    // define('DB_DATABASE', 'db');
    // define('DB_USER', 'root');
    // define('DB_PASS', '');

    // define('DEBUG', 'false');
    
    // date_default_timezone_set('America/Sao_Paulo');
    
    // define('BASE', 'http://localhost/dbh/');


// Database Configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'dbheroes');
define('DB_USER', 'root');
define('DB_PASS', '');

// Site Configuration - FIXED PORT
define('BASE', 'http://127.0.0.1:8080/dbheroes/');

// PagSeguro Configuration
$config = new stdClass();
$config->PAGSEGURO_ENV = 'sandbox';
$config->PAGSEGURO_EMAIL = 'seu_email@example.com';
$config->PAGSEGURO_TOKEN = 'seu_token_aqui';

// Database Connection
class DB {
    private static $instance = null;
    
    public static function getInstance() {
        if (self::$instance === null) {
            try {
                self::$instance = new PDO(
                    'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
                    DB_USER,
                    DB_PASS,
                    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
                );
            } catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
    
    public static function prepare($sql) {
        return self::getInstance()->prepare($sql);
    }
}
?>

