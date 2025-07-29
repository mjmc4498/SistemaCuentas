<?php
require_once '../includes/database.php';
require_once '../models/Account.php';

header('Content-Type: application/json');

class ApiAccountController {
    private $accountModel;

    public function __construct($pdo) {
        $this->accountModel = new Account($pdo);
    }

    public function index() {
        $accounts = $this->accountModel->getAll($_GET);
        echo json_encode($accounts);
    }

    public function show($id) {
        $account = $this->accountModel->getById($id);
        echo json_encode($account);
    }
}

$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;

$apiAccountController = new ApiAccountController($pdo);

if ($action === 'show' && $id) {
    $apiAccountController->show($id);
} else {
    $apiAccountController->index();
}
?>
