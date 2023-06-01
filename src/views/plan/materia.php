<?php require_once __DIR__ .'/../../components/layoutMaterias/header.php'?>
<main id="main-content" class="w-custom-crud">
    <div class="w-100 position-relative">
        <div class="container-fluid mx-auto p-3 d-flex flex-column gap-4">
            <div class="d-flex flex-wrap gap-2">
                <a href="/tesis/plan/editor/<?=$this->d['plan']->getId()?>" class="btn btn-utec">Regresar</a>
                <a href="/tesis/word/<?= $this->d['plan']->getId()?>" class="btn btn-utec p-0 px-2">
                    <span class="icon profile-icon">
                        <img src="<?= URL_PATH ?>/img/word.png" class="img-fluid img-word" alt="">
                    </span>
                </a>
            </div>

            <div class="position-absolute end-0 top-0 mt-1">
                <?php require __DIR__ . '/../../components/alerts.php'; ?>
            </div>

            <div class="card card-height">
                <div class="d-flex flex-column overflow-y-scroll">
                    <h1 class="text-utec text-center header-font-custom mt-4">Plan de estudio</h1>
                    <h2 class="text-utec text-center header-font-custom mt-4"><?= $this->d['plan']->getNameCar()?></h2>
                    <hr class="w-75 mx-auto"/>
                    <?php require_once __DIR__ . '/../../components/formPlan/materias.php' ?>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require_once __DIR__ .'/../../components/layoutMaterias/footer.php' ?>