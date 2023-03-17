<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->d['title']. " - " . institution ?></title>
</head>
<body>
    <h2>Home <?= $this->d['user']->getUsername() ?></h2>
    <a href="/tesis/signout">Cerrar Seion</a>
</body>
</html>