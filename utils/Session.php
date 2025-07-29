<?php
/**
 * Class Session
 *
 * Handles session management.
 */
class Session {
    /**
     * Initializes the session and checks for expiration.
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
     * Starts the session if it has not been started already.
     */
    public static function start() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Sets a value in the session.
     *
     * @param string $key The key.
     * @param mixed $value The value.
     */
    public static function set($key, $value) {
        $_SESSION[$key] = $value;
        $_SESSION['last_activity'] = time();
    }

    /**
     * Gets a value from the session.
     *
     * @param string $key The key.
     * @return mixed The session value or null if not found.
     */
    public static function get($key) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    /**
     * Unsets a value from the session.
     *
     * @param string $key The key.
     */
    public static function unset($key) {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * Destroys the current session.
     */
    public static function destroy() {
        session_destroy();
    }
}
?>
