<?php
require_once '../utils/Session.php';
require_once '../utils/CSRF.php';
require_once '../utils/Notification.php';
require_once '../utils/Lang.php';

Session::start();
CSRF::generateToken();
Lang::load(Session::get('lang') ?? 'es');
?>
<!DOCTYPE html>
<html lang="<?php echo Session::get('lang') ?? 'es'; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo Lang::get('login'); ?></title>
    <link rel="manifest" href="../manifest.json">
    <!-- Incluir Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-header">
                        <h3><?php echo Lang::get('login'); ?></h3>
                    </div>
                    <div class="card-body">
                        <?php Notification::display(); ?>
                        <form action="../controllers/AuthController.php?action=login" method="POST">
                            <input type="hidden" name="csrf_token" value="<?php echo CSRF::getToken(); ?>">
                            <div class="mb-3">
                                <label for="email" class="form-label"><?php echo Lang::get('username'); ?></label>
                                <input type="email" class="form-control" id="email" name="email" required aria-label="Correo Electrónico">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label"><?php echo Lang::get('password'); ?></label>
                                <input type="password" class="form-control" id="password" name="password" required aria-label="Contraseña">
                            </div>
                            <button type="submit" class="btn btn-primary" aria-label="Iniciar Sesión"><?php echo Lang::get('login'); ?></button>
                            <a href="forgot_password.php" class="float-end">¿Olvidaste tu contraseña?</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Incluir Bootstrap JS -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('../sw.js')
                .then(registration => {
                    console.log('Service Worker registrado con éxito:', registration);
                })
                .catch(error => {
                    console.log('Error al registrar el Service Worker:', error);
                });
        }
    </script>
</body>
</html>
