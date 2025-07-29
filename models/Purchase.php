<?php
class Purchase {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($data) {
        $sql = "INSERT INTO compras (id_venta, id_usuario, total) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['id_venta'],
            $data['id_usuario'],
            $data['total']
        ]);
    }

    public function getByUser($user_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM compras WHERE id_usuario = ? ORDER BY fecha_compra DESC");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }

    public function getTotalSales() {
        $stmt = $this->pdo->query("SELECT SUM(total) FROM compras");
        return $stmt->fetchColumn();
    }

    public function getSalesBySeller($seller_id) {
        $stmt = $this->pdo->prepare("SELECT SUM(v.precio) FROM ventas v
                                     JOIN cuentas_streaming c ON v.id_cuenta = c.id
                                     WHERE c.id_usuario_propietario = ?");
        $stmt->execute([$seller_id]);
        return $stmt->fetchColumn();
    }

    public function getSalesByPlatform($filters = []) {
        $sql = "SELECT c.plataforma, SUM(v.precio) as total
                FROM ventas v
                JOIN cuentas_streaming c ON v.id_cuenta = c.id";
        // Lógica de filtros de fecha aquí
        $sql .= " GROUP BY c.plataforma";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getMonthlyIncome($filters = []) {
        $sql = "SELECT DATE_FORMAT(fecha_venta, '%Y-%m') as mes, SUM(precio) as total
                FROM ventas";
        // Lógica de filtros de fecha aquí
        $sql .= " GROUP BY mes";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>
