<?php
require_once '../includes/auth_middleware.php';
check_auth('admin');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Incluir Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Bienvenido al Dashboard</h1>
                <p>Esta página solo es accesible para administradores.</p>
                <a href="../controllers/AuthController.php?action=logout" class="btn btn-danger">Cerrar Sesión</a>
            </div>
        </div>
    </div>
    <!-- Incluir Bootstrap JS -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
