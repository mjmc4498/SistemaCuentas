<?php
require_once '../includes/auth_middleware.php';
check_role('cliente'); // O cualquier rol que pueda comprar
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Carrito de Compras</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="cart-items">
                <!-- Los items del carrito se agregarán aquí con JavaScript -->
                <tr>
                    <td>Netflix Premium</td>
                    <td>$15.99</td>
                    <td><button class="btn btn-danger btn-sm remove-from-cart" data-id="1">Eliminar</button></td>
                </tr>
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            <h4>Total: <span id="cart-total">$15.99</span></h4>
        </div>
        <div class="d-flex justify-content-between mt-4">
            <a href="catalog.php" class="btn btn-secondary">Seguir Comprando</a>
            <div>
                <!-- Placeholder para la pasarela de pago -->
                <button id="checkout-btn" class="btn btn-primary">Proceder al Pago</button>
            </div>
        </div>
    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/app.js"></script>
</body>
</html>
