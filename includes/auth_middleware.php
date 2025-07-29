<?php
require_once '../utils/Session.php';

function check_auth($required_role) {
    Session::init();

    if (!Session::get('user_id')) {
        header('Location: ../views/login.php');
        exit;
    }

    if (Session::get('user_rol') !== $required_role) {
        header('HTTP/1.0 403 Forbidden');
        echo 'Acceso denegado. No tienes permiso para ver esta página.';
        exit;
    }
}
?>
