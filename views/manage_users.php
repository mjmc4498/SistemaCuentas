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
                        <a href="edit_user.php?id=1" class="btn btn-sm btn-warning" aria-label="Editar usuario 1"><i class="fas fa-edit"></i> Editar</a>
                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#suspendModal" data-id="1" aria-label="Suspender usuario 1"><i class="fas fa-user-clock"></i> Suspender</button>
                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteUserModal" data-id="1" aria-label="Eliminar usuario 1"><i class="fas fa-trash"></i> Eliminar</button>
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
                        <a href="edit_user.php?id=2" class="btn btn-sm btn-warning" aria-label="Editar usuario 2"><i class="fas fa-edit"></i> Editar</a>
                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#suspendModal" data-id="2" aria-label="Suspender usuario 2"><i class="fas fa-user-clock"></i> Suspender</button>
                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteUserModal" data-id="2" aria-label="Eliminar usuario 2"><i class="fas fa-trash"></i> Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Modal de Confirmación de Suspensión -->
    <div class="modal fade" id="suspendModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar Suspensión</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que quieres cambiar el estado de este usuario?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a href="#" id="suspend-confirm-btn" class="btn btn-info">Confirmar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmación de Eliminación de Usuario -->
    <div class="modal fade" id="deleteUserModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que quieres eliminar este usuario?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a href="#" id="delete-user-confirm-btn" class="btn btn-danger">Eliminar</a>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
