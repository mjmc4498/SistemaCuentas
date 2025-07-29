<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
    <!-- Incluir Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-header">
                        <h3>Restablecer Contraseña</h3>
                    </div>
                    <div class="card-body">
                        <form action="../controllers/AuthController.php?action=resetPassword" method="POST">
                            <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
                            <div class="mb-3">
                                <label for="password" class="form-label">Nueva Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="password_confirm" class="form-label">Confirmar Nueva Contraseña</label>
                                <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Restablecer Contraseña</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Incluir Bootstrap JS -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
