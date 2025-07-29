<?php
class Mailer {
    /**
     * Sends an email (simulation).
     *
     * @param string $to The recipient's email address.
     * @param string $subject The email subject.
     * @param string $body The email body.
     * @return bool True on success, false on failure.
     */
    public static function send($to, $subject, $body) {
        // En un entorno real, aquí se usaría una librería como PHPMailer.
        // Por ahora, simulamos el envío guardando el email en un archivo de log.
        $log_message = "---- NUEVO EMAIL ----\n";
        $log_message .= "Para: $to\n";
        $log_message .= "Asunto: $subject\n";
        $log_message .= "Cuerpo: $body\n";
        $log_message .= "--------------------\n\n";

        file_put_contents('../logs/emails.log', $log_message, FILE_APPEND);
        return true;
    }
}
?>
