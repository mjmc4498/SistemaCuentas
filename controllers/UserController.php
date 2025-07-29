<?php
/**
 * Class UserController
 *
 * Handles all actions related to user management.
 */
require_once '../includes/database.php';
require_once '../models/User.php';
require_once '../utils/Session.php';
require_once '../utils/Notification.php';

Session::start();

class UserController {
    private $userModel;
    private $pdo;

    /**
     * UserController constructor.
     *
     * @param PDO $pdo The database connection object.
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->userModel = new User($pdo);
    }

    /**
     * Displays the user management page.
     */
    public function index() {
        // Lógica para mostrar la lista de usuarios
        // Se implementará en un paso posterior
        header('Location: ../views/manage_users.php');
        exit;
    }

    /**
     * Handles the creation of a new user.
     */
    public function create() {
        // Lógica para crear un nuevo usuario
        // Se implementará en un paso posterior
        Notification::set('success', 'Usuario creado (simulación).');
        header('Location: ../views/manage_users.php');
        exit;
    }

    /**
     * Handles the update of an existing user.
     */
    public function update() {
        // Lógica para actualizar un usuario
        // Se implementará en un paso posterior
        Notification::set('success', 'Usuario actualizado (simulación).');
        header('Location: ../views/manage_users.php');
        exit;
    }

    /**
     * Handles the deletion of a user.
     */
    public function delete() {
        // Lógica para eliminar un usuario
        // Se implementará en un paso posterior
        Notification::set('success', 'Usuario eliminado (simulación).');
        header('Location: ../views/manage_users.php');
        exit;
    }

    /**
     * Handles the suspension/reactivation of a user.
     */
    public function suspend() {
        // Lógica para suspender/reactivar un usuario
        // Se implementará en un paso posterior
        Notification::set('success', 'Estado del usuario cambiado (simulación).');
        header('Location: ../views/manage_users.php');
        exit;
    }
}

// Manejo de la acción solicitada
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $userController = new UserController($pdo);

    if (method_exists($userController, $action)) {
        $userController->$action();
    } else {
        header('HTTP/1.0 404 Not Found');
        echo 'Acción no válida';
    }
}
?>
