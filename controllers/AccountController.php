<?php
require_once '../includes/database.php';
require_once '../models/Account.php';
require_once '../utils/Session.php';
require_once '../utils/Notification.php';

Session::start();

class AccountController {
    private $accountModel;
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->accountModel = new Account($pdo);
    }

    public function index() {
        // Lógica para mostrar la lista de cuentas
        header('Location: ../views/manage_accounts.php');
        exit;
    }

    public function create() {
        // Lógica para crear una nueva cuenta
        Notification::set('success', 'Cuenta creada (simulación).');
        header('Location: ../views/manage_accounts.php');
        exit;
    }

    public function update() {
        // Lógica para actualizar una cuenta
        Notification::set('success', 'Cuenta actualizada (simulación).');
        header('Location: ../views/manage_accounts.php');
        exit;
    }

    public function delete() {
        // Lógica para eliminar una cuenta
        Notification::set('success', 'Cuenta eliminada (simulación).');
        header('Location: ../views/manage_accounts.php');
        exit;
    }

    public function bulkUpload() {
        // Lógica para la carga masiva de cuentas
        Notification::set('info', 'Funcionalidad de carga masiva no implementada aún.');
        header('Location: ../views/manage_accounts.php');
        exit;
    }
}

// Manejo de la acción solicitada
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $accountController = new AccountController($pdo);

    if (method_exists($accountController, $action)) {
        $accountController->$action();
    } else {
        header('HTTP/1.0 404 Not Found');
        echo 'Acción no válida';
    }
}
?>
