<?php
class Notification {
    /**
     * Establece una notificación flash.
     *
     * @param string $type El tipo de notificación (e.g., 'success', 'error', 'info').
     * @param string $message El mensaje de la notificación.
     */
    public static function set($type, $message) {
        Session::set('notification', [
            'type' => $type,
            'message' => $message,
        ]);
    }

    /**
     * Muestra la notificación si existe y luego la elimina.
     */
    public static function display() {
        if (Session::get('notification')) {
            $notification = Session::get('notification');
            $type = htmlspecialchars($notification['type']);
            $message = htmlspecialchars($notification['message']);

            echo "<div class='alert alert-$type' role='alert'>$message</div>";

            Session::unset('notification');
        }
    }
}
?>
