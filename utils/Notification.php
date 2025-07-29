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

            echo "
            <div class='position-fixed bottom-0 end-0 p-3' style='z-index: 11'>
                <div id='liveToast' class='toast show' role='alert' aria-live='assertive' aria-atomic='true'>
                    <div class='toast-header'>
                        <strong class='me-auto'>Notificación</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='toast' aria-label='Close'></button>
                    </div>
                    <div class='toast-body'>
                        $message
                    </div>
                </div>
            </div>
            ";

            Session::unset('notification');
        }
    }
}
?>
