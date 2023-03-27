<?php require_once __DIR__ . '/../../components/header.php' ?>
<main id="main-content" class="w-custom-crud">
    <div class="w-100 position-relative">
        <div class="container mx-auto p-3 d-flex flex-column gap-4">
            <div class="d-flex flex-wrap gap-2">
                <a href="/tesis/plan" class="btn btn-utec">Regresar</a>
            </div>

            <div class="position-absolute end-0 top-0 mt-1">
                <?php require __DIR__ . '/../../components/alerts.php'; ?>
            </div>

            <div class="card card-height">
                <div class="d-flex flex-column overflow-scroll">
                    <h1 class="text-utec text-center header-font-custom mt-4">Plan de estudios</h1>
                    <hr class="w-75 mx-auto"/>
                    <form action="/tesis/update/<?= $this->d['studyPlan']->getId() ?>" method="post" class="position-relative">
                        <h2 class="text-utec text-center header-font-custom">Portada</h2>
                        <div class="w-75 mx-auto mb-3">
                            <label for="" class="text-utec font-custom">Ingresar Titulo:</label>
                            <input type="text" name="titulo" class="form-control" value="<?=$this->d['studyPlan']->getTitle()?>">
                        </div>
                        <div class="w-75 mx-auto mb-3">
                            <label for="contenido" class="form-label text-utec font-custom">Ingresar Contenido:</label>
                            <textarea class="form-control" name="contenido" id="contenido" cols="30" rows="10"><?= $this->d['studyPlan']->getContent()?></textarea>
                        </div>
                        <div class="w-75 mx-auto m-2">
                            <input type="submit" class="btn btn-utec" value="Modificar avance">
                        </div>
                        
                    </form>
                </div>
            </div>

        </div>
    </div>
</main>
<?php require_once __DIR__ . '/../../components/footer.php' ?>