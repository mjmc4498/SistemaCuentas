<?php
/**
 * Class Purchase
 *
 * Handles all database operations related to purchases.
 */
class Purchase {
    /**
     * @var PDO The database connection object.
     */
    private $pdo;

    /**
     * Purchase constructor.
     *
     * @param PDO $pdo The database connection object.
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Creates a new purchase record.
     *
     * @param array $data The data for the new purchase.
     * @return bool True on success, false on failure.
     */
    public function create($data) {
        $sql = "INSERT INTO compras (id_venta, id_usuario, total) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['id_venta'],
            $data['id_usuario'],
            $data['total']
        ]);
    }

    /**
     * Gets the purchase history for a specific user.
     *
     * @param int $user_id The ID of the user.
     * @return array An array of the user's purchases.
     */
    public function getByUser($user_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM compras WHERE id_usuario = ? ORDER BY fecha_compra DESC");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }

    /**
     * Gets the total sales amount.
     *
     * @return float The total sales amount.
     */
    public function getTotalSales() {
        $stmt = $this->pdo->query("SELECT SUM(total) FROM compras");
        return $stmt->fetchColumn();
    }

    /**
     * Gets the total sales amount for a specific seller.
     *
     * @param int $seller_id The ID of the seller.
     * @return float The total sales amount for the seller.
     */
    public function getSalesBySeller($seller_id) {
        $stmt = $this->pdo->prepare("SELECT SUM(v.precio) FROM ventas v
                                     JOIN cuentas_streaming c ON v.id_cuenta = c.id
                                     WHERE c.id_usuario_propietario = ?");
        $stmt->execute([$seller_id]);
        return $stmt->fetchColumn();
    }

    /**
     * Gets the sales amount grouped by platform.
     *
     * @param array $filters The filters to apply to the query.
     * @return array An array of sales by platform.
     */
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

    /**
     * Gets the monthly income.
     *
     * @param array $filters The filters to apply to the query.
     * @return array An array of monthly income data.
     */
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
