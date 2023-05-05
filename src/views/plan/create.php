<?php require_once __DIR__ . '/../../components/layoutEditorPlan/header.php' ?>
<main id="main-content" class="w-custom-crud">
    <div class="w-100 position-relative">
        <div class="container mx-auto p-3 d-flex flex-column gap-4">
            <div class="d-flex flex-wrap gap-2">
                <a href="/tesis/planes/1" class="btn btn-utec" onclick="emptyInformation()">Regresar</a>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success p-0 px-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <span class="icon profile-icon">
                        <i class="fas fa-save"></i>
                    </span>
                </button>
                <a href="/tesis/word/<?= $this->d['plan']->getId()?>" class="btn btn-utec p-0 px-2">
                    <span class="icon profile-icon">
                        <img src="<?= URL_PATH ?>/img/word.png" class="img-fluid img-word" alt="">
                    </span>
                </a>
                <!-- modal guardar avance -->
                <?php require __DIR__ . '/../../components/modalPlan/modalSavePlan.php'; ?>
            </div>

            <div class="position-absolute end-0 top-0 mt-1">
                <?php require __DIR__ . '/../../components/alerts.php'; ?>
            </div>

            <div class="card card-height">
                <div class="d-flex flex-column overflow-y-scroll">
                    <h1 class="text-utec text-center header-font-custom mt-4">Plan de estudio</h1>
                    <h2 class="text-utec text-center header-font-custom mt-4"><?= $this->d['plan']->getNameCar()?></h2>
                    <hr class="w-75 mx-auto"/>
                    <?php require_once __DIR__ . '/../../components/formPlan/portada.php' ?>
                    <?php require_once __DIR__ . '/../../components/formPlan/fundamentacion.php' ?>
                    <?php require_once __DIR__ . '/../../components/formPlan/creador.php' ?>
                    <?php require_once __DIR__ . '/../../components/formPlan/generalidades.php' ?>
                    <?php require_once __DIR__ . '/../../components/formPlan/proposito.php' ?>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require_once __DIR__ . '/../../components/layoutEditorPlan/footer.php' ?>