<?php
class Log {
    /**
     * Agrega una nueva entrada al log.
     *
     * @param PDO $pdo La instancia de PDO.
     * @param int $id_usuario El ID del usuario que realiza la acción.
     * @param string $accion La descripción de la acción.
     */
    public static function add($pdo, $id_usuario, $accion) {
        $stmt = $pdo->prepare("INSERT INTO logs (id_usuario, accion) VALUES (?, ?)");
        $stmt->execute([$id_usuario, $accion]);
    }
}
?>
