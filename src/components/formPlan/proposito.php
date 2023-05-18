<form action="" method="post" class="position-relative form-container" id="formProposito">
    <h2 class="text-utec text-center header-font-custom">Propósito</h2>
    <div class="w-75 mx-auto mb-3">
        <input type="hidden" name="opcionProposito[]" value="<?= $this->d['proposito'] == NULL ? 0 : $this->d['proposito']->getId()?>">
        <label for="" class="text-utec font-custom">Escribir el proposito de la carrera:</label>
        <textarea class="form-control" name="opcionProposito[]" id="txtProposito" rows="6"><?= $this->d['proposito'] == NULL ? '' : $this->d['proposito']->getDescripcion()?></textarea>
        <p class="font-custom m-1 ms-0">
            (Los estilos requeridos se aplican al documento de word.)
        </p>
    </div>
    <div class="w-75 mx-auto m-2">
        <button type="button" class="btn btn-outline-utec nav_link p-0 px-2" data-bs-target="formGeneralidades">
            <span class="icon profile-icon">
                <i class="fas fa-angle-double-left"></i>
            </span>
        </button>
        <button type="button" class="btn btn-outline-utec nav_link p-0 px-2" data-bs-target="formComGeneral">
            <span class="icon profile-icon">
                <i class="fas fa-angle-double-right"></i>
            </span>
        </button>
    </div>
</form>