<?php require_once __DIR__ . '/../../components/layoutPrincipal/header.main.php' ?>

<main id="main-content" class="create-user-container">
    <div class="position-relative mb-3">
        <div class="position-absolute end-0 top-0">
            <?php require __DIR__ . '/../../components/alerts.php'; ?>
        </div>
    </div>
    <div class="container mx-auto px-3">
        <div class="header-actions">
            <a href="/tesis/facultades/1" class="btn-back-modern">
                <i class="fas fa-arrow-left"></i>
                Regresar a Facultades
            </a>
        </div>

        <div class="form-card" style="max-width: 700px; margin: 0 auto;">
            <h1 class="form-title">Crear Facultad</h1>
            
            <form action="/tesis/createFacultad" method="post">
                <div class="form-group-custom">
                    <label class="form-label-custom">
                        <i class="fas fa-university"></i>
                        Nombre de la Facultad
                    </label>
                    <div class="input-wrapper-custom">
                        <i class="fas fa-university input-icon-custom"></i>
                        <input type="text" class="form-control-custom" name="nombre" id="nombre" placeholder="Ingresa el nombre completo" required>
                    </div>
                    <small class="form-text-custom">
                        <i class="fas fa-info-circle"></i>
                        Ejemplo: Facultad de Informática y Ciencias Aplicadas
                    </small>
                </div>

                <div class="form-group-custom">
                    <label class="form-label-custom">
                        <i class="fas fa-tag"></i>
                        Acrónimo
                    </label>
                    <div class="input-wrapper-custom">
                        <i class="fas fa-tag input-icon-custom"></i>
                        <input type="text" class="form-control-custom" name="acronimo" id="acronimo" placeholder="Ingresa el acrónimo" required maxlength="10">
                    </div>
                    <small class="form-text-custom">
                        <i class="fas fa-info-circle"></i>
                        Ejemplo: FICA
                    </small>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn-submit-custom">
                        <i class="fas fa-plus-circle"></i>
                        Crear Facultad
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../../components/layoutPrincipal/footer.main.php' ?>