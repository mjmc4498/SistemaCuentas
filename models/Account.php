<?php
/**
 * Class Account
 *
 * Handles all database operations related to streaming accounts.
 */
class Account {
    /**
     * @var PDO The database connection object.
     */
    private $pdo;

    /**
     * Account constructor.
     *
     * @param PDO $pdo The database connection object.
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Gets all accounts, with optional filtering.
     *
     * @param array $filters The filters to apply to the query.
     * @return array An array of accounts.
     */
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

    /**
     * Gets a single account by its ID.
     *
     * @param int $id The ID of the account.
     * @return mixed The account data or false if not found.
     */
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM cuentas_streaming WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    /**
     * Creates a new account.
     *
     * @param array $data The data for the new account.
     * @return bool True on success, false on failure.
     */
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

    /**
     * Updates an existing account.
     *
     * @param int $id The ID of the account to update.
     * @param array $data The new data for the account.
     * @return bool True on success, false on failure.
     */
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

    /**
     * Deletes an account.
     *
     * @param int $id The ID of the account to delete.
     * @return bool True on success, false on failure.
     */
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM cuentas_streaming WHERE id = ?");
        return $stmt->execute([$id]);
    }

    /**
     * Updates the status of an account.
     *
     * @param int $id The ID of the account to update.
     * @param string $status The new status.
     * @return bool True on success, false on failure.
     */
    public function updateStatus($id, $status) {
        $stmt = $this->pdo->prepare("UPDATE cuentas_streaming SET estado = ? WHERE id = ?");
        return $stmt->execute([$status, $id]);
    }

    /**
     * Counts all accounts.
     *
     * @return int The total number of accounts.
     */
    public function countAll() {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM cuentas_streaming");
        return $stmt->fetchColumn();
    }

    /**
     * Counts all accounts owned by a specific user.
     *
     * @param int $owner_id The ID of the owner.
     * @return int The total number of accounts owned by the user.
     */
    public function countByOwner($owner_id) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM cuentas_streaming WHERE id_usuario_propietario = ?");
        $stmt->execute([$owner_id]);
        return $stmt->fetchColumn();
    }
}
?>
