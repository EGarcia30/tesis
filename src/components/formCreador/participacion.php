<div class="position-relative form-container" id="formParticipacion">
    <h2 class="text-utec text-center header-font-custom">Nivel de participación</h2>
    <div class="d-flex flex-wrap-reverse justify-content-around w-75 mx-auto mt-3 mt-sm-5">
        <div class="w-50">
            <div class="mb-3">
                <label for="" class="text-utec font-custom">Nivel de participación:</label>
                <form action="/tesis/creador/participacion/<?=$this->d['creador']->getId()?>" method="post">
                    <div class="d-flex flex-wrap">
                        <div id="selectsPar" class="mb-2">
                            <select class="form-select form-select-lg" name="opcionParticipacion[]" id="opcionParticipacion">
                                <option>seleccionar</option>
                                <?php foreach($this->d['participacion'] as $key => $value) :?>
                                    <option value="<?= $value['participacion_id']?>"><?= $value['descripcion']?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success p-0 px-2 me-2" >
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
                </form>
            </div>
            <div class="mb-2">
                <small>¿No existe el nivel de participación adecuado? 
                    <button type="button" class="btn btn-outline-primary nav_link p-1" data-bs-target="formCreateParticipacion">Crear nivel de participación</button>
                </small>
            </div>
            <div class="mb-2">
            <button type="button" class="btn btn-outline-utec nav_link p-0 px-2" data-bs-target="formExperiencia">
                    <span class="icon profile-icon">
                        <i class="fas fa-angle-double-left"></i>
                    </span>
                </button>
            </div>
        </div>
        <div class="mb-3 mb-sm-0">
            <h3 class="header-font-custom text-utec mt-2">Asignados:</h3>
            <table class="table table-bordered">
                <tbody class="align-middle">
                    <?php foreach($this->d['participaciones'] as $key => $value) :?>
                        <tr>
                            <td class="font-custom m-0"><?= $value['Participacion']?></td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger p-0 px-2" data-bs-toggle="modal" data-bs-target="#deleteParticipacionCreador<?= $value['participacion_id']?>">
                                    <span class="icon profile-icon">
                                        <i class="fas fa-trash-alt"></i>
                                    </span>
                                </button>
                                <?php require __DIR__ . '/../../components/modalCreador/modalDeleteParticipacionCreador.php' ?>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>