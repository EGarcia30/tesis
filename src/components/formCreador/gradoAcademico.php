<div class="position-relative form-container" id="formGrado">
    <h2 class="text-utec text-center header-font-custom">Grado Academico</h2>
    <div class="d-flex flex-wrap-reverse justify-content-around w-75 mx-auto mt-3 mt-sm-5">
        <div class="w-50">
            <form action="/tesis/creador/grado/<?=$this->d['creador']->getId()?>" method="post"  class="mb-3">
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
                    <button type="button" class="btn btn-outline-primary p-0 px-2 rounded-5 me-0 me-sm-2" onclick="agregarGrado()" >
                        <span class="icon profile-icon">
                            <i class="fas fa-plus"></i>
                        </span>
                    </button>
                    <button type="button" class="btn btn-outline-danger p-0 px-2 rounded-5" onclick="eliminarGrado()" >
                        <span class="icon profile-icon">
                            <i class="fas fa-minus"></i>
                        </span>
                    </button>
                </div>
            </form>
            <div class="mb-2">
                <small>¿No existe el grado Academico adecuado? 
                    <button type="button" class="btn btn-outline-primary nav_link p-1" data-bs-target="formCreateGrado">
                        Crear Grado Academico
                    </button>
                </small>
            </div>
            <div class="mb-2">
                <button type="button" class="btn btn-outline-utec nav_link p-0 px-2" data-bs-target="formInicio">
                    <span class="icon profile-icon">
                        <i class="fas fa-angle-double-left"></i>
                    </span>
                </button>
                <button type="button" class="btn btn-outline-utec nav_link p-0 px-2" data-bs-target="formExperiencia">
                    <span class="icon profile-icon">
                        <i class="fas fa-angle-double-right"></i>
                    </span>
                </button>
            </div>
        </div>
        <div class="mb-3 mb-sm-0">
            <h3 class="header-font-custom text-utec mt-2">Asignados:</h3>
            <table class="table table-bordered">
                <tbody class="align-middle">
                    <?php foreach($this->d['grados'] as $key => $value) :?>
                        <tr>
                            <td class="font-custom m-0"><?= $value['Grados_Academicos']?></td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger p-0 px-2" data-bs-toggle="modal" data-bs-target="#deleteGradoCreador<?= $value['grado_id']?>">
                                    <span class="icon profile-icon">
                                        <i class="fas fa-trash-alt"></i>
                                    </span>
                                </button>
                                <?php require __DIR__ . '/../../components/modalCreador/modalDeleteGradoCreador.php' ?>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>