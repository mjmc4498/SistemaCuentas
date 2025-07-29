<?php
require_once '../includes/auth_middleware.php';
check_permission('view_reports');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes y Estadísticas</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Reportes y Estadísticas</h2>

        <!-- Filtros -->
        <div class="row mb-4">
            <div class="col-md-4">
                <label for="start-date" class="form-label">Fecha de Inicio</label>
                <input type="date" class="form-control" id="start-date">
            </div>
            <div class="col-md-4">
                <label for="end-date" class="form-label">Fecha de Fin</label>
                <input type="date" class="form-control" id="end-date">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button class="btn btn-primary">Filtrar</button>
            </div>
        </div>

        <!-- Gráficas -->
        <div class="row">
            <div class="col-md-6">
                <canvas id="salesByPlatformChart"></canvas>
            </div>
            <div class="col-md-6">
                <canvas id="topSellersChart"></canvas>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <canvas id="monthlyIncomeChart"></canvas>
            </div>
        </div>

        <!-- Botones de Descarga -->
        <div class="mt-5">
            <button class="btn btn-success">Descargar Excel</button>
            <button class="btn btn-danger">Descargar PDF</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../assets/js/app.js"></script>
</body>
</html>
