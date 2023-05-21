<div class="position-relative form-container" id="formCreateParticipacion">
    <h2 class="text-utec text-center header-font-custom">Crear Nivel de Participación</h2>
    <div class="d-flex flex-wrap-reverse justify-content-around w-75 mx-auto mt-3 mt-sm-5">
        <div>
            <form action="/tesis/participacion/<?= $this->d['creador']->getId()?>" method="post">
                <div>
                    <label for="" class="text-utec font-custom">Nivel de Participación:</label>
                    <input type="text" name="participacion" class="form-control" aria-describedby="helpId">
                    <small id="helpId" class="form-text text-muted">Ejemplo: Desarrollador de logica de materias</small>
                </div>
                <div>
                    <button type="submit" class="btn btn-success">Crear</button>
                    <button type="button" class="btn btn-secondary nav_link" data-bs-target="formParticipacion">regresar</button>
                </div>
            </form>
        </div>
        <div class="mb-3 mb-sm-0">
            <h3 class="header-font-custom text-utec mt-2">Creados:</h3>
            <table class="table table-bordered">
                <tbody class="align-middle">
                    <?php foreach($this->d['participacion'] as $key => $value) :?>
                        <tr>
                            <td class="font-custom m-0"><?= $value['descripcion']?></td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-success p-0 px-2" data-bs-toggle="modal" data-bs-target="#updateParticipacion<?= $value['participacion_id']?>">
                                    <span class="icon profile-icon">
                                        <i class="fas fa-edit"></i>
                                    </span>
                                </button>
                                <?php require __DIR__ . '/../../components/modalCreador/modalUpdateParticipacion.php' ?>
                            </td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger p-0 px-2" data-bs-toggle="modal" data-bs-target="#deleteParticipacion<?= $value['participacion_id']?>">
                                    <span class="icon profile-icon">
                                        <i class="fas fa-trash-alt"></i>
                                    </span>
                                </button>
                                <?php require __DIR__ . '/../../components/modalCreador/modalDeleteParticipacion.php' ?>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>