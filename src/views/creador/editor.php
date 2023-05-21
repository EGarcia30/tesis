<?php require_once __DIR__ . '/../../components/layoutEditorCreador/header.php' ?>
<main id="main-content" class="w-custom-crud"> 
    <div class="w-100 position-relative">
        <div class="container mx-auto p-3 d-flex flex-column gap-4">
            <div class="d-flex flex-wrap gap-2">
                <a href="/tesis/creadores/1" class="btn btn-utec">Regresar</a>
            </div>

            <div class="position-absolute end-0 top-0 mt-1">
                <?php require __DIR__ . '/../../components/alerts.php'; ?>
            </div>

            <div class="card card-height">
                <div class="d-flex flex-column overflow-y-scroll">
                    <h1 class="text-utec text-center header-font-custom mt-4">Especialista/Creador</h1>
                    <h2 class="text-utec text-center header-font-custom mt-4"><?= $this->d['creador']->getName()?></h2>
                    <hr class="w-75 mx-auto"/>
                    <?php require_once __DIR__ . '/../../components/formCreador/nombre.php' ?>
                    <?php require_once __DIR__ . '/../../components/formCreador/gradoAcademico.php' ?>
                    <?php require_once __DIR__ . '/../../components/formCreador/createGradoAcademico.php' ?>
                    <?php require_once __DIR__ . '/../../components/formCreador/experiencia.php' ?>
                    <?php require_once __DIR__ . '/../../components/formCreador/participacion.php' ?>
                    <?php require_once __DIR__ . '/../../components/formCreador/createParticipacion.php' ?>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require_once __DIR__ . '/../../components/layoutEditorCreador/footer.php' ?>
