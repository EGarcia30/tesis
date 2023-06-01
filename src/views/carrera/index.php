<?php require_once __DIR__ . '/../../components/layoutPrincipal/header.main.php' ?>
<main id="main-content" class="w-custom">
    <div class="w-100 position-relative">
        <div class="d-flex flex-column gap-3 container mx-auto p-3">
            <div class="d-flex flex-wrap gap-2 text-center">
                <a href="/tesis/<?= $_GET['regresar']?>" class="btn btn-utec">Regresar</a>
                <a href="/tesis/createCarreras" class="btn btn-primary <?= $this->d['user']->getRol() == "Usuario" ? 'disabled' : ''?>">Crear nueva Carrera</a>
                <form action="/tesis/carreras/1" method="post" class="w-75 d-flex">
                    <input type="text" name="buscar" class="form-control">
                    <div>
                        <button type="submit" class="btn btn-utec ms-0 ms-sm-2">
                            <span class="icon search-icon">
                                <i class="fas fa-search"></i>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
            <div class="table-responsive text-center rounded-2">
                <table class="table table-sm table-dark table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Modalidad</th>
                            <th scope="col">Facultad</th>
                            <th scope="col">Status</th>
                            <th scope="col">Ps. Estudio<br>(Historial)</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider table-light align-middle">
                    <?php foreach($this->d['carreras'] as $key => $value) :?>
                        <tr >
                            <td scope="row"><?= $value['carrera_id'] ?></td>
                            <td><?= $value['nombre_carrera'] ?></td>
                            <td><?= $value['modalidad_carrera'] ?></td>
                            <td><?= $value['acronimo_facultad'] ?></td>
                            <td><?= $value['status'] == 1 ? 'Activo' : 'Inactivo' ?></td>
                            <td>
                                <a href="/tesis/<?= $value['nombre_carrera'] = str_replace(' ','-',$value['nombre_carrera'])?>/planes/1" class="btn btn-primary p-0 px-2">
                                    <span class="icon profile-icon">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </a>
                            </td>
                            <td>
                                <a href="/tesis/updateCarrera/<?= $value['carrera_id'] ?>" class="btn btn-success p-0 px-2">
                                    <span class="icon profile-icon">
                                        <i class="fas fa-edit"></i>
                                    </span>
                                </a>
                            </td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger p-0 px-2 <?= $this->d['user']->getRol() == "Usuario" ? 'disabled': ''?>" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?= $value['carrera_id'] ?>">
                                    <span class="icon profile-icon">
                                        <i class="fas fa-trash-alt"></i>
                                    </span>
                                </button>
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop<?= $value['carrera_id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content bg-dark text-white">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">¿Quieres eliminar esta Carrera?</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="text-start text-break"><b><?= $value['nombre_carrera']?></b>, Se borrará al apretar el boton Eliminar.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <a href="/tesis/deleteCarrera/<?= $value['carrera_id'] ?>" class="btn btn-danger">Eliminar</a>
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