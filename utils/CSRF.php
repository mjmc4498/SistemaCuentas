<?php
class CSRF {
    /**
     * Genera un nuevo token CSRF y lo guarda en la sesión.
     */
    public static function generateToken() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
    }

    /**
     * Obtiene el token CSRF actual.
     *
     * @return string El token CSRF.
     */
    public static function getToken() {
        return $_SESSION['csrf_token'];
    }

    /**
     * Valida el token CSRF proporcionado.
     *
     * @param string $token El token a validar.
     * @return bool True si el token es válido, false si no.
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
