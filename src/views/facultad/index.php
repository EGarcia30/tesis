<?php require_once __DIR__ . '/../../components/layoutPrincipal/header.main.php' ?>
<main id="main-content" class="w-custom">
    <div class="w-100 position-relative">
        <div class="d-flex flex-column gap-4 container mx-auto p-3">
            <div class="d-flex flex-wrap gap-2 text-center">
                <a href="/tesis/home" class="btn btn-utec">Regresar</a>
                <a href="/tesis/createFacultad" class="btn btn-primary">Crear nueva Facultad</a>
                <form action="/tesis/facultades" method="post" class="w-75 d-flex">
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
                <table class="table table-dark table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Acronimo</th>
                            <th scope="col">Status</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider table-light align-middle">
                    <?php foreach($this->d['facultades'] as $key => $value) :?>
                        <tr >
                            <td scope="row"><?= $value['facultad_id'] ?></td>
                            <td><?= $value['nombre_facultad'] ?></td>
                            <td><?= $value['acronimo_facultad'] ?></td>
                            <td><?= $value['status'] == 1 ? 'Activo' : 'Inactivo' ?></td>
                            <td>
                                <a href="/tesis/updateFacultad/<?= $value['facultad_id'] ?>" class="btn btn-success p-0 px-2 <?= $this->d['user']->getRol() == "Usuario" ? 'disabled': ''?>">
                                    <span class="icon profile-icon">
                                        <i class="fas fa-edit"></i>
                                    </span>
                                </a>
                            </td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger p-0 px-2 <?= $this->d['user']->getRol() == "Usuario" || $this->d['user']->getRol() == "Administrador" ? 'disabled': ''?>" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?= $value['facultad_id'] ?>">
                                    <span class="icon profile-icon">
                                        <i class="fas fa-trash-alt"></i>
                                    </span>
                                </button>
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop<?= $value['facultad_id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">¿Quieres eliminar esta facultad?</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="text-start"><?= $value['nombre_facultad']?>, Se borrará al apretar el boton Eliminar.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <a href="/tesis/deleteFacultad/<?= $value['facultad_id'] ?>" class="btn btn-danger">Eliminar</a>
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