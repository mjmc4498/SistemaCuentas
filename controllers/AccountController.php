<?php
/**
 * Class AccountController
 *
 * Handles all actions related to account management.
 */
require_once '../includes/database.php';
require_once '../models/Account.php';
require_once '../utils/Session.php';
require_once '../utils/Notification.php';

Session::start();

class AccountController {
    /**
     * @var Account The Account model.
     */
    private $accountModel;
    /**
     * @var PDO The database connection object.
     */
    private $pdo;

    /**
     * AccountController constructor.
     *
     * @param PDO $pdo The database connection object.
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->accountModel = new Account($pdo);
    }

    /**
     * Displays the account management page.
     */
    public function index() {
        $accounts = $this->accountModel->getAll($_GET);
        Session::set('accounts', $accounts);
        header('Location: ../views/manage_accounts.php');
        exit;
    }

    /**
     * Handles the creation of a new account.
     */
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'plataforma' => htmlspecialchars($_POST['plataforma']),
                'login' => htmlspecialchars($_POST['login']),
                'tipo_cuenta' => htmlspecialchars($_POST['tipo_cuenta']),
                'estado' => htmlspecialchars($_POST['estado']),
                'id_usuario_propietario' => htmlspecialchars($_POST['id_usuario_propietario'])
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

    /**
     * Handles the update of an existing account.
     */
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = htmlspecialchars($_POST['id']);
            $data = [
                'plataforma' => htmlspecialchars($_POST['plataforma']),
                'login' => htmlspecialchars($_POST['login']),
                'tipo_cuenta' => htmlspecialchars($_POST['tipo_cuenta']),
                'estado' => htmlspecialchars($_POST['estado']),
                'id_usuario_propietario' => htmlspecialchars($_POST['id_usuario_propietario'])
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

    /**
     * Handles the deletion of an account.
     */
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

    /**
     * Handles the bulk upload of accounts.
     */
    public function bulkUpload() {
        // Lógica para la carga masiva de cuentas
        Notification::set('info', 'Funcionalidad de carga masiva no implementada aún.');
        header('Location: ../views/manage_accounts.php');
        exit;
    }

    /**
     * Searches for accounts based on a search term.
     */
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
