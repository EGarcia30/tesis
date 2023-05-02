<form action="/tesis/creador/experiencia/<?=$this->d['creador']->getId()?>" method="post" class="position-relative form-container" id="formExperiencia">
    <h2 class="text-utec text-center header-font-custom">Experiencia Profesional</h2>
    <div class="w-75 mx-auto mb-3">
        <h3 class="header-font-custom text-utec mt-2">Experiencias Profesionales del Creador:</h3>
        <?php foreach($this->d['experiencia'] as $key => $value) :?>
            <p class="font-custom m-0"><?= $value['Experiencia']?></p>
        <?php endforeach;?>
    </div>
    <div class="w-75 mx-auto mb-3">
        <label for="" class="text-utec font-custom">Experiencia Profesional:</label>
        <div class="d-flex flex-wrap">
            <div id="experiencias" class="d-block w-100 mb-2">
                <input type="text" name="experiencia[]" class="form-control" aria-describedby="helpId">
                <small id="helpId" class="form-text text-muted">Ejemplo: Gerente General del Banco Nacional</small>
            </div>
            <button type="submit" class="btn btn-success p-0 px-2 me-2">
                <span class="icon profile-icon">
                    <i class="fas fa-save"></i>
                </span>
            </button>
            <button type="button" class="btn btn-outline-primary p-0 px-2 mt-1" onclick="agregarExperiencias()">
                <span class="icon profile-icon">
                    <i class="fas fa-plus"></i>
                </span>
            </button>
        </div>
    </div>
    <div class="w-75 mx-auto m-2">
        <button type="button" class="btn btn-outline-utec nav_link p-0 px-2" data-bs-target="formInicio">
            <span class="icon profile-icon">
                <i class="fas fa-angle-double-left"></i>
            </span>
        </button>
        <button type="button" class="btn btn-outline-utec nav_link p-0 px-2" data-bs-target="formParticipacion">
            <span class="icon profile-icon">
                <i class="fas fa-angle-double-right"></i>
            </span>
        </button>
    </div>
</form>