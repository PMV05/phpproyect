<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OportuniHub</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $app_path . "style.css"?>">
</head>
<body>
    <header>
        <a href="<?php echo $app_path;?>"><h1>OportuniHub</h1></a>

        <!-- Menu para navegar entre las paginas -->
        <nav>
            <ul>
                <li><a href="<?php echo $app_path; ?>">Inicio</a></li>
                <li><a href="<?php echo $app_path; ?>opportunity/">Oportunidades</a></li>
                <li><a href="<?php echo $app_path; ?>suscribe/">Suscribirme</a></li>
                <li><a href="<?php echo $app_path; ?>profile/">Perfil</a></li>
            </ul>
        </nav>
    </header>
