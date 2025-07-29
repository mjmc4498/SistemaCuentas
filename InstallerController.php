<?php
class InstallerController {
    public function install() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // 1. Crear archivo .env
            $env_content = "DB_HOST={$_POST['db_host']}\n";
            $env_content .= "DB_NAME={$_POST['db_name']}\n";
            $env_content .= "DB_USER={$_POST['db_user']}\n";
            $env_content .= "DB_PASS={$_POST['db_pass']}\n";
            file_put_contents('.env', $env_content);

            // 2. Conectar a la BD e importar schema.sql
            try {
                $pdo = new PDO("mysql:host={$_POST['db_host']}", $_POST['db_user'], $_POST['db_pass']);
                $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$_POST['db_name']}`");
                $pdo->exec("USE `{$_POST['db_name']}`");
                $sql = file_get_contents('schema.sql');
                $pdo->exec($sql);
            } catch (PDOException $e) {
                die("Error de base de datos: " . $e->getMessage());
            }

            // 3. Crear el primer usuario administrador
            require_once 'models/User.php';
            $userModel = new User($pdo);
            $userModel->create(
                $_POST['admin_user'],
                $_POST['admin_email'],
                $_POST['admin_pass'],
                'admin'
            );

            // 4. Eliminar archivos de instalación
            unlink('install.php');
            unlink('InstallerController.php');

            echo "¡Instalación completada! Por favor, elimina este archivo.";
        }
    }
}

$installer = new InstallerController();
$installer->install();
?>
