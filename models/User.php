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
}
?>
