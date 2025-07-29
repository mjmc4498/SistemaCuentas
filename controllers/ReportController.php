<?php
require_once '../includes/database.php';
require_once '../models/Purchase.php';
require_once '../models/User.php';
require_once '../utils/Session.php';

Session::start();

class ReportController {
    private $purchaseModel;
    private $userModel;
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->purchaseModel = new Purchase($pdo);
        $this->userModel = new User($pdo);
    }

    public function index() {
        $filters = [
            'start_date' => $_GET['start_date'] ?? null,
            'end_date' => $_GET['end_date'] ?? null,
        ];

        // Lógica para obtener datos para los reportes
        $data = [
            'salesByPlatform' => $this->purchaseModel->getSalesByPlatform($filters),
            'topSellers' => $this->userModel->getTopSellers($filters),
            'monthlyIncome' => $this->purchaseModel->getMonthlyIncome($filters),
        ];

        Session::set('report_data', $data);
        header('Location: ../views/reports.php');
        exit;
    }

    public function downloadExcel() {
        // Lógica para descargar reporte en Excel
        Notification::set('info', 'Funcionalidad de descarga de Excel no implementada aún.');
        header('Location: ../views/reports.php');
        exit;
    }

    public function downloadPdf() {
        // Lógica para descargar reporte en PDF
        Notification::set('info', 'Funcionalidad de descarga de PDF no implementada aún.');
        header('Location: ../views/reports.php');
        exit;
    }
}

// Manejo de la acción solicitada
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $reportController = new ReportController($pdo);

    if (method_exists($reportController, $action)) {
        $reportController->$action();
    } else {
        header('HTTP/1.0 404 Not Found');
        echo 'Acción no válida';
    }
} else {
    $reportController = new ReportController($pdo);
    $reportController->index();
}
?>
