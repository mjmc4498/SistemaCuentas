<?php
require_once '../includes/auth_middleware.php';
// Solo los usuarios con el permiso 'manage_users' pueden acceder
check_permission('manage_users');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Usuarios</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Gestionar Usuarios</h2>
        <a href="edit_user.php" class="btn btn-primary mb-3">Crear Nuevo Usuario</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre de Usuario</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Los datos de los usuarios se cargarán aquí dinámicamente con PHP -->
                <tr>
                    <td>1</td>
                    <td>admin_user</td>
                    <td>admin@example.com</td>
                    <td>admin</td>
                    <td>activo</td>
                    <td>
                        <a href="edit_user.php?id=1" class="btn btn-sm btn-warning">Editar</a>
                        <a href="../controllers/UserController.php?action=suspend&id=1" class="btn btn-sm btn-info">Suspender</a>
                        <a href="../controllers/UserController.php?action=delete&id=1" class="btn btn-sm btn-danger">Eliminar</a>
                    </td>
                </tr>
                <!-- Ejemplo de otro usuario -->
                <tr>
                    <td>2</td>
                    <td>seller_user</td>
                    <td>seller@example.com</td>
                    <td>vendedor</td>
                    <td>activo</td>
                    <td>
                        <a href="edit_user.php?id=2" class="btn btn-sm btn-warning">Editar</a>
                        <a href="../controllers/UserController.php?action=suspend&id=2" class="btn btn-sm btn-info">Suspender</a>
                        <a href="../controllers/UserController.php?action=delete&id=2" class="btn btn-sm btn-danger">Eliminar</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
