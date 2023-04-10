<?php require_once __DIR__ . '/../../components/header.main.php' ?>
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
                <h1 class="header-font-custom text-utec text-center">Cambiar Usuario</h1>
                <form action="/tesis/updateUsers/<?= $this->d['userDB']->getId()?>" method="post" class="p-2">
                    <div class="mb-3">
                        <label for="" class="form-label text-utec">Nombre:</label>
                        <input type="text"
                        class="form-control" name="nombre" id="nombre" aria-describedby="helpId" value="<?= $this->d['userDB']->getName() ?>">
                        <small id="helpId" class="form-text text-muted">Ejemplo: Salvador Sicilia</small>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-utec">Usuario:</label>
                        <input type="text"
                        class="form-control" name="usuario" id="usuario" aria-describedby="helpId" value="<?= $this->d['userDB']->getUsername() ?>">
                        <small id="helpId" class="form-text text-muted">Ejemplo: 2735352021</small>
                    </div>
                    <input type="hidden" name="clave" value="<?= $this->d['userDB']->getPassword() ?>">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="radio" id="inlineRadio1" value="Super Usuario" <?=strpos($this->d['userDB']->getRol(), 'Super Usuario') !== false ? 'checked' : false ?>>
                        <label class="form-check-label" for="inlineRadio1">Super Usuario</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="radio" id="inlineRadio2" value="Administrador" <?=strpos($this->d['userDB']->getRol(), 'Administrador') !== false ? 'checked' : false ?>>
                        <label class="form-check-label" for="inlineRadio2">Administrador</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="radio" id="inlineRadio3" value="Usuario">
                        <label class="form-check-label" for="inlineRadio3" <?=strpos($this->d['userDB']->getRol(), 'Usuario') !== false ? 'checked' : false ?>>usuario</label>
                    </div>

                    <div class="mt-5">
                        <input type="submit" class="btn btn-utec" value="Modificar Usuario">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Cambiar Contraseña
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Cambiar Contraseña</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/tesis/updatePassword/<?= $this->d['userDB']->getId()?>" method="post">
            <!-- Campos solo de relleno -->
            <input type="hidden" name="nombre" id="nombre" aria-describedby="helpId" value="<?= $this->d['userDB']->getName()?>">

            <input type="hidden" name="usuario" id="usuario" aria-describedby="helpId" value="<?= $this->d['userDB']->getUsername()?>">

            <input type="hidden" name="radio" id="inlineRadio1" aria-describedby="helpId" value="<?= $this->d['userDB']->getRol()?>">
            <div class="modal-body">
                
                <div class="mb-3">
                    <label for="clave" class="form-label">Nueva Contraseña:</label>
                    <input type="text"
                    class="form-control" name="clave" id="clave" aria-describedby="helpId" placeholder="">
                    <small id="helpId" class="form-text text-muted">ejemplo:5678</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <input type="submit" class="btn btn-danger" value="Cambiar contraseña">
            </div>
        </form>
        </div>
    </div>
    </div>
</main>
<?php require_once __DIR__ . '/../../components/footer.main.php' ?>