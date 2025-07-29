<?php
require_once '../utils/Session.php';
require_once '../models/User.php';
require_once '../includes/database.php';

function check_role($required_role) {
    Session::init();

    if (!Session::get('user_id')) {
        header('Location: ../views/login.php');
        exit;
    }

    if (Session::get('user_rol') !== $required_role) {
        header('HTTP/1.0 403 Forbidden');
        echo 'Acceso denegado. No tienes el rol requerido.';
        exit;
    }
}

function check_permission($required_permission) {
    Session::init();
    global $pdo;

    if (!Session::get('user_id')) {
        header('Location: ../views/login.php');
        exit;
    }

    $userModel = new User($pdo);
    $permissions = $userModel->getPermissions(Session::get('user_id'));

    if (!in_array($required_permission, $permissions)) {
        header('HTTP/1.0 403 Forbidden');
        echo 'Acceso denegado. No tienes el permiso requerido.';
        exit;
    }
}
?>
