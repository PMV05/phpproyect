<?php
    // Obtiene la ruta del archivo
    $doc_root = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT', FILTER_SANITIZE_STRING);

    // Obtiene la direccion de la aplicacion
    $uri = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_STRING);
    $dirs = explode('/', $uri);
    // $app_path = '/' . $dirs[1] . '/' . $dirs[2] . '/';
    $app_path = '/' . $dirs[1] . '/' . $dirs[2] . '/' . $dirs[3] . '/';

    // Asigna el include path
    set_include_path($doc_root . $app_path);

    // Dos semanas en segundos
    $lifetime = 60 * 30;

    // Si no existe un session, entonces se inicia
    if(session_status() == PHP_SESSION_NONE){
        session_set_cookie_params($lifetime, "/");
        session_start();
    }

    $isAdminLog = False;
    $isUserLog = False;

    if(isset($_SESSION['admin_user'])){
        $admin_username = $_SESSION['admin_user'];
        $adminRole = $_SESSION['admin_role'];
        $isAdminLog = True;
    }
    else 
        $isAdminLog = False;

    // Si en el session hay un valor entonces esta iniciado la sesion
    if(isset($_SESSION['user'])){
        $username = $_SESSION['user'];
        $userRole = $_SESSION['role'];
        $isUserLog = True;
    }
    else 
        $isUserLog = False;
?>
