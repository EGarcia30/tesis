<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Bootstrap y css-->
    <link rel="stylesheet" href="<?= URL_PATH ?>/css/styles.css">
    <!--ICONS-->
    <script src="https://kit.fontawesome.com/be9e926d45.js" crossorigin="anonymous"></script>
    <link rel="icon" href="<?= URL_PATH ?>/img/utec_favicon.png">
    <!--Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat&display=swap" rel="stylesheet">

    <title><?= $this->d['title']. " - " . institution ?></title>
</head>
<body class="vh-100 bg-secondary bg-opacity-10 position-relative">
    <div class="w-100 bg-utec">
        <div class="container-fluid mx-auto p-3">
            <div class="d-flex flex-wrap">
                <div class="col col-md-7 d-flex align-items-center">
                    <span id="icon-menu" class="icon text-white">
                        <i class="fas fa-bars"></i>
                    </span>
                    <span id="icon-close" class="icon text-white close">
                        <i class="fas fa-times"></i>
                    </span>
                    <div class="img-brand ms-4">
                        <img src="<?= URL_PATH ?>/img/utec_brand.png" class="img-fluid rounded-top" alt="Universidad tecnológica de El Salvador">
                    </div>
                </div>
                <div class="col col-md-5 d-flex justify-content-end align-items-center">
                    <div class="dropdown">
                        <button class="btn btn-utec dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="icon profile-icon text-white">
                                <i class="fas fa-user"></i>
                            </span>
                        </button>
                        <ul class="dropdown-menu">
                            <li class="dropdown-item font-custom pointer-event"><?= $this->d['user']->getRol()?></li>
                            <li><a class="dropdown-item font-custom" href="/tesis/perfil">Perfil</a></li>
                            <li class="<?= $this->d['user']->getRol() == "Usuario" ? 'd-none' : '' ?>"><a class="dropdown-item font-custom" href="/tesis/users/1">Administrar Usuarios</a></li>
                            <li><a class="dropdown-item font-custom" href="/tesis/signout">Cerrar Sesión</a></li>
                        </ul>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="vertical-menu" class="position-absolute bg-white vh-custom hide">
        <div class="container p-4 pt-5 d-flex flex-column text-start">
            <a href="/tesis/home" class="text-dark text-decoration-none">
                <p class="font-custom">Inicio</p>
            </a>
            <a href="/tesis/planes/1" class="text-dark text-decoration-none">
                <p class="font-custom">Plan de Estudio</p>
            </a>
            <a href="/tesis/creadores/1" class="text-dark text-decoration-none">
                <p class="font-custom">Especialistas/<br>Creadores</p>
            </a>
            <a href="/tesis/creadores/1" class="text-dark text-decoration-none">
                <p class="font-custom">Editor</p>
            </a>
        </div>
    </div>
    <div id="back-menu"></div>