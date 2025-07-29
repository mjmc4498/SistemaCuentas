<?php
require_once '../includes/auth_middleware.php';
check_permission('edit_coupons');
$coupon_id = isset($_GET['id']) ? $_GET['id'] : null;
$coupon_data = null; // Se cargarán los datos del cupón aquí
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $coupon_id ? 'Editar' : 'Agregar'; ?> Cupón</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2><?php echo $coupon_id ? 'Editar' : 'Agregar'; ?> Cupón</h2>
        <form action="../controllers/CouponController.php?action=<?php echo $coupon_id ? 'update' : 'create'; ?>" method="POST">
            <?php if ($coupon_id): ?>
                <input type="hidden" name="id" value="<?php echo $coupon_id; ?>">
            <?php endif; ?>
            <div class="mb-3">
                <label for="codigo" class="form-label">Código</label>
                <input type="text" class="form-control" id="codigo" name="codigo" value="<?php echo $coupon_data['codigo'] ?? ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="tipo_descuento" class="form-label">Tipo de Descuento</label>
                <select class="form-select" id="tipo_descuento" name="tipo_descuento">
                    <option value="porcentaje" <?php echo (isset($coupon_data['tipo_descuento']) && $coupon_data['tipo_descuento'] === 'porcentaje') ? 'selected' : ''; ?>>Porcentaje</option>
                    <option value="fijo" <?php echo (isset($coupon_data['tipo_descuento']) && $coupon_data['tipo_descuento'] === 'fijo') ? 'selected' : ''; ?>>Fijo</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="valor" class="form-label">Valor</label>
                <input type="number" step="0.01" class="form-control" id="valor" name="valor" value="<?php echo $coupon_data['valor'] ?? ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="fecha_expiracion" class="form-label">Fecha de Expiración</label>
                <input type="date" class="form-control" id="fecha_expiracion" name="fecha_expiracion" value="<?php echo $coupon_data['fecha_expiracion'] ?? ''; ?>">
            </div>
            <div class="mb-3">
                <label for="usos_maximos" class="form-label">Usos Máximos</label>
                <input type="number" class="form-control" id="usos_maximos" name="usos_maximos" value="<?php echo $coupon_data['usos_maximos'] ?? ''; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
