<?php
require_once '../includes/database.php';
require_once '../models/Account.php';
require_once '../models/Purchase.php';
require_once '../utils/Session.php';
require_once '../utils/Notification.php';

Session::start();

class ShopController {
    private $accountModel;
    private $purchaseModel;
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->accountModel = new Account($pdo);
        $this->purchaseModel = new Purchase($pdo);
    }

    public function index() {
        // Lógica para mostrar el catálogo
        header('Location: ../views/catalog.php');
        exit;
    }

    public function addToCart() {
        // Lógica para agregar al carrito
        Notification::set('success', 'Producto agregado al carrito (simulación).');
        header('Location: ../views/catalog.php');
        exit;
    }

    public function removeFromCart() {
        // Lógica para remover del carrito
        Notification::set('success', 'Producto eliminado del carrito (simulación).');
        header('Location: ../views/cart.php');
        exit;
    }

    public function checkout() {
        // Lógica para procesar el pago
        Notification::set('success', 'Compra realizada con éxito (simulación).');
        header('Location: ../views/purchase_history.php');
        exit;
    }

    public function purchaseHistory() {
        // Lógica para mostrar el historial de compras
        header('Location: ../views/purchase_history.php');
        exit;
    }
}

// Manejo de la acción solicitada
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $shopController = new ShopController($pdo);

    if (method_exists($shopController, $action)) {
        $shopController->$action();
    } else {
        header('HTTP/1.0 404 Not Found');
        echo 'Acción no válida';
    }
}
?>
