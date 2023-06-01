<?php require_once __DIR__ . '/../../components/layoutPrincipal/header.main.php' ?>
<main id="main-content" class="w-custom">
    <div class="w-100 position-relative">
        <div class="d-flex flex-column gap-4 container mx-auto p-3">
            <div class="d-flex flex-wrap gap-2 text-center">
                <a href="/tesis/carreras/1" class="btn btn-utec">Regresar</a>
            </div>

            <div class="position-absolute end-0 top-0 mt-1">
                <?php require __DIR__ . '/../../components/alerts.php'; ?>
            </div>

            <div class="card card-height container p-3 bg-white">
                <h1 class="header-font-custom text-utec text-center">Editar Carrera</h1>
                <form action="/tesis/updateCarrera/<?=$this->d['carrera']->getId()?>" method="post" class="p-2 overflow-y-scroll">
                    <div class="mb-3">
                        <label for="id" class="form-label">Id:</label>
                        <input type="number"
                        class="form-control" name="id" id="id" aria-describedby="helpId" value="<?= $this->d['carrera']->getId()?>">
                        <small id="helpId" class="form-text text-muted">Ejemplo: 02</small>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-utec">Nombre:</label>
                        <input type="text"
                        class="form-control" name="nombre" id="nombre" aria-describedby="helpId" value="<?= $this->d['carrera']->getName()?>">
                        <small id="helpId" class="form-text text-muted">Ejemplo: Tecníco en Ingenieria de Software.</small>
                    </div>
                    <div class="mt-5">
                        <label class="d-block text-utec mb-3">Modalidad de la carrera:</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="radio" id="inlineRadio1" value="Presencial" <?=strpos($this->d['carrera']->getModality(), 'Presencial') !== false ? 'checked' : false ?>>
                            <label class="form-check-label" for="inlineRadio1">Presencial</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="radio" id="inlineRadio2" value="Semi Presencial" <?=strpos($this->d['carrera']->getModality(), 'Semi Presencial') !== false ? 'checked' : false ?>>
                            <label class="form-check-label" for="inlineRadio2">Semi Presencial</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="radio" id="inlineRadio3" value="No Presencial" <?=strpos($this->d['carrera']->getModality(), 'No Presencial') !== false ? 'checked' : false ?>>
                            <label class="form-check-label" for="inlineRadio3">No Presencial</label>
                        </div>
                    </div>

                    <div class="mt-4">
                        <select name="opcion" class="form-select">
                            <option>Facultad que te pertenece:</option>
                            <?php foreach($this->d['facultades'] as $key => $value) :?>
                                <option <?= $this->d['carrera']->getFacultadId() == $value['facultad_id'] ? 'selected' : false ?> value="<?=$value['facultad_id']?>"><?=$value['nombre_facultad']?></option>
                            <?php endforeach; ?>
                        </select>                        
                    </div>

                    <div class="mt-5">
                        <input type="submit" class="btn btn-utec" value="Editar Carrera">
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<?php require_once __DIR__ . '/../../components/layoutPrincipal/footer.main.php' ?>