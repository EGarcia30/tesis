<?php require_once __DIR__ . '/../../components/layoutPrincipal/header.main.php' ?>

<main id="main-content" class="create-user-container">
    <!-- Alerts -->
    <div class="position-relative mb-3">
        <div class="position-absolute end-0 top-0">
            <?php require __DIR__ . '/../../components/alerts.php'; ?>
        </div>
    </div>
    <div class="container mx-auto px-3">
        <!-- Header Actions -->
        <div class="header-actions">
            <a href="/tesis/users/1" class="btn-back-modern">
                <i class="fas fa-arrow-left"></i>
                Regresar a Usuarios
            </a>
        </div>
        <!-- Form Card -->
        <div class="form-card" style="max-width: 800px; margin: 0 auto;">
            <h1 class="form-title">Nuevo Usuario</h1>
            
            <form action="/tesis/createUsers" method="post">
                <!-- Nombre -->
                <div class="form-group-custom">
                    <label class="form-label-custom">
                        <i class="fas fa-user"></i>
                        Nombre Completo
                    </label>
                    <div class="input-wrapper-custom">
                        <i class="fas fa-user input-icon-custom"></i>
                        <input type="text" class="form-control-custom" name="nombre" id="nombre" placeholder="Ingresa el nombre completo" required>
                    </div>
                    <small class="form-text-custom">
                        <i class="fas fa-info-circle"></i>
                        Ejemplo: Salvador Sicilia
                    </small>
                </div>

                <!-- Usuario -->
                <div class="form-group-custom">
                    <label class="form-label-custom">
                        <i class="fas fa-id-card"></i>
                        Usuario
                    </label>
                    <div class="input-wrapper-custom">
                        <i class="fas fa-id-card input-icon-custom"></i>
                        <input type="text" class="form-control-custom" name="usuario" id="usuario" placeholder="Ingresa el usuario" required>
                    </div>
                    <small class="form-text-custom">
                        <i class="fas fa-info-circle"></i>
                        Ejemplo: 2735352021
                    </small>
                </div>

                <!-- Contraseña -->
                <div class="form-group-custom">
                    <label class="form-label-custom">
                        <i class="fas fa-lock"></i>
                        Contraseña
                    </label>
                    <div class="input-wrapper-custom">
                        <i class="fas fa-lock input-icon-custom"></i>
                        <input type="password" class="form-control-custom" name="clave" id="clave" placeholder="Ingresa la contraseña" required>
                    </div>
                    <small class="form-text-custom">
                        <i class="fas fa-info-circle"></i>
                        Usa una contraseña segura
                    </small>
                </div>

                <!-- Rol de Usuario -->
                <div class="radio-section-custom">
                    <div class="radio-title">
                        <i class="fas fa-user-tag"></i>
                        Selecciona el Rol de Usuario
                    </div>
                    <div>
                        <div class="form-check-custom">
                            <input class="form-check-input" type="radio" name="radio" id="superUsuario" value="Super Usuario" required>
                            <label class="form-check-label" for="superUsuario">
                                Super Usuario
                            </label>
                        </div>
                        <div class="form-check-custom">
                            <input class="form-check-input" type="radio" name="radio" id="administrador" value="Administrador">
                            <label class="form-check-label" for="administrador">
                                Administrador
                            </label>
                        </div>
                        <div class="form-check-custom">
                            <input class="form-check-input" type="radio" name="radio" id="usuario" value="Usuario">
                            <label class="form-check-label" for="usuario">
                                Usuario
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="btn-submit-custom">
                        <i class="fas fa-user-plus"></i>
                        Crear Usuario
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../../components/layoutPrincipal/footer.main.php' ?>