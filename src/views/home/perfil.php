<?php require_once __DIR__ . '/../../components/layoutPrincipal/header.main.php' ?>

<main id="main-content" class="main-gradient">
    <div class="container mx-auto p-3" style="max-width: 600px;">
        <div class="welcome-card p-4 text-center mb-4">
            <h1 class="gradient-text header-font-custom mb-3">Mi Perfil</h1>
            <form action="/tesis/updatePerfil/<?= $this->d['user']->getId()?>" method="post" class="p-2">
                <div class="mb-3 text-start">
                    <label for="nombre" class="form-label text-utec fw-semibold">Nombre:</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" value="<?= $this->d['user']->getName() ?>">
                    <small class="form-text text-muted">Ejemplo: Salvador Sicilia</small>
                </div>
                <div class="mb-3 text-start">
                    <label for="usuario" class="form-label text-utec fw-semibold">Usuario:</label>
                    <input type="text" class="form-control" name="usuario" id="usuario" value="<?= $this->d['user']->getUsername() ?>">
                    <small class="form-text text-muted">Ejemplo: 2735352021</small>
                </div>
                <input type="hidden" name="clave" value="<?= $this->d['user']->getPassword() ?>">

                <div class="mb-4 text-start">
                    <label class="fw-semibold text-utec d-block mb-2">Rol:</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="radio" id="superUsuario" value="Super Usuario" <?= $this->d['user']->getRol() === 'Super Usuario' ? 'checked' : '' ?>>
                        <label class="form-check-label" for="superUsuario">Super Usuario</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="radio" id="administrador" value="Administrador" <?= $this->d['user']->getRol() === 'Administrador' ? 'checked' : '' ?>>
                        <label class="form-check-label" for="administrador">Administrador</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="radio" id="usuario" value="Usuario" <?= $this->d['user']->getRol() === 'Usuario' ? 'checked' : '' ?>>
                        <label class="form-check-label" for="usuario">Usuario</label>
                    </div>
                </div>

                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <input type="submit" class="btn btn-utec mb-3 mb-sm-0" value="Actualizar perfil">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?= $this->d['user']->getId()?>">
                        Cambiar Contraseña
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal sin cambios importantes, solo añade clases propias para sombra y bordes -->
    <div class="modal fade" id="staticBackdrop<?= $this->d['user']->getId()?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3 rounded shadow-sm">
                <div class="modal-header border-0">
                <h5 class="modal-title">Cambiar Contraseña</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <form action="/tesis/updatePasswordPerfil/<?= $this->d['user']->getId()?>" method="post">
                <input type="hidden" name="nombre" value="<?= $this->d['user']->getName()?>">
                <input type="hidden" name="usuario" value="<?= $this->d['user']->getUsername()?>">
                <input type="hidden" name="radio" value="<?= $this->d['user']->getRol()?>">
                <div class="modal-body">
                    <div class="mb-3">
                    <label for="clave" class="form-label">Nueva Contraseña:</label>
                    <input type="password" class="form-control" name="clave" id="clave" >
                    <small class="form-text text-muted">Ejemplo: 5678</small>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <input type="submit" class="btn btn-danger" value="Cambiar contraseña">
                </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../../components/layoutPrincipal/footer.main.php' ?>