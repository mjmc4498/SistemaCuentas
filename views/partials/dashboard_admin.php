<?php $data = Session::get('dashboard_data'); ?>
<div class="row">
    <div class="col-md-3">
        <div class="card text-white bg-primary mb-3">
            <div class="card-header"><i class="fas fa-users"></i> Usuarios</div>
            <div class="card-body">
                <h5 class="card-title"><?php echo $data['total_users'] ?? '0'; ?></h5>
                <p class="card-text">Usuarios registrados</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success mb-3">
            <div class="card-header"><i class="fas fa-dollar-sign"></i> Ventas</div>
            <div class="card-body">
                <h5 class="card-title">$<?php echo number_format($data['total_sales'] ?? 0, 2); ?></h5>
                <p class="card-text">Ventas del último mes</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-info mb-3">
            <div class="card-header"><i class="fas fa-chart-line"></i> Ganancias</div>
            <div class="card-body">
                <h5 class="card-title">$<?php echo number_format($data['total_earnings'] ?? 0, 2); ?></h5>
                <p class="card-text">Ganancias del último mes</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning mb-3">
            <div class="card-header"><i class="fas fa-box"></i> Cuentas</div>
            <div class="card-body">
                <h5 class="card-title"><?php echo $data['total_accounts'] ?? '0'; ?></h5>
                <p class="card-text">Cuentas en inventario</p>
            </div>
        </div>
    </div>
</div>
<h4><i class="fas fa-bolt"></i> Acciones Rápidas</h4>
<a href="../views/manage_users.php" class="btn btn-primary"><i class="fas fa-user-edit"></i> Gestionar Usuarios</a>
<a href="../views/manage_accounts.php" class="btn btn-secondary"><i class="fas fa-cogs"></i> Gestionar Cuentas</a>
