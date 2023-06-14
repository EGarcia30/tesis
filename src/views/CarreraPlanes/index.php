<?php require_once __DIR__ . '/../../components/layoutPlan/header.plan.php' ?>
<main id="main-content" class="w-custom">
    <div class="w-100 position-relative">
        <div class="d-flex flex-column gap-4 container mx-auto p-3">
            <div class="d-flex flex-wrap gap-2 text-center">
                <a href="/tesis/<?=$_GET['regresar']?>" class="btn btn-utec">Regresar</a>
            </div>
            <!-- alerta -->
            <div class="position-absolute end-0 top-0 mt-1">
                <?php require __DIR__ . '/../../components/alerts.php'; ?>
            </div>
            <div class="table-responsive text-center rounded-2">
                <table class="table table-dark table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Titulo</th>
                            <th scope="col">Vigencia</th>
                            <th scope="col">Status</th>
                            <th scope="col">Descargar</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider table-light align-middle">
                    <?php foreach($this->d['studyPlan'] as $key => $value) :?>
                        <tr >
                            <td scope="row"><?= $value['plan_estudio_id'] ?></td>
                            <td><?= $value['nombre_carrera'] ?></td>
                            <td><?= $value['vigencia_inicio'].' - '.$value['vigencia_final'] ?></td>
                            <td><?= $value['status'] == 1 ? 'Activo' : 'Inactivo' ?></td>
                            <td><a href="/tesis/word/<?= $value['plan_estudio_id'] ?>" class="btn btn-utec p-0 px-2 <?= $value['vigencia_inicio'] == '' || $value['vigencia_final'] == '' ? 'disabled' : '' ?>">
                                    <span class="icon profile-icon">
                                        <img src="<?= URL_PATH ?>/img/word.png" class="img-fluid img-word" alt="">
                                    </span>
                                </a>
                            </td>
                            <td>
                                <a href="/tesis/plan/editor/<?= $value['plan_estudio_id'] ?>" class="btn btn-success p-0 px-2 <?= $this->d['user']->getRol() == "Usuario" ? 'disabled': ''?>">
                                    <span class="icon profile-icon">
                                        <i class="fas fa-edit"></i>
                                    </span>
                                </a>
                            </td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger p-0 px-2 <?= $this->d['user']->getRol() == "Usuario" || $this->d['user']->getRol() == "Administrador" ? 'disabled': ''?>" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?= $value['plan_estudio_id'] ?>">
                                    <span class="icon profile-icon">
                                        <i class="fas fa-trash-alt"></i>
                                    </span>
                                </button>
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop<?= $value['plan_estudio_id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content bg-dark text-white">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">¿Quieres eliminar este Plan?</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="text-start text-break"><b><?= $value['nombre_carrera']?></b>, Se borrará al apretar el boton Eliminar.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <a href="/tesis/deletePlan/<?= $value['plan_estudio_id'] ?>" class="btn btn-danger <?= $this->d['user']->getRol() == "Usuario" || $this->d['user']->getRol() == "Administrador" ? 'disabled': ''?>">Eliminar</a>
                                </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- paginacion -->
            <?php require_once __DIR__ . '/../../components/pagination.php'?>
        </div>
    </div>
</main>
<?php require_once __DIR__ . '/../../components/layoutPrincipal/footer.main.php' ?>