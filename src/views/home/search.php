<?php require_once __DIR__ . '/../../components/header.main.php' ?>
<main id="main-content" class="w-custom">
    <div class="w-100 position-relative">
        <div class="d-flex flex-column gap-4 container mx-auto p-3">
            <div class="d-flex flex-wrap gap-2 text-center">
                <a href="/tesis/users/1" class="btn btn-utec">Regresar</a>
                <a href="/tesis/createUsers" class="btn btn-primary">Crear nuevo Usuario</a>
                <form action="/tesis/users" method="post" class="w-75 d-flex">
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
            <div class="table-responsive table-height text-center rounded-2">
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Usuario</th>
                            <th scope="col">Rol Usuario</th>
                            <th scope="col">Status</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                    <?php foreach($this->d['users'] as $key => $value) :?>
                        <tr >
                            <td scope="row"><?= $value['usuario_id'] ?></td>
                            <td><?= $value['nombre_usuario'] ?></td>
                            <td><?= $value['usuario'] ?></td>
                            <td><?= $value['rol_usuario'] ?></td>
                            <td><?= $value['status'] ?></td>
                            <td><a href="/tesis/updateUsers/<?= $value['usuario_id'] ?>" class="btn btn-success">Editar</a></td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?= $value['usuario_id'] ?>">
                                Eliminar
                                </button>
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop<?= $value['usuario_id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">¿Quieres eliminar este usuario?</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="text-start"><?= $value['nombre_usuario']?>, Se borrará al apretar el boton Eliminar.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <a href="/tesis/deleteUser/<?= $value['usuario_id'] ?>" class="btn btn-danger">Eliminar</a>
                                </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<?php require_once __DIR__ . '/../../components/footer.main.php' ?>