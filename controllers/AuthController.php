<?php
require_once '../includes/database.php';
require_once '../models/User.php';
require_once '../utils/Session.php';

Session::start();

class AuthController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new User($pdo);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->userModel->findByEmail($email);

            if ($user && password_verify($password, $user['password_hash'])) {
                // Iniciar sesión
                Session::set('user_id', $user['id']);
                Session::set('user_rol', $user['rol']);
                header('Location: ../views/dashboard.php');
                exit;
            } else {
                // Credenciales inválidas
                Session::set('error_message', 'Correo o contraseña incorrectos.');
                header('Location: ../views/login.php');
                exit;
            }
        }
    }

    public function logout() {
        Session::destroy();
        header('Location: ../views/login.php');
        exit;
    }
}

// Manejo de la acción solicitada
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $authController = new AuthController($pdo);

    if (method_exists($authController, $action)) {
        $authController->$action();
    } else {
        // Manejar acción no válida
        header('HTTP/1.0 404 Not Found');
        echo 'Acción no válida';
    }
}
?>
