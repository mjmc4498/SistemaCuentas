<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instalador del Sistema</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Instalador del Sistema</h2>
        <form action="InstallerController.php" method="POST">
            <h4>Configuración de la Base de Datos</h4>
            <div class="mb-3">
                <label for="db_host" class="form-label">Host de la Base de Datos</label>
                <input type="text" class="form-control" id="db_host" name="db_host" required>
            </div>
            <div class="mb-3">
                <label for="db_name" class="form-label">Nombre de la Base de Datos</label>
                <input type="text" class="form-control" id="db_name" name="db_name" required>
            </div>
            <div class="mb-3">
                <label for="db_user" class="form-label">Usuario de la Base de Datos</label>
                <input type="text" class="form-control" id="db_user" name="db_user" required>
            </div>
            <div class="mb-3">
                <label for="db_pass" class="form-label">Contraseña de la Base de Datos</label>
                <input type="password" class="form-control" id="db_pass" name="db_pass">
            </div>

            <h4 class="mt-5">Cuenta de Administrador</h4>
            <div class="mb-3">
                <label for="admin_user" class="form-label">Nombre de Usuario del Administrador</label>
                <input type="text" class="form-control" id="admin_user" name="admin_user" required>
            </div>
            <div class="mb-3">
                <label for="admin_email" class="form-label">Email del Administrador</label>
                <input type="email" class="form-control" id="admin_email" name="admin_email" required>
            </div>
            <div class="mb-3">
                <label for="admin_pass" class="form-label">Contraseña del Administrador</label>
                <input type="password" class="form-control" id="admin_pass" name="admin_pass" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Instalar</button>
        </form>
    </div>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
