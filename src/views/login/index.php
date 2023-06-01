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
    <!--titulo-->
    <title>Iniciar Sesion - <?= institution ?></title>
</head>
<body>
<main class="w-100 bg-image">
    <div class="container mx-auto p-3 vh-100 d-flex justify-content-center align-items-center">
        <div class="card p-2 p-lg-5 bg-body bg-opacity-75">
            <div class="row g-0">
                <div class="col-md-5">
                    <img src="<?= URL_PATH ?>/img/utec_logo.png" class="img-fluid rounded-start h-100" alt="Card title">
                </div>
                <div class="col-md-7">
                <div class="card-body">
                    <h1 class="text-center text-utec">Bienvenido de Nuevo</h1>
                    <form action="/tesis/auth" method="post">
                        <div class="mt-4">
                            <label for="" class="form-label">Ingresar Usuario:</label>
                            <input type="text" name="usuario" class="form-control">
                        </div>
                        <div class="mt-4">
                            <label for="" class="form-label">Ingresar contraseña:</label>
                            <input type="password" name="clave" class="form-control">
                        </div>
                        <div class="mt-4 mb-2">
                            <input type="submit" class="btn btn-utec d-block w-100" value="Iniciar Sesión">
                        </div>
                        <?php require __DIR__ . '/../../components/alerts.php'; ?>
                    </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</main>
    <script src="<?= URL_PATH ?>/../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>