<?php
/**
 * Class ShopController
 *
 * Handles all actions related to the shop, including the catalog, cart, and checkout.
 */
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

    /**
     * ShopController constructor.
     *
     * @param PDO $pdo The database connection object.
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->accountModel = new Account($pdo);
        $this->purchaseModel = new Purchase($pdo);
    }

    /**
     * Displays the catalog page.
     */
    public function index() {
        // Lógica para mostrar el catálogo
        header('Location: ../views/catalog.php');
        exit;
    }

    /**
     * Handles adding an item to the cart.
     */
    public function addToCart() {
        // Lógica para agregar al carrito
        Notification::set('success', 'Producto agregado al carrito (simulación).');
        header('Location: ../views/catalog.php');
        exit;
    }

    /**
     * Handles removing an item from the cart.
     */
    public function removeFromCart() {
        // Lógica para remover del carrito
        Notification::set('success', 'Producto eliminado del carrito (simulación).');
        header('Location: ../views/cart.php');
        exit;
    }

    /**
     * Handles the checkout process.
     */
    public function checkout() {
        $payment_method = $_GET['method'] ?? 'paypal'; // Por defecto, paypal
        // Lógica para procesar el pago
        Notification::set('success', "Compra realizada con $payment_method (simulación).");
        header('Location: ../views/purchase_history.php');
        exit;
    }

    /**
     * Displays the purchase history page.
     */
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
