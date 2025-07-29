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
}
?>
