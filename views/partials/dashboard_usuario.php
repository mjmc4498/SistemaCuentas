<?php $data = Session::get('dashboard_data'); ?>
<div class="row">
    <div class="col-md-6">
        <div class="card text-white bg-primary mb-3">
            <div class="card-header">Mis Compras</div>
            <div class="card-body">
                <h5 class="card-title"><?php echo count($data['user_purchases'] ?? []); ?></h5>
                <p class="card-text">Total de compras realizadas</p>
                <a href="purchase_history.php" class="btn btn-light">Ver Historial</a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card bg-light mb-3">
            <div class="card-header">Ofertas Destacadas</div>
            <div class="card-body">
                <h5 class="card-title">¡Netflix a solo $9.99!</h5>
                <p class="card-text">Aprovecha esta oferta por tiempo limitado.</p>
                <a href="catalog.php" class="btn btn-primary">Ir al Catálogo</a>
            </div>
        </div>
    </div>
</div>
