<?php
// Obtiene la ruta del archivo
$doc_root = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT', FILTER_SANITIZE_STRING);

// Obtiene la direccion de la aplicacion
$uri = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_STRING);
$dirs = explode('/', $uri);
$app_path = '/' . $dirs[1] . '/' . $dirs[2] . '/';
// $app_path = '/' . $dirs[1] . '/' . $dirs[2] . '/' . $dirs[3] . '/';

// Asigna el include path
set_include_path($doc_root . $app_path);
?>
