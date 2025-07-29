<?php
require_once '../includes/auth_middleware.php';
require_once '../utils/Session.php';
require_once '../models/User.php';
require_once '../includes/database.php';

Session::init();
check_role('vendedor'); // O cualquier rol que pueda tener referidos

$userModel = new User($pdo);
$user_id = Session::get('user_id');
$user = $userModel->getById($user_id);
$referred_users = $userModel->getReferredUsers($user_id);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Referidos</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Tu Sistema de Referidos</h2>
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Tu Código de Referido</h5>
                <p class="card-text">Comparte este código con otros para ganar comisiones.</p>
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($user['referral_code'] ?? ''); ?>" readonly>
            </div>
        </div>

        <h4>Usuarios Referidos por Ti</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID de Usuario</th>
                    <th>Nombre de Usuario</th>
                    <th>Email</th>
                    <th>Fecha de Registro</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($referred_users)): ?>
                    <tr>
                        <td colspan="4" class="text-center">No has referido a ningún usuario todavía.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($referred_users as $referred_user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($referred_user['id']); ?></td>
                            <td><?php echo htmlspecialchars($referred_user['nombre_usuario']); ?></td>
                            <td><?php echo htmlspecialchars($referred_user['email']); ?></td>
                            <td><?php echo htmlspecialchars($referred_user['fecha_creacion']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
