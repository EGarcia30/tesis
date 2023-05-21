<form action="/tesis/creador/nombre/<?=$this->d['creador']->getId()?>" method="post" class="position-relative" id="formInicio">
    <h2 class="text-utec text-center header-font-custom">Nombre</h2>
    <div class="w-75 mx-auto mb-3">
        <label for="" class="text-utec font-custom">Editar Nombre:</label>
        <div class="d-flex flex-wrap">
            <div class="d-block w-100 mb-2">
                <input type="text" name="nombre" class="form-control" value="<?= $this->d['creador']->getName()?>">
            </div>
            <button type="submit" class="btn btn-success p-0 px-2 me-2">
                <span class="icon profile-icon">
                    <i class="fas fa-save"></i>
                </span>
            </button>
        </div>
    </div>
    <div class="w-75 mx-auto m-2">
        <button type="button" class="btn btn-outline-utec nav_link p-0 px-2" data-bs-target="formGrado">
            <span class="icon profile-icon">
                <i class="fas fa-angle-double-right"></i>
            </span>
        </button>
    </div>
</form>