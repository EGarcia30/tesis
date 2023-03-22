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
                            <li><a class="dropdown-item font-custom" href="/tesis/home">Perfil</a></li>
                            <li><a class="dropdown-item font-custom" href="/tesis/home">Administrar Usuarios</a></li>
                            <li><a class="dropdown-item font-custom" href="/tesis/signout">Cerrar Sesión</a></li>
                        </ul>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="vertical-menu" class="position-absolute bg-white vh-custom hide">
        <div class="container pt-3 pe-3 d-flex flex-column text-center">
            <a href="/tesis/home" class="mb-3 text-dark text-decoration-none">
                <span class="icon">
                    <i class="fas fa-plus"></i>
                </span>
                <p class="font-custom">Agregar</p>
            </a>
            <a href="/tesis/home" class="mb-3 text-dark text-decoration-none">
                <span class="icon">
                    <i class="fas fa-search"></i>
                </span>
                <p class="font-custom">Buscar</p>
            </a>
            <a href="/tesis/home" class="text-dark text-decoration-none">
                <span class="icon">
                    <i class="fas fa-eye"></i>
                </span>
                <p class="font-custom">Ver</p>
            </a>
        </div>
    </div>
    <div id="back-menu"></div>
