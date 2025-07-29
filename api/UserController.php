<?php
require_once '../includes/database.php';
require_once '../models/User.php';

header('Content-Type: application/json');

class ApiUserController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new User($pdo);
    }

    public function index() {
        $users = $this->userModel->getAll();
        echo json_encode($users);
    }

    public function show($id) {
        $user = $this->userModel->getById($id);
        echo json_encode($user);
    }
}

$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;

$apiUserController = new ApiUserController($pdo);

if ($action === 'show' && $id) {
    $apiUserController->show($id);
} else {
    $apiUserController->index();
}
?>
