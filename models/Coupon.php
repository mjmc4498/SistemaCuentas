<?php
class Coupon {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM cupones");
        return $stmt->fetchAll();
    }

    public function getByCode($code) {
        $stmt = $this->pdo->prepare("SELECT * FROM cupones WHERE codigo = ?");
        $stmt->execute([$code]);
        return $stmt->fetch();
    }

    public function create($data) {
        $sql = "INSERT INTO cupones (codigo, tipo_descuento, valor, fecha_expiracion, usos_maximos)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['codigo'],
            $data['tipo_descuento'],
            $data['valor'],
            $data['fecha_expiracion'],
            $data['usos_maximos']
        ]);
    }

    public function update($id, $data) {
        $sql = "UPDATE cupones SET codigo = ?, tipo_descuento = ?, valor = ?, fecha_expiracion = ?, usos_maximos = ?
                WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['codigo'],
            $data['tipo_descuento'],
            $data['valor'],
            $data['fecha_expiracion'],
            $data['usos_maximos'],
            $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM cupones WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function incrementUsage($id) {
        $stmt = $this->pdo->prepare("UPDATE cupones SET usos_actuales = usos_actuales + 1 WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
