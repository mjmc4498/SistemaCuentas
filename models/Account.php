<?php
class Account {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll($filters = []) {
        $sql = "SELECT c.*, u.nombre_usuario as propietario
                FROM cuentas_streaming c
                LEFT JOIN usuarios u ON c.id_usuario_propietario = u.id";
        $where = [];
        $params = [];

        if (!empty($filters['plataforma'])) {
            $where[] = "c.plataforma = ?";
            $params[] = $filters['plataforma'];
        }
        if (!empty($filters['estado'])) {
            $where[] = "c.estado = ?";
            $params[] = $filters['estado'];
        }
        if (!empty($filters['search'])) {
            $where[] = "(c.login LIKE ? OR u.nombre_usuario LIKE ?)";
            $params[] = "%{$filters['search']}%";
            $params[] = "%{$filters['search']}%";
        }

        if (!empty($where)) {
            $sql .= " WHERE " . implode(" AND ", $where);
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM cuentas_streaming WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $sql = "INSERT INTO cuentas_streaming (plataforma, login, tipo_cuenta, estado, id_usuario_propietario)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['plataforma'],
            $data['login'],
            $data['tipo_cuenta'],
            $data['estado'],
            $data['id_usuario_propietario']
        ]);
    }

    public function update($id, $data) {
        $sql = "UPDATE cuentas_streaming SET plataforma = ?, login = ?, tipo_cuenta = ?, estado = ?, id_usuario_propietario = ?
                WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['plataforma'],
            $data['login'],
            $data['tipo_cuenta'],
            $data['estado'],
            $data['id_usuario_propietario'],
            $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM cuentas_streaming WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function updateStatus($id, $status) {
        $stmt = $this->pdo->prepare("UPDATE cuentas_streaming SET estado = ? WHERE id = ?");
        return $stmt->execute([$status, $id]);
    }

    public function countAll() {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM cuentas_streaming");
        return $stmt->fetchColumn();
    }

    public function countByOwner($owner_id) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM cuentas_streaming WHERE id_usuario_propietario = ?");
        $stmt->execute([$owner_id]);
        return $stmt->fetchColumn();
    }
}
?>
