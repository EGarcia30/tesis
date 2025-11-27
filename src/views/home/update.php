<?php require_once __DIR__ . '/../../components/layoutPrincipal/header.main.php' ?>

<main id="main-content" class="profile-container">
    <div class="w-100 position-relative p-3">
        <div class="position-absolute end-0 top-0 mt-1">
            <?php require __DIR__ . '/../../components/alerts.php'; ?>
        </div>
    </div>  

    <div class="container mx-auto p-3">   
        <!-- Header Actions -->
        <div class="header-actions">
            <a href="/tesis/users/1" class="btn-back-modern">
                <i class="fas fa-arrow-left"></i>
                Regresar a Usuarios
            </a>
        </div>   
        <div class="profile-card" style="max-width: 700px; margin: 0 auto;">
            <h1 class="gradient-text text-center">Usuario</h1>            
            <form action="/tesis/updateUsers/<?= $this->d['userDB']->getId()?>" method="post">
                <div class="mb-4">
                    <label for="nombre" class="form-label-modern">
                        <i class="fas fa-user"></i>
                        Nombre Completo
                    </label>
                    <input type="text" class="form-control form-control-modern" name="nombre" id="nombre" value="<?= $this->d['userDB']->getName() ?>" required>
                    <small class="form-text-modern">
                        <i class="fas fa-info-circle"></i>
                        Ejemplo: Salvador Sicilia
                    </small>
                </div>
                
                <div class="mb-4">
                    <label for="usuario" class="form-label-modern">
                        <i class="fas fa-id-card"></i>
                        Usuario
                    </label>
                    <input type="text" class="form-control form-control-modern" name="usuario" id="usuario" value="<?= $this->d['userDB']->getUsername() ?>" required>
                    <small class="form-text-modern">
                        <i class="fas fa-info-circle"></i>
                        Ejemplo: 2735352021
                    </small>
                </div>
                
                <input type="hidden" name="clave" value="<?= $this->d['userDB']->getPassword() ?>">

                <div class="mb-4">
                    <label class="form-label-modern mb-3">
                        <i class="fas fa-user-tag"></i>
                        Rol de Usuario
                    </label>
                    <div class="radio-section">
                        <div class="form-check-modern">
                            <input class="form-check-input" type="radio" name="radio" id="superUsuario" value="Super Usuario" <?= $this->d['userDB']->getRol() === 'Super Usuario' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="superUsuario">Super Usuario</label>
                        </div>
                        <div class="form-check-modern">
                            <input class="form-check-input" type="radio" name="radio" id="administrador" value="Administrador" <?= $this->d['userDB']->getRol() === 'Administrador' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="administrador">Administrador</label>
                        </div>
                        <div class="form-check-modern">
                            <input class="form-check-input" type="radio" name="radio" id="usuario" value="Usuario" <?= $this->d['userDB']->getRol() === 'Usuario' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="usuario">Usuario</label>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-between align-items-stretch align-items-sm-center">
                    <button type="submit" class="btn-update">
                        <i class="fas fa-save"></i>
                        Actualizar Perfil
                    </button>
                    <button type="button" class="btn-password" data-bs-toggle="modal" data-bs-target="#passwordModal<?= $this->d['userDB']->getId()?>">
                        <i class="fas fa-key"></i>
                        Cambiar Contraseña
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="passwordModal<?= $this->d['userDB']->getId()?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-modern">
                <div class="modal-header modal-header-modern">
                    <h5 class="modal-title">
                        <i class="fas fa-lock me-2"></i>
                        Cambiar Contraseña
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                
                <form action="/tesis/updatePassword/<?= $this->d['userDB']->getId()?>" method="post">
                    <input type="hidden" name="nombre" value="<?= $this->d['userDB']->getName()?>">
                    <input type="hidden" name="usuario" value="<?= $this->d['userDB']->getUsername()?>">
                    <input type="hidden" name="radio" value="<?= $this->d['userDB']->getRol()?>">
                    
                    <div class="modal-body modal-body-modern">
                        <div class="mb-3">
                            <label for="clave" class="form-label-modern">
                                <i class="fas fa-key"></i>
                                Nueva Contraseña
                            </label>
                            <input type="password" class="form-control form-control-modern" name="clave" id="clave" required>
                            <small class="form-text-modern">
                                <i class="fas fa-info-circle"></i>
                                Ingresa tu nueva contraseña de forma segura
                            </small>
                        </div>
                    </div>
                    
                    <div class="modal-footer modal-footer-modern">
                        <button type="button" class="btn-modal-close" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i>
                            Cancelar
                        </button>
                        <button type="submit" class="btn-modal-change">
                            <i class="fas fa-check me-1"></i>
                            Cambiar Contraseña
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../../components/layoutPrincipal/footer.main.php' ?>