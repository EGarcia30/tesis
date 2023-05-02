<form action="" method="post" class="position-relative" id="formInicio">
    <h2 class="text-utec text-center header-font-custom">Portada</h2>
    <input type="hidden" name="id_plan" id="id_plan" value="<?=$this->d['plan']->getId()?>">
    <div class="w-75 mx-auto mb-3">
        <label for="" class="text-utec font-custom">Vigencia Inicio:</label>
        <input type="text" name="vigenciaInicio" id="vigenciaInicio" class="form-control" aria-describedby="helpId" value="<?= $this->d['plan']->getStartValidity() == "" ? "" : $this->d['plan']->getStartValidity()?>">
        <small id="helpId" class="form-text text-muted">Ejemplo: Ciclo 01-2023</small>
    </div>
    <div class="w-75 mx-auto mb-3">
        <label for="contenido" class="form-label text-utec font-custom">Vigencia Final:</label>
        <input type="text" name="vigenciaFinal" id="vigenciaFinal" class="form-control" aria-describedby="helpId" value="<?= $this->d['plan']->getEndValidity()?>">
        <small id="helpId" class="form-text text-muted">Ejemplo: Ciclo 02-2027</small>
    </div>
    <div class="w-75 mx-auto mb-2">
        <label for="" class="text-utec font-custom">Fecha presentación mined:</label>
        <input type="text"
        class="form-control" name="fechaPresentacion" id="fechaPresentacion" aria-describedby="helpId" value="<?= $this->d['plan']->getReviewDate()?>" >
        <small id="helpId" class="form-text text-muted">Mes y año ejemplo: Marzo 2023</small>
    </div>
    <div class="w-75 mx-auto mb-2">
        <small>(Se recomienda guardar el avance antes de seguir a otra seccion)</small>
    </div>
    <div class="w-75 mx-auto m-2">
        <button type="button" class="btn btn-outline-utec nav_link p-0 px-2" data-bs-target="formFundamentacion">
            <span class="icon profile-icon">
                <i class="fas fa-angle-double-right"></i>
            </span>
        </button>
    </div>
</form>