<?php require_once __DIR__ . '/../../components/layoutPrincipal/header.main.php' ?>

<main id="main-content" class="create-user-container">\
    <div class="position-relative mb-3">
        <div class="position-absolute end-0 top-0">
            <?php require __DIR__ . '/../../components/alerts.php'; ?>
        </div>
    </div>
    <div class="container mx-auto px-3">
        <div class="header-actions">
            <a href="/tesis/carreras/1" class="btn-back-modern">
                <i class="fas fa-arrow-left"></i>
                Regresar a Carreras
            </a>
        </div>

        <div class="form-card" style="max-width: 800px; margin: 0 auto;">
            <h1 class="form-title">Crear Nueva Carrera</h1>
            
            <form action="/tesis/createCarreras" method="post">
                <div class="form-group-custom">
                    <label class="form-label-custom">
                        <i class="fas fa-hashtag"></i>
                        Codigo de la Carrera
                    </label>
                    <div class="input-wrapper-custom">
                        <i class="fas fa-hashtag input-icon-custom"></i>
                        <input type="text" class="form-control-custom" name="codigo" id="codigo" placeholder="Ingresa el Codigo de la carrera" required>
                    </div>
                    <small class="form-text-custom">
                        <i class="fas fa-info-circle"></i>
                        Ejemplo: 02
                    </small>
                </div>

                <div class="form-group-custom">
                    <label class="form-label-custom">
                        <i class="fas fa-graduation-cap"></i>
                        Nombre de la Carrera
                    </label>
                    <div class="input-wrapper-custom">
                        <i class="fas fa-graduation-cap input-icon-custom"></i>
                        <input type="text" class="form-control-custom" name="nombre" id="nombre" placeholder="Ingresa el nombre completo" required>
                    </div>
                    <small class="form-text-custom">
                        <i class="fas fa-info-circle"></i>
                        Ejemplo: Técnico en Ingeniería de Software
                    </small>
                </div>

                <div class="radio-section-custom">
                    <div class="radio-title">
                        <i class="fas fa-chalkboard-teacher"></i>
                        Modalidad de la Carrera
                    </div>
                    <div>
                        <div class="form-check-custom">
                            <input class="form-check-input" type="radio" name="radio" id="presencial" value="Presencial" required>
                            <label class="form-check-label" for="presencial">
                                Presencial
                            </label>
                        </div>
                        <div class="form-check-custom">
                            <input class="form-check-input" type="radio" name="radio" id="semiPresencial" value="Semi Presencial">
                            <label class="form-check-label" for="semiPresencial">
                                Semi-Presencial
                            </label>
                        </div>
                        <div class="form-check-custom">
                            <input class="form-check-input" type="radio" name="radio" id="noPresencial" value="No Presencial">
                            <label class="form-check-label" for="noPresencial">
                                No Presencial
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group-custom">
                    <label class="form-label-custom">
                        <i class="fas fa-university"></i>
                        Facultad a la que Pertenece
                    </label>
                    <div class="input-wrapper-custom">
                        <i class="fas fa-university input-icon-custom"></i>
                        <select name="opcion" class="form-control-custom" required style="cursor: pointer;">
                            <option value="" selected disabled>Selecciona una facultad</option>
                            <?php foreach($this->d['facultades'] as $key => $value) :?>
                                <option value="<?=$value['facultad_id']?>"><?=$value['nombre_facultad']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn-submit-custom">
                        <i class="fas fa-plus-circle"></i>
                        Crear Carrera
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../../components/layoutPrincipal/footer.main.php' ?>