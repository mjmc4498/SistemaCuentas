<?php
class Session {
    /**
     * Inicia la sesión si no ha sido iniciada ya.
     */
    public static function start() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Establece un valor en la sesión.
     *
     * @param string $key La clave.
     * @param mixed $value El valor.
     */
    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    /**
     * Obtiene un valor de la sesión.
     *
     * @param string $key La clave.
     * @return mixed El valor de la sesión, o null si no existe.
     */
    public static function get($key) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    /**
     * Elimina un valor de la sesión.
     *
     * @param string $key La clave.
     */
    public static function unset($key) {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * Destruye la sesión actual.
     */
    public static function destroy() {
        session_destroy();
    }
}
?>
