<?php $data = Session::get('dashboard_data'); ?>
<div class="row">
    <div class="col-md-3">
        <div class="card text-white bg-primary mb-3">
            <div class="card-header">Usuarios</div>
            <div class="card-body">
                <h5 class="card-title"><?php echo $data['total_users'] ?? '0'; ?></h5>
                <p class="card-text">Usuarios registrados</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success mb-3">
            <div class="card-header">Ventas</div>
            <div class="card-body">
                <h5 class="card-title">$<?php echo number_format($data['total_sales'] ?? 0, 2); ?></h5>
                <p class="card-text">Ventas del último mes</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-info mb-3">
            <div class="card-header">Ganancias</div>
            <div class="card-body">
                <h5 class="card-title">$<?php echo number_format($data['total_earnings'] ?? 0, 2); ?></h5>
                <p class="card-text">Ganancias del último mes</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning mb-3">
            <div class="card-header">Cuentas</div>
            <div class="card-body">
                <h5 class="card-title"><?php echo $data['total_accounts'] ?? '0'; ?></h5>
                <p class="card-text">Cuentas en inventario</p>
            </div>
        </div>
    </div>
</div>
<h4>Acciones Rápidas</h4>
<a href="../views/manage_users.php" class="btn btn-primary">Gestionar Usuarios</a>
<a href="../views/manage_accounts.php" class="btn btn-secondary">Gestionar Cuentas</a>
