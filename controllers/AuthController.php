<?php
require_once '../includes/database.php';
require_once '../models/User.php';
require_once '../utils/Session.php';
require_once '../utils/CSRF.php';
require_once '../models/Log.php';
require_once '../utils/Notification.php';

Session::start();

class AuthController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new User($pdo);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!CSRF::validateToken($_POST['csrf_token'])) {
                Notification::set('error', 'Error de CSRF: Token no válido.');
                header('Location: ../views/login.php');
                exit;
            }

            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->userModel->findByEmail($email);

            if ($user && password_verify($password, $user['password_hash'])) {
                // Iniciar sesión
                Session::set('user_id', $user['id']);
                Session::set('user_rol', $user['rol']);
                Log::add($this->pdo, $user['id'], 'Inicio de sesión exitoso');
                Notification::set('success', 'Inicio de sesión exitoso.');
                header('Location: ../views/dashboard.php');
                exit;
            } else {
                // Credenciales inválidas
                Log::add($this->pdo, null, "Intento de inicio de sesión fallido para el correo: $email");
                Notification::set('error', 'Correo o contraseña incorrectos.');
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

    public function forgotPassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $user = $this->userModel->findByEmail($email);

            if ($user) {
                $token = bin2hex(random_bytes(32));
                $expiration = date('Y-m-d H:i:s', strtotime('+1 hour'));
                $this->userModel->updateResetToken($email, $token, $expiration);

                // Simulación de envío de correo
                // En una aplicación real, aquí se enviaría un correo electrónico con el enlace de restablecimiento.
                // Por ahora, mostraremos un mensaje con el token.
                Notification::set('success', "Se ha generado un token de recuperación: $token");
                header('Location: ../views/forgot_password.php');
                exit;
            } else {
                Notification::set('error', 'No se encontró un usuario con ese correo electrónico.');
                header('Location: ../views/forgot_password.php');
                exit;
            }
        }
    }

    public function resetPassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['token'];
            $password = $_POST['password'];
            $password_confirm = $_POST['password_confirm'];

            if ($password !== $password_confirm) {
                Notification::set('error', 'Las contraseñas no coinciden.');
                header("Location: ../views/reset_password.php?token=$token");
                exit;
            }

            $user = $this->userModel->findUserByResetToken($token);

            if ($user) {
                $this->userModel->updatePassword($token, $password);
                Notification::set('success', 'Tu contraseña ha sido restablecida.');
                header('Location: ../views/login.php');
                exit;
            } else {
                Notification::set('error', 'El token de recuperación no es válido o ha expirado.');
                header("Location: ../views/reset_password.php?token=$token");
                exit;
            }
        }
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
