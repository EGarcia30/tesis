<?php require_once __DIR__ . '/../../components/layoutPrincipal/header.main.php' ?>
<main id="main-content" class="w-custom">
    <div class="w-100 position-relative">
        <div class="d-flex flex-column gap-4 container mx-auto p-3">
            <div class="d-flex flex-wrap gap-2 text-center">
                <a href="/tesis/users/1" class="btn btn-utec">Regresar</a>
            </div>

            <div class="position-absolute end-0 top-0 mt-1">
                <?php require __DIR__ . '/../../components/alerts.php'; ?>
            </div>

            <div class="card card-height container p-3 bg-white">
                <h1 class="header-font-custom text-utec text-center">Crear un Nuevo Usuario</h1>
                <form action="/tesis/createUsers" method="post" class="p-2">
                    <div class="mb-3">
                        <label for="" class="form-label text-utec">Nombre:</label>
                        <input type="text"
                        class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="">
                        <small id="helpId" class="form-text text-muted">Ejemplo: Salvador Sicilia</small>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-utec">Usuario:</label>
                        <input type="text"
                        class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="">
                        <small id="helpId" class="form-text text-muted">Ejemplo: 2735352021</small>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-utec">Contraseña:</label>
                        <input type="text"
                        class="form-control" name="clave" id="clave" aria-describedby="helpId" placeholder="">
                        <small id="helpId" class="form-text text-muted">Ejemplo: 123456</small>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="radio" id="inlineRadio1" value="Super Usuario">
                        <label class="form-check-label" for="inlineRadio1">Super Usuario</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="radio" id="inlineRadio2" value="Administrador">
                        <label class="form-check-label" for="inlineRadio2">Administrador</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="radio" id="inlineRadio3" value="Usuario">
                        <label class="form-check-label" for="inlineRadio3">Usuario</label>
                    </div>

                    <div class="mt-5">
                        <input type="submit" class="btn btn-utec" value="Crear nuevo Usuario">
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<?php require_once __DIR__ . '/../../components/layoutPrincipal/footer.main.php' ?>