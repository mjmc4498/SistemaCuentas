<?php $data = Session::get('dashboard_data'); ?>
<div class="row">
    <div class="col-md-6">
        <div class="card text-white bg-info mb-3">
            <div class="card-header">Cuentas Cargadas</div>
            <div class="card-body">
                <h5 class="card-title"><?php echo $data['accounts_by_seller'] ?? '0'; ?></h5>
                <p class="card-text">Cuentas activas a tu nombre</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card text-white bg-success mb-3">
            <div class="card-header">Ventas Propias</div>
            <div class="card-body">
                <h5 class="card-title">$<?php echo number_format($data['sales_by_seller'] ?? 0, 2); ?></h5>
                <p class="card-text">Ventas realizadas este mes</p>
            </div>
        </div>
    </div>
</div>
<h4>Acciones Rápidas</h4>
<a href="../views/manage_accounts.php" class="btn btn-primary">Gestionar Mis Cuentas</a>
<a href="../views/edit_account.php" class="btn btn-secondary">Agregar Nueva Cuenta</a>
