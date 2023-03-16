<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action="/tesis/home" method="post">
        <div>
            <label for="">Ingresar Usuario:</label>
            <input type="text" name="usuario">
        </div>
        <div>
            <label for="">Ingresar Contraseña:</label>
            <input type="password" name="clave">
        </div>
        <div>
            <input type="submit" value="Iniciar Sesion">
        </div>

    </form>

    <div>
        <a href="/tesis/signup">¡crear cuenta(temporal)!</a>
    </div>
    
</body>
</html>