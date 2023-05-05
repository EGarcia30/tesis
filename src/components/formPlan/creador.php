<form action="" method="post" class="position-relative form-container" id="formCreador">
    <h2 class="text-utec text-center header-font-custom">Especialistas/Creadores</h2>
    <div class="w-75 mx-auto mt-2 mb-3">
        <h3 class="header-font-custom text-utec mt-2">Asignados:</h3>
        <?php foreach($this->d['creador'] as $key => $value) :?>
            <p class="font-custom m-0"><?= $value['Creador']?></p>
        <?php endforeach;?>
    </div>
    <div class="w-75 mx-auto mb-3">
        <label for="" class="form-label">Asignar Especialistas:</label>
        <div class="d-flex flex-wrap">
            <div id="selectsCreador" class="d-block w-100 mb-2">
                <select class="form-select form-select-lg" name="opcionCreador[]" id="opcionCreador">
                    <option>seleccionar</option>
                    <?php foreach($this->d['creadores'] as $key => $value) :?>
                        <option value="<?= $value['creador_id']?>"><?= $value['nombre_creador']?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="button" class="btn btn-outline-primary p-0 px-2" onclick="agregarCreador()" >
                <span class="icon profile-icon">
                    <i class="fas fa-plus"></i>
                </span>
            </button>
        </div>
    </div>
    <div class="w-75 mx-auto mb-2">
        <small class="font-custom">No existe el especialista/creador que quieres elegir? 
            <!-- Button trigger modal -->
            <a href="/tesis/creadores/1" class="font-custom">Crear especialista</a>
        </small>
        <div class="mt-3">
            <button type="button" class="btn btn-outline-utec nav_link p-0 px-2" data-bs-target="formFundamentacion">
                <span class="icon profile-icon">
                    <i class="fas fa-angle-double-left"></i>
                </span>
            </button>
            <button type="button" class="btn btn-outline-utec nav_link p-0 px-2" data-bs-target="formGeneralidades">
                <span class="icon profile-icon">
                    <i class="fas fa-angle-double-right"></i>
                </span>
            </button>
        </div>
    </div>
</form>