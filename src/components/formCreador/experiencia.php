<div class="position-relative form-container" id="formExperiencia">
    <h2 class="text-utec text-center header-font-custom">Experiencia Profesional</h2>
    <div class="d-flex flex-wrap-reverse justify-content-around w-75 mx-auto mt-3 mt-sm-5">
        <div class="w-50">
            <div class="mb-2">
                <label for="" class="text-utec font-custom">Experiencia Profesional:</label>
                <form action="/tesis/creador/experiencia/<?=$this->d['creador']->getId()?>" method="post">
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
                        <button type="button" class="btn btn-outline-primary p-0 px-2 rounded-5 me-0 me-sm-2" onclick="agregarExperiencia()" >
                            <span class="icon profile-icon">
                                <i class="fas fa-plus"></i>
                            </span>
                        </button>
                        <button type="button" class="btn btn-outline-danger p-0 px-2 rounded-5" onclick="eliminarExperiencia()" >
                            <span class="icon profile-icon">
                                <i class="fas fa-minus"></i>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
            <div class="mb-2">
                <button type="button" class="btn btn-outline-utec nav_link p-0 px-2" data-bs-target="formGrado">
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
        </div>
        <div class="mb-3 mb-sm-0">
            <h3 class="header-font-custom text-utec mt-2">Asignados:</h3>
            <table class="table table-bordered">
                <tbody class="align-middle">
                    <?php foreach($this->d['experiencia'] as $key => $value) :?>
                        <tr>
                            <td class="font-custom m-0"><?= $value['Experiencia']?></td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-success p-0 px-2" data-bs-toggle="modal" data-bs-target="#updateExperiencia<?= $value['experiencia_id']?>">
                                    <span class="icon profile-icon">
                                        <i class="fas fa-edit"></i>
                                    </span>
                                </button>
                                <?php require __DIR__ . '/../../components/modalCreador/modalUpdateExperiencia.php' ?>
                            </td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger p-0 px-2" data-bs-toggle="modal" data-bs-target="#deleteExperiencia<?= $value['experiencia_id']?>">
                                    <span class="icon profile-icon">
                                        <i class="fas fa-trash-alt"></i>
                                    </span>
                                </button>
                                <?php require __DIR__ . '/../../components/modalCreador/modalDeleteExperiencia.php' ?>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>