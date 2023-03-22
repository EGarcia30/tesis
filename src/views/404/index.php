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
    <title>Error - <?= institution ?></title>
</head>
<body>
    <div class="p-5 mb-4 bg-light rounded-3 d-flex flex-column align-items-center vh-100">
        <div class="container-fluid py-5 text-center">
            <h1 class="display-5 fw-bold"><?= $this->d['status'] ?></h1>
            <p class="col-md-8 fs-4 my-3 mx-auto"><?= $this->d['message'] ?></p>
            <a href="/tesis/home" class="btn btn-lg btn-utec">Regresar</a>
        </div>
    </div>
</body>
</html>