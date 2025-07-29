<?php
require_once '../includes/auth_middleware.php';
check_permission('edit_accounts');
$account_id = isset($_GET['id']) ? $_GET['id'] : null;
$account_data = null; // Se cargarán los datos de la cuenta aquí
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $account_id ? 'Editar' : 'Agregar'; ?> Cuenta</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2><?php echo $account_id ? 'Editar' : 'Agregar'; ?> Cuenta</h2>
        <form action="../controllers/AccountController.php?action=<?php echo $account_id ? 'update' : 'create'; ?>" method="POST">
            <?php if ($account_id): ?>
                <input type="hidden" name="id" value="<?php echo $account_id; ?>">
            <?php endif; ?>
            <div class="mb-3">
                <label for="plataforma" class="form-label">Plataforma</label>
                <input type="text" class="form-control" id="plataforma" name="plataforma" value="<?php echo $account_data['plataforma'] ?? ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="login" class="form-label">Usuario/Email</label>
                <input type="text" class="form-control" id="login" name="login" value="<?php echo $account_data['login'] ?? ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="tipo_cuenta" class="form-label">Tipo de Cuenta</label>
                <input type="text" class="form-control" id="tipo_cuenta" name="tipo_cuenta" value="<?php echo $account_data['tipo_cuenta'] ?? ''; ?>">
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select class="form-select" id="estado" name="estado">
                    <option value="disponible" <?php echo (isset($account_data['estado']) && $account_data['estado'] === 'disponible') ? 'selected' : ''; ?>>Disponible</option>
                    <option value="vendida" <?php echo (isset($account_data['estado']) && $account_data['estado'] === 'vendida') ? 'selected' : ''; ?>>Vendida</option>
                    <option value="mantenimiento" <?php echo (isset($account_data['estado']) && $account_data['estado'] === 'mantenimiento') ? 'selected' : ''; ?>>Mantenimiento</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_usuario_propietario" class="form-label">Vendedor</label>
                <select class="form-select" id="id_usuario_propietario" name="id_usuario_propietario">
                    <!-- Opciones de vendedores se cargarán dinámicamente -->
                    <option value="1">Vendedor 1</option>
                    <option value="2">Vendedor 2</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
