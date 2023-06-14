<div class="position-relative form-container" id="formVerMaterias">
    <div class="mb-3 mb-sm-0 p-3 w-75 mx-auto">
        <h3 class="header-font-custom text-utec mt-2">Asignados:</h3>
        <table class="table table-dark table-hover table-bordered text-center">
            <thead>
                <tr>
                    <th scope="col">Ciclo</th>
                    <th scope="col">Materia</th>
                    <th scope="col">Código</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody class="table-group-divider table-light align-middle">
                <?php foreach($this->d['extraordinario'] as $key => $value) :?>
                    <tr>
                    <td class="font-custom m-0"><?= $value['ciclo']?></td>
                        <td class="font-custom m-0"><?= $value['nombre_asignatura']?></td>
                        <td class="font-custom m-0"><?= $value['codigo']?></td>
                        <td>
                            <!-- Button trigger modal -->
                            <a href="/tesis/plan/updateMateria/<?=$this->d['plan']->getId()?>/<?=$value['extra_id']?>" type="button" class="btn btn-success p-0 px-2">
                                <span class="icon profile-icon">
                                    <i class="fas fa-edit"></i>
                                </span>
                            </a>
                        </td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger p-0 px-2" data-bs-toggle="modal" data-bs-target="#deleteCicloExtra<?= $value['extra_id']?>">
                                <span class="icon profile-icon">
                                    <i class="fas fa-trash-alt"></i>
                                </span>
                            </button>
                            <?php require __DIR__ . '/../../components/modalCiclo/modalDeleteCiclo.php' ?>
                        </td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>