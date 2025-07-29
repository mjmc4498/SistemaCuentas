<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <!-- Incluir Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-header">
                        <h3>Recuperar Contraseña</h3>
                    </div>
                    <div class="card-body">
                        <form action="../controllers/AuthController.php?action=forgotPassword" method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar Enlace de Recuperación</button>
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
