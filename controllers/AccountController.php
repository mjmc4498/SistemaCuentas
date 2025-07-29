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
        $accounts = $this->accountModel->getAll($_GET);
        Session::set('accounts', $accounts);
        header('Location: ../views/manage_accounts.php');
        exit;
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'plataforma' => $_POST['plataforma'],
                'login' => $_POST['login'],
                'tipo_cuenta' => $_POST['tipo_cuenta'],
                'estado' => $_POST['estado'],
                'id_usuario_propietario' => $_POST['id_usuario_propietario']
            ];

            if ($this->accountModel->create($data)) {
                Notification::set('success', 'Cuenta creada exitosamente.');
            } else {
                Notification::set('error', 'Error al crear la cuenta.');
            }
            header('Location: ../controllers/AccountController.php?action=index');
            exit;
        }
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $data = [
                'plataforma' => $_POST['plataforma'],
                'login' => $_POST['login'],
                'tipo_cuenta' => $_POST['tipo_cuenta'],
                'estado' => $_POST['estado'],
                'id_usuario_propietario' => $_POST['id_usuario_propietario']
            ];

            if ($this->accountModel->update($id, $data)) {
                Notification::set('success', 'Cuenta actualizada exitosamente.');
            } else {
                Notification::set('error', 'Error al actualizar la cuenta.');
            }
            header('Location: ../controllers/AccountController.php?action=index');
            exit;
        }
    }

    public function delete() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            if ($this->accountModel->delete($id)) {
                Notification::set('success', 'Cuenta eliminada exitosamente.');
            } else {
                Notification::set('error', 'Error al eliminar la cuenta.');
            }
        }
        header('Location: ../controllers/AccountController.php?action=index');
        exit;
    }

    public function bulkUpload() {
        // Lógica para la carga masiva de cuentas
        Notification::set('info', 'Funcionalidad de carga masiva no implementada aún.');
        header('Location: ../views/manage_accounts.php');
        exit;
    }

    public function searchAccounts() {
        if (isset($_GET['term'])) {
            $term = $_GET['term'];
            $accounts = $this->accountModel->getAll(['search' => $term]);
            echo json_encode($accounts);
        }
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
