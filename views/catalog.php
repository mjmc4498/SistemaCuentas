<?php
require_once '../includes/auth_middleware.php';
// Todos los usuarios logueados pueden ver el catálogo
check_role('cliente'); // o cualquier rol que pueda comprar
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Cuentas</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Catálogo de Cuentas</h2>
        <!-- Filtros -->
        <div class="row mb-4">
            <div class="col-md-4">
                <select class="form-select" id="filter-platform">
                    <option value="">Todas las Plataformas</option>
                    <option value="netflix">Netflix</option>
                    <option value="hbo">HBO</option>
                    <option value="disney+">Disney+</option>
                </select>
            </div>
            <div class="col-md-4">
                <input type="range" class="form-range" min="0" max="50" id="price-range">
                <label for="price-range" class="form-label">Precio: <span id="price-value">$25</span></label>
            </div>
        </div>

        <!-- Catálogo de Cuentas -->
        <div class="row">
            <!-- Ejemplo de tarjeta de cuenta -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Netflix Premium</h5>
                        <p class="card-text">Cuenta de Netflix con 4 pantallas.</p>
                        <p class="card-text"><strong>Precio: $15.99</strong></p>
                        <button class="btn btn-primary add-to-cart" data-id="1">Agregar al Carrito</button>
                    </div>
                </div>
            </div>
             <!-- Ejemplo de tarjeta de cuenta 2 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">HBO Max</h5>
                        <p class="card-text">Cuenta de HBO Max con 2 pantallas.</p>
                        <p class="card-text"><strong>Precio: $12.99</strong></p>
                        <button class="btn btn-primary add-to-cart" data-id="2">Agregar al Carrito</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/app.js"></script>
</body>
</html>
