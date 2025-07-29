<?php
require_once '../includes/auth_middleware.php';
check_role('cliente'); // O cualquier rol que pueda ver su historial
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Compras</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Historial de Compras</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Producto</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                <!-- Datos de ejemplo, se cargarán dinámicamente -->
                <tr>
                    <td>2023-10-27</td>
                    <td>Netflix Premium</td>
                    <td>$15.99</td>
                </tr>
            </tbody>
        </table>
    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
