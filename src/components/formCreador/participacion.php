<form action="/tesis/creador/participacion/<?=$this->d['creador']->getId()?>" method="post" class="position-relative form-container" id="formParticipacion">
    <h2 class="text-utec text-center header-font-custom">Nivel de participación</h2>
    <div class="w-75 mx-auto mb-3">
        <h3 class="header-font-custom text-utec mt-2">Participacion del Creador:</h3>
        <?php foreach($this->d['participaciones'] as $key => $value) :?>
            <p class="font-custom m-0"><?= $value['Participacion']?></p>
        <?php endforeach;?>
    </div>
    <div class="w-75 mx-auto mb-3">
        <label for="" class="text-utec font-custom">Nivel de participación:</label>
        <div class="d-flex flex-wrap">
            <div id="selectsPar" class="d-block w-100 mb-2">
                <select class="form-select form-select-lg" name="opcionParticipacion[]" id="opcionParticipacion">
                    <option>seleccionar</option>
                    <?php foreach($this->d['participacion'] as $key => $value) :?>
                        <option value="<?= $value['participacion_id']?>"><?= $value['descripcion']?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success p-0 px-2 me-2">
                <span class="icon profile-icon">
                    <i class="fas fa-save"></i>
                </span>
            </button>
            <button type="button" class="btn btn-outline-primary p-0 px-2" onclick="agregarParticipacion()" >
                <span class="icon profile-icon">
                    <i class="fas fa-plus"></i>
                </span>
            </button>
        </div>
    </div>
    <div class="w-75 mx-auto mb-2">
        <small>¿No existe el nivel de participación adecuado? 
            <button type="button" class="btn btn-outline-primary nav_link p-1" data-bs-target="formCreateParticipacion">Crear nivel de participación</button>
        </small>
    </div>
    <div class="w-75 mx-auto m-2">
    <button type="button" class="btn btn-outline-utec nav_link p-0 px-2" data-bs-target="formExperiencia">
            <span class="icon profile-icon">
                <i class="fas fa-angle-double-left"></i>
            </span>
        </button>
    </div>
</form>