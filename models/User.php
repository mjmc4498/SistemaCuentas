<?php
/**
 * Class User
 *
 * Handles all database operations related to users.
 */
class User {
    /**
     * @var PDO The database connection object.
     */
    private $pdo;

    /**
     * User constructor.
     *
     * @param PDO $pdo The database connection object.
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Finds a user by their email address.
     *
     * @param string $email The user's email address.
     * @return mixed The user data or false if not found.
     */
    public function findByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    /**
     * Creates a new user in the database.
     *
     * @param string $nombre_usuario The username.
     * @param string $email The user's email address.
     * @param string $password The plain text password.
     * @param string $rol The user's role.
     * @return bool True on success, false on failure.
     */
    public function create($nombre_usuario, $email, $password, $rol, $referrer_id = null) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $referral_code = $this->generateReferralCode();
        $stmt = $this->pdo->prepare(
            "INSERT INTO usuarios (nombre_usuario, email, password_hash, rol, estado, referrer_id, referral_code)
             VALUES (?, ?, ?, ?, 'activo', ?, ?)"
        );
        return $stmt->execute([$nombre_usuario, $email, $password_hash, $rol, $referrer_id, $referral_code]);
    }

    private function generateReferralCode($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * Updates the password reset token for a user.
     *
     * @param string $email The user's email address.
     * @param string $token The password reset token.
     * @param string $expiration The token's expiration date.
     * @return bool True on success, false on failure.
     */
    public function updateResetToken($email, $token, $expiration) {
        $stmt = $this->pdo->prepare(
            "UPDATE usuarios SET password_reset_token = ?, token_expiration = ? WHERE email = ?"
        );
        return $stmt->execute([$token, $expiration, $email]);
    }

    /**
     * Finds a user by their password reset token.
     *
     * @param string $token The password reset token.
     * @return mixed The user data or false if not found.
     */
    public function findUserByResetToken($token) {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM usuarios WHERE password_reset_token = ? AND token_expiration > NOW()"
        );
        $stmt->execute([$token]);
        return $stmt->fetch();
    }

    /**
     * Updates a user's password using a reset token.
     *
     * @param string $token The password reset token.
     * @param string $password The new plain text password.
     * @return bool True on success, false on failure.
     */
    public function updatePassword($token, $password) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare(
            "UPDATE usuarios SET password_hash = ?, password_reset_token = NULL, token_expiration = NULL WHERE password_reset_token = ?"
        );
        return $stmt->execute([$password_hash, $token]);
    }

    /**
     * Gets all users.
     *
     * @return array An array of all users.
     */
    public function getAll() {
        $stmt = $this->pdo->query("SELECT id, nombre_usuario, email, rol, estado FROM usuarios");
        return $stmt->fetchAll();
    }

    /**
     * Gets a single user by their ID.
     *
     * @param int $id The ID of the user.
     * @return mixed The user data or false if not found.
     */
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT id, nombre_usuario, email, rol, estado FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    /**
     * Updates an existing user.
     *
     * @param int $id The ID of the user to update.
     * @param array $data The new data for the user.
     * @return bool True on success, false on failure.
     */
    public function update($id, $data) {
        $sql = "UPDATE usuarios SET nombre_usuario = ?, email = ?, rol = ?, estado = ?";
        $params = [$data['nombre_usuario'], $data['email'], $data['rol'], $data['estado']];

        if (!empty($data['password'])) {
            $sql .= ", password_hash = ?";
            $params[] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        $sql .= " WHERE id = ?";
        $params[] = $id;

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

    /**
     * Deletes a user.
     *
     * @param int $id The ID of the user to delete.
     * @return bool True on success, false on failure.
     */
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM usuarios WHERE id = ?");
        return $stmt->execute([$id]);
    }

    /**
     * Updates the status of a user.
     *
     * @param int $id The ID of the user to update.
     * @param string $status The new status.
     * @return bool True on success, false on failure.
     */
    public function updateStatus($id, $status) {
        $stmt = $this->pdo->prepare("UPDATE usuarios SET estado = ? WHERE id = ?");
        return $stmt->execute([$status, $id]);
    }

    /**
     * Assigns specific permissions to a user.
     *
     * @param int $user_id The ID of the user.
     * @param array $permissions An array of permission IDs.
     * @return bool True on success, false on failure.
     */
    public function assignPermissions($user_id, $permissions) {
        // Primero, eliminamos los permisos existentes
        $stmt = $this->pdo->prepare("DELETE FROM usuario_permisos WHERE id_usuario = ?");
        $stmt->execute([$user_id]);

        // Luego, insertamos los nuevos permisos
        if (!empty($permissions)) {
            $sql = "INSERT INTO usuario_permisos (id_usuario, id_permiso) VALUES ";
            $values = [];
            foreach ($permissions as $perm_id) {
                $values[] = "($user_id, ?)";
            }
            $sql .= implode(", ", $values);
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute($permissions);
        }
        return true;
    }

    /**
     * Gets all permissions for a user, including those from their role and user-specific permissions.
     *
     * @param int $user_id The ID of the user.
     * @return array An array of permission names.
     */
    public function getPermissions($user_id) {
        // Obtener permisos del rol
        $stmt = $this->pdo->prepare("SELECT p.nombre_permiso FROM permisos p
                                     JOIN roles_permisos rp ON p.id = rp.id_permiso
                                     JOIN usuarios u ON rp.rol = u.rol
                                     WHERE u.id = ?");
        $stmt->execute([$user_id]);
        $role_permissions = $stmt->fetchAll(PDO::FETCH_COLUMN);

        // Obtener permisos específicos del usuario
        $stmt = $this->pdo->prepare("SELECT p.nombre_permiso FROM permisos p
                                     JOIN usuario_permisos up ON p.id = up.id_permiso
                                     WHERE up.id_usuario = ?");
        $stmt->execute([$user_id]);
        $user_permissions = $stmt->fetchAll(PDO::FETCH_COLUMN);

        return array_unique(array_merge($role_permissions, $user_permissions));
    }

    /**
     * Counts all users.
     *
     * @return int The total number of users.
     */
    public function countAll() {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM usuarios");
        return $stmt->fetchColumn();
    }

    /**
     * Gets the top sellers based on the number of sales.
     *
     * @param array $filters The filters to apply to the query.
     * @return array An array of the top sellers.
     */
    public function getTopSellers($filters = []) {
        $sql = "SELECT u.nombre_usuario, COUNT(v.id) as total_ventas
                FROM ventas v
                JOIN usuarios u ON v.id_vendedor = u.id";
        // Lógica de filtros de fecha aquí
        $sql .= " GROUP BY u.nombre_usuario ORDER BY total_ventas DESC LIMIT 10";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getReferredUsers($user_id) {
        $stmt = $this->pdo->prepare("SELECT id, nombre_usuario, email, fecha_creacion FROM usuarios WHERE referrer_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }
}
?>
