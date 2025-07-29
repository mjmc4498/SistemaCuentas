<?php
require_once '../includes/auth_middleware.php';
// Requerir permiso para ver cuentas
check_permission('view_accounts');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Cuentas</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Gestionar Cuentas de Streaming</h2>
        <div class="d-flex justify-content-between mb-3">
            <a href="edit_account.php" class="btn btn-primary">Agregar Nueva Cuenta</a>
            <!-- Formulario para carga masiva -->
            <form action="../controllers/AccountController.php?action=bulkUpload" method="post" enctype="multipart/form-data">
                <div class="input-group">
                    <input type="file" class="form-control" name="file" id="file">
                    <button class="btn btn-secondary" type="submit">Carga Masiva</button>
                </div>
            </form>
        </div>

        <!-- Filtros y Búsqueda -->
        <div class="row mb-3">
            <div class="col-md-4">
                <input type="text" class="form-control" id="search" placeholder="Buscar cuenta...">
            </div>
            <div class="col-md-3">
                <select class="form-select" id="filter-platform">
                    <option value="">Todas las Plataformas</option>
                    <option value="netflix">Netflix</option>
                    <option value="hbo">HBO</option>
                    <option value="disney+">Disney+</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select" id="filter-status">
                    <option value="">Todos los Estados</option>
                    <option value="disponible">Disponible</option>
                    <option value="vendida">Vendida</option>
                    <option value="mantenimiento">Mantenimiento</option>
                </select>
            </div>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Plataforma</th>
                    <th>Usuario</th>
                    <th>Tipo</th>
                    <th>Estado</th>
                    <th>Propietario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Datos de ejemplo, se cargarán dinámicamente -->
                <tr>
                    <td>1</td>
                    <td>Netflix</td>
                    <td>user1@example.com</td>
                    <td>Premium</td>
                    <td><span class="badge bg-success">Disponible</span></td>
                    <td>Vendedor1</td>
                    <td>
                        <a href="edit_account.php?id=1" class="btn btn-sm btn-warning">Editar</a>
                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="1">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Modal de Confirmación de Eliminación -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que quieres eliminar esta cuenta?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a href="#" id="delete-confirm-btn" class="btn btn-danger">Eliminar</a>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/app.js"></script>
</body>
</html>
