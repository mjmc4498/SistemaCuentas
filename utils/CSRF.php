<?php
/**
 * Class CSRF
 *
 * Handles CSRF token generation and validation.
 */
class CSRF {
    /**
     * Generates a new CSRF token and stores it in the session.
     */
    public static function generateToken() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
    }

    /**
     * Gets the current CSRF token.
     *
     * @return string The CSRF token.
     */
    public static function getToken() {
        return $_SESSION['csrf_token'];
    }

    /**
     * Validates the provided CSRF token.
     *
     * @param string $token The token to validate.
     * @return bool True if the token is valid, false otherwise.
     */
    public static function validateToken($token) {
        if (isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token)) {
            // El token es válido, lo eliminamos para que no se pueda reutilizar
            unset($_SESSION['csrf_token']);
            return true;
        }
        return false;
    }
}
?>
