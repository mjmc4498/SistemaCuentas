<?php
require_once '../includes/database.php';
require_once '../models/Coupon.php';
require_once '../utils/Session.php';
require_once '../utils/Notification.php';

Session::start();

class CouponController {
    private $couponModel;
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->couponModel = new Coupon($pdo);
    }

    public function index() {
        $coupons = $this->couponModel->getAll();
        Session::set('coupons', $coupons);
        header('Location: ../views/manage_coupons.php');
        exit;
    }

    public function create() {
        // Lógica para crear un nuevo cupón
        Notification::set('success', 'Cupón creado (simulación).');
        header('Location: ../views/manage_coupons.php');
        exit;
    }

    public function update() {
        // Lógica para actualizar un cupón
        Notification::set('success', 'Cupón actualizado (simulación).');
        header('Location: ../views/manage_coupons.php');
        exit;
    }

    public function delete() {
        // Lógica para eliminar un cupón
        Notification::set('success', 'Cupón eliminado (simulación).');
        header('Location: ../views/manage_coupons.php');
        exit;
    }
}

// Manejo de la acción solicitada
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $couponController = new CouponController($pdo);

    if (method_exists($couponController, $action)) {
        $couponController->$action();
    } else {
        header('HTTP/1.0 404 Not Found');
        echo 'Acción no válida';
    }
}
?>
