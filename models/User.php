<?php
class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Encuentra un usuario por su dirección de correo electrónico.
     *
     * @param string $email El correo electrónico del usuario.
     * @return mixed Devuelve un array con los datos del usuario si se encuentra, o false si no.
     */
    public function findByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    /**
     * Crea un nuevo usuario en la base de datos.
     *
     * @param string $nombre_usuario El nombre de usuario.
     * @param string $email El correo electrónico del usuario.
     * @param string $password La contraseña sin hashear.
     * @param string $rol El rol del usuario.
     * @return bool Devuelve true si el usuario se creó correctamente, o false si no.
     */
    public function create($nombre_usuario, $email, $password, $rol) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare(
            "INSERT INTO usuarios (nombre_usuario, email, password_hash, rol, estado)
             VALUES (?, ?, ?, ?, 'activo')"
        );
        return $stmt->execute([$nombre_usuario, $email, $password_hash, $rol]);
    }

    public function updateResetToken($email, $token, $expiration) {
        $stmt = $this->pdo->prepare(
            "UPDATE usuarios SET password_reset_token = ?, token_expiration = ? WHERE email = ?"
        );
        return $stmt->execute([$token, $expiration, $email]);
    }

    public function findUserByResetToken($token) {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM usuarios WHERE password_reset_token = ? AND token_expiration > NOW()"
        );
        $stmt->execute([$token]);
        return $stmt->fetch();
    }

    public function updatePassword($token, $password) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare(
            "UPDATE usuarios SET password_hash = ?, password_reset_token = NULL, token_expiration = NULL WHERE password_reset_token = ?"
        );
        return $stmt->execute([$password_hash, $token]);
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT id, nombre_usuario, email, rol, estado FROM usuarios");
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT id, nombre_usuario, email, rol, estado FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

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

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM usuarios WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function updateStatus($id, $status) {
        $stmt = $this->pdo->prepare("UPDATE usuarios SET estado = ? WHERE id = ?");
        return $stmt->execute([$status, $id]);
    }

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

    public function countAll() {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM usuarios");
        return $stmt->fetchColumn();
    }
}
?>
