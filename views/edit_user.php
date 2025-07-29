<?php
require_once '../includes/auth_middleware.php';
check_permission('edit_users');
// Lógica para cargar los datos del usuario si se proporciona un ID
$user_id = isset($_GET['id']) ? $_GET['id'] : null;
$user_data = null; // En un paso posterior, aquí se cargarían los datos del usuario desde la base de datos
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $user_id ? 'Editar' : 'Crear'; ?> Usuario</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2><?php echo $user_id ? 'Editar' : 'Crear'; ?> Usuario</h2>
        <form action="../controllers/UserController.php?action=<?php echo $user_id ? 'update' : 'create'; ?>" method="POST">
            <?php if ($user_id): ?>
                <input type="hidden" name="id" value="<?php echo $user_id; ?>">
            <?php endif; ?>
            <div class="mb-3">
                <label for="nombre_usuario" class="form-label">Nombre de Usuario</label>
                <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" value="<?php echo $user_data['nombre_usuario'] ?? ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $user_data['email'] ?? ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña (dejar en blanco para no cambiar)</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="rol" class="form-label">Rol</label>
                <select class="form-select" id="rol" name="rol">
                    <option value="admin" <?php echo (isset($user_data['rol']) && $user_data['rol'] === 'admin') ? 'selected' : ''; ?>>Admin</option>
                    <option value="vendedor" <?php echo (isset($user_data['rol']) && $user_data['rol'] === 'vendedor') ? 'selected' : ''; ?>>Vendedor</option>
                    <option value="cliente" <?php echo (isset($user_data['rol']) && $user_data['rol'] === 'cliente') ? 'selected' : ''; ?>>Cliente</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select class="form-select" id="estado" name="estado">
                    <option value="activo" <?php echo (isset($user_data['estado']) && $user_data['estado'] === 'activo') ? 'selected' : ''; ?>>Activo</option>
                    <option value="inactivo" <?php echo (isset($user_data['estado']) && $user_data['estado'] === 'inactivo') ? 'selected' : ''; ?>>Inactivo</option>
                    <option value="suspendido" <?php echo (isset($user_data['estado']) && $user_data['estado'] === 'suspendido') ? 'selected' : ''; ?>>Suspendido</option>
                </select>
            </div>
            <div class="mb-3">
                <h5>Permisos Adicionales</h5>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="perm_ver_ventas" name="permisos[]">
                    <label class="form-check-label" for="perm_ver_ventas">Ver Ventas</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="2" id="perm_editar_productos" name="permisos[]">
                    <label class="form-check-label" for="perm_editar_productos">Editar Productos</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
