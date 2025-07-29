<?php
require_once '../includes/auth_middleware.php';
check_permission('manage_coupons');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Cupones</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Gestionar Cupones</h2>
        <a href="edit_coupon.php" class="btn btn-primary mb-3">Crear Nuevo Cupón</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>Tipo</th>
                    <th>Valor</th>
                    <th>Expiración</th>
                    <th>Usos</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí se cargarán los cupones -->
                <tr>
                    <td colspan="7" class="text-center">No hay cupones para mostrar.</td>
                </tr>
            </tbody>
        </table>
    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
