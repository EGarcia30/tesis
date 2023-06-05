<div class="position-relative form-container" id="formVerMaterias">
    <div class="mb-3 mb-sm-0 p-5">
        <h3 class="header-font-custom text-utec mt-2">Asignados:</h3>
        <table class="table table-bordered">
            <tbody class="align-middle text-center">
                <?php foreach($this->d['materias'] as $key => $value) :?>
                    <tr>
                        <td class="font-custom m-0"><?= $value['nombre_asignatura']?></td>
                        <td class="font-custom m-0"><?= $value['codigo']?></td>
                        <td>
                            <!-- Button trigger modal -->
                            <a href="/tesis/plan/updateMateria/<?=$this->d['plan']->getId()?>/<?=$value['materia_id']?>" type="button" class="btn btn-success p-0 px-2">
                                <span class="icon profile-icon">
                                    <i class="fas fa-edit"></i>
                                </span>
                            </a>
                        </td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger p-0 px-2" data-bs-toggle="modal" data-bs-target="#deleteMateria<?= $value['materia_id']?>">
                                <span class="icon profile-icon">
                                    <i class="fas fa-trash-alt"></i>
                                </span>
                            </button>
                        </td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>