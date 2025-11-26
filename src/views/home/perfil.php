<?php require_once __DIR__ . '/../../components/layoutPrincipal/header.main.php' ?>

<style>
    :root {
        --primary-color: #6d1d3c;
        --primary-dark: #541730;
        --primary-light: #8a2449;
        --primary-gradient: linear-gradient(135deg, #6d1d3c 0%, #8a2449 100%);
        --card-shadow: 0 10px 30px rgba(109, 29, 60, 0.1);
        --hover-shadow: 0 15px 40px rgba(109, 29, 60, 0.2);
    }
    
    .profile-container {
        background: linear-gradient(135deg, #fef5f8 0%, #f5e6ed 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }
    
    .profile-card {
        background: white;
        border-radius: 24px;
        box-shadow: var(--card-shadow);
        padding: 2.5rem;
        border: 1px solid rgba(109, 29, 60, 0.1);
        position: relative;
        overflow: hidden;
    }
    
    .profile-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: var(--primary-gradient);
    }
    
    .gradient-text {
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 800;
        font-size: 2.5rem;
        margin-bottom: 2rem;
    }
    
    .form-label-modern {
        color: var(--primary-color);
        font-weight: 600;
        font-size: 0.95rem;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .form-control-modern {
        border: 2px solid rgba(109, 29, 60, 0.15);
        border-radius: 12px;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
        font-size: 1rem;
    }
    
    .form-control-modern:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(109, 29, 60, 0.15);
        transform: translateY(-2px);
    }
    
    .form-text-modern {
        color: #6c757d;
        font-size: 0.85rem;
        margin-top: 0.4rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }
    
    .radio-section {
        background: linear-gradient(135deg, #fafafa 0%, #f5f5f5 100%);
        border-radius: 16px;
        padding: 1.5rem;
        border: 2px solid rgba(109, 29, 60, 0.1);
    }
    
    .form-check-modern {
        background: white;
        border: 2px solid rgba(109, 29, 60, 0.15);
        border-radius: 12px;
        padding: 0.75rem 1.25rem;
        margin-right: 0.75rem;
        margin-bottom: 0.75rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
    }
    
    .form-check-modern:hover {
        border-color: var(--primary-color);
        background: linear-gradient(135deg, rgba(109, 29, 60, 0.03) 0%, rgba(138, 36, 73, 0.03) 100%);
        transform: translateY(-2px);
    }
    
    .form-check-input:checked {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }
    
    .form-check-modern .form-check-input {
        width: 1.25rem;
        height: 1.25rem;
        margin-right: 0.75rem;
        cursor: pointer;
    }
    
    .form-check-modern .form-check-label {
        margin: 0;
        cursor: pointer;
        font-weight: 500;
    }
    
    .btn-update {
        background: var(--primary-gradient);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 0.75rem 2rem;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .btn-update:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(109, 29, 60, 0.3);
        color: white;
    }
    
    .btn-password {
        background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 0.75rem 2rem;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .btn-password:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(13, 110, 253, 0.3);
        color: white;
    }
    
    .modal-content-modern {
        border-radius: 20px;
        border: none;
        box-shadow: var(--hover-shadow);
        overflow: hidden;
    }
    
    .modal-header-modern {
        background: var(--primary-gradient);
        color: white;
        border: none;
        padding: 1.5rem 2rem;
    }
    
    .modal-header-modern .btn-close {
        filter: brightness(0) invert(1);
    }
    
    .modal-body-modern {
        padding: 2rem;
    }
    
    .modal-footer-modern {
        border: none;
        padding: 1.5rem 2rem;
        gap: 0.75rem;
    }
    
    .btn-modal-close {
        background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 0.6rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-modal-close:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(108, 117, 125, 0.3);
    }
    
    .btn-modal-change {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 0.6rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-modal-change:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
    }
    
    @media (max-width: 768px) {
        .profile-card {
            padding: 2rem 1.5rem;
        }
        
        .gradient-text {
            font-size: 2rem;
        }
        
        .form-check-modern {
            width: 100%;
            margin-right: 0;
        }
        
        .btn-update, .btn-password {
            width: 100%;
            justify-content: center;
        }
    }
    
    @media (max-width: 576px) {
        .profile-card {
            padding: 1.5rem 1rem;
        }
        
        .gradient-text {
            font-size: 1.75rem;
        }
        
        .radio-section {
            padding: 1rem;
        }
    }
</style>

<main id="main-content" class="profile-container">
    <div class="w-100 position-relative p-3">
        <div class="position-absolute end-0 top-0 mt-1">
            <?php require __DIR__ . '/../../components/alerts.php'; ?>
        </div>
    </div>
    
    <div class="container mx-auto p-3" style="max-width: 700px;">        
        <div class="profile-card">
            <h1 class="gradient-text text-center">Mi Perfil</h1>
            
            <form action="/tesis/updatePerfil/<?= $this->d['user']->getId()?>" method="post">
                <div class="mb-4">
                    <label for="nombre" class="form-label-modern">
                        <i class="fas fa-user"></i>
                        Nombre Completo
                    </label>
                    <input type="text" class="form-control form-control-modern" name="nombre" id="nombre" value="<?= $this->d['user']->getName() ?>" required>
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
                    <input type="text" class="form-control form-control-modern" name="usuario" id="usuario" value="<?= $this->d['user']->getUsername() ?>" required>
                    <small class="form-text-modern">
                        <i class="fas fa-info-circle"></i>
                        Ejemplo: 2735352021
                    </small>
                </div>
                
                <input type="hidden" name="clave" value="<?= $this->d['user']->getPassword() ?>">

                <div class="mb-4">
                    <label class="form-label-modern mb-3">
                        <i class="fas fa-user-tag"></i>
                        Rol de Usuario
                    </label>
                    <div class="radio-section">
                        <div class="form-check-modern">
                            <input class="form-check-input" type="radio" name="radio" id="superUsuario" value="Super Usuario" <?= $this->d['user']->getRol() === 'Super Usuario' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="superUsuario">Super Usuario</label>
                        </div>
                        <div class="form-check-modern">
                            <input class="form-check-input" type="radio" name="radio" id="administrador" value="Administrador" <?= $this->d['user']->getRol() === 'Administrador' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="administrador">Administrador</label>
                        </div>
                        <div class="form-check-modern">
                            <input class="form-check-input" type="radio" name="radio" id="usuario" value="Usuario" <?= $this->d['user']->getRol() === 'Usuario' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="usuario">Usuario</label>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-between align-items-stretch align-items-sm-center">
                    <button type="submit" class="btn-update">
                        <i class="fas fa-save"></i>
                        Actualizar Perfil
                    </button>
                    <button type="button" class="btn-password" data-bs-toggle="modal" data-bs-target="#passwordModal<?= $this->d['user']->getId()?>">
                        <i class="fas fa-key"></i>
                        Cambiar Contraseña
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="passwordModal<?= $this->d['user']->getId()?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-modern">
                <div class="modal-header modal-header-modern">
                    <h5 class="modal-title">
                        <i class="fas fa-lock me-2"></i>
                        Cambiar Contraseña
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                
                <form action="/tesis/updatePasswordPerfil/<?= $this->d['user']->getId()?>" method="post">
                    <input type="hidden" name="nombre" value="<?= $this->d['user']->getName()?>">
                    <input type="hidden" name="usuario" value="<?= $this->d['user']->getUsername()?>">
                    <input type="hidden" name="radio" value="<?= $this->d['user']->getRol()?>">
                    
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