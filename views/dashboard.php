<?php
require_once '../includes/auth_middleware.php';
require_once '../utils/Session.php';

Session::init();

// Redirigir si no está logueado
if (!Session::get('user_id')) {
    header('Location: login.php');
    exit;
}

$rol = Session::get('user_rol');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css"> <!-- Para estilos personalizados y modo oscuro -->
</head>
<body class="theme-light">
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Dashboard</h1>
            <div>
                <button id="theme-toggle" class="btn btn-secondary">Modo Oscuro</button>
                <a href="../controllers/AuthController.php?action=logout" class="btn btn-danger">Cerrar Sesión</a>
            </div>
        </div>

        <?php
        // Cargar el dashboard correspondiente al rol
        switch ($rol) {
            case 'admin':
                include 'partials/dashboard_admin.php';
                break;
            case 'vendedor':
                include 'partials/dashboard_vendedor.php';
                break;
            case 'cliente':
                include 'partials/dashboard_usuario.php';
                break;
            default:
                echo '<p>No tienes un rol asignado.</p>';
                break;
        }
        ?>
    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/app.js"></script>
</body>
</html>
