<?php
class Session {
    /**
     * Inicia la sesión y comprueba la expiración.
     */
    public static function init() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
            // 30 minutos de inactividad
            session_unset();
            session_destroy();
            session_start();
        }
        $_SESSION['last_activity'] = time();
    }
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
        $_SESSION['last_activity'] = time();
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
