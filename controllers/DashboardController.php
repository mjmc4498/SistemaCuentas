<?php
require_once '../includes/database.php';
require_once '../models/User.php';
require_once '../models/Account.php';
require_once '../models/Purchase.php';
require_once '../utils/Session.php';

Session::start();

class DashboardController {
    private $userModel;
    private $accountModel;
    private $purchaseModel;
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->userModel = new User($pdo);
        $this->accountModel = new Account($pdo);
        $this->purchaseModel = new Purchase($pdo);
    }

    public function index() {
        $rol = Session::get('user_rol');
        $user_id = Session::get('user_id');
        $data = [];

        switch ($rol) {
            case 'admin':
                $data['total_users'] = $this->userModel->countAll();
                $data['total_sales'] = $this->purchaseModel->getTotalSales();
                // Suponiendo que las ganancias son un porcentaje de las ventas
                $data['total_earnings'] = $data['total_sales'] * 0.7;
                $data['total_accounts'] = $this->accountModel->countAll();
                break;
            case 'vendedor':
                $data['accounts_by_seller'] = $this->accountModel->countByOwner($user_id);
                $data['sales_by_seller'] = $this->purchaseModel->getSalesBySeller($user_id);
                break;
            case 'cliente':
                $data['user_purchases'] = $this->purchaseModel->getByUser($user_id);
                break;
        }

        Session::set('dashboard_data', $data);
        header('Location: ../views/dashboard.php');
        exit;
    }
}

// Manejo de la acción solicitada
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $dashboardController = new DashboardController($pdo);

    if (method_exists($dashboardController, $action)) {
        $dashboardController->$action();
    } else {
        header('HTTP/1.0 404 Not Found');
        echo 'Acción no válida';
    }
} else {
    // Acción por defecto
    $dashboardController = new DashboardController($pdo);
    $dashboardController->index();
}
?>
