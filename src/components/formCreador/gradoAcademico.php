<form action="/tesis/creador/grado/<?=$this->d['creador']->getId()?>" method="post" class="position-relative" id="formInicio">
    <h2 class="text-utec text-center header-font-custom">Grado Academico</h2>

    <div class="w-75 mx-auto mb-3">
        <h3 class="header-font-custom text-utec mt-2">Grados Academicos del Creador:</h3>
        <?php foreach($this->d['grados'] as $key => $value) :?>
            <p class="font-custom m-0"><?= $value['Grados_Academicos']?></p>
        <?php endforeach;?>
    </div>
    <div class="w-75 mx-auto mb-3">
        <label for="" class="text-utec font-custom">Grado Academico:</label>
        <div class="d-flex flex-wrap">
            <div id="selects" class="d-block w-100 mb-2">
                <select class="form-select form-select-lg" name="opcionGrado[]" id="opcionGrado">
                    <option>seleccionar</option>
                    <?php foreach($this->d['grado'] as $key => $value) :?>
                        <option value="<?= $value['grado_id']?>"><?= $value['nombre_grado']?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success p-0 px-2 me-2">
                <span class="icon profile-icon">
                    <i class="fas fa-save"></i>
                </span>
            </button>
            <button type="button" class="btn btn-outline-primary p-0 px-2" onclick="agregarSelect()">
                <span class="icon profile-icon">
                    <i class="fas fa-plus"></i>
                </span>
            </button>
        </div>
    </div>
    <div class="w-75 mx-auto mb-2">
        <small>¿No existe el grado Academico adecuado? <button type="button" class="btn btn-outline-primary nav_link p-1" data-bs-target="formCreateGrado">Crear Grado Academico</button></small>
    </div>
    <div class="w-75 mx-auto m-2">
        <button type="button" class="btn btn-outline-utec nav_link p-0 px-2" data-bs-target="formExperiencia">
            <span class="icon profile-icon">
                <i class="fas fa-angle-double-right"></i>
            </span>
        </button>
    </div>
</form>