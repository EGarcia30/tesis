<?php require_once __DIR__ . '/../../components/layoutPrincipal/header.main.php' ?>

<main id="main-content" class="admin-container">
    <div class="container mx-auto px-3">
        <!-- Header Actions -->
        <div class="header-card">
            <div class="d-flex flex-column flex-md-row gap-3 align-items-stretch align-items-md-center">
                <a href="/tesis/<?=isset($_GET['regresar']) ? $_GET['regresar'] : 'users' ?>/1" class="btn-modern btn-back">
                    <i class="fas fa-arrow-left"></i>
                    Regresar
                </a>
                <a href="/tesis/createUsers" class="btn-modern btn-create <?= $this->d['user']->getRol() == "Administrador" ? 'disabled' : ''?>">
                    <i class="fas fa-user-plus"></i>
                    Crear Usuario
                </a>
                <form onsubmit="event.preventDefault(); buscarUsuario();" class="d-flex flex-grow-1 gap-2">
                    <div class="search-box flex-grow-1">
                        <input type="text" id="inputBusqueda" class="form-control search-input" placeholder="Buscar usuario..." value="<?= isset($_GET['busqueda']) ? $_GET['busqueda'] : '' ?>">
                    </div>
                    <button type="submit" class="btn-search">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- Table Card -->
        <div class="table-card">
            <div class="table-responsive">
                <table class="table modern-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Usuario</th>
                            <th>Rol</th>
                            <th>Estado</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($this->d['users'] as $key => $value) :?>
                        <tr>
                            <td><strong><?= $value['usuario_id'] ?></strong></td>
                            <td><?= $value['nombre_usuario'] ?></td>
                            <td><?= $value['usuario'] ?></td>
                            <td><?= $value['rol_usuario'] ?></td>
                            <td>
                                <span class="status-badge <?= $value['status'] == 1 ? 'status-active' : 'status-inactive' ?>">
                                    <?= $value['status'] == 1 ? 'Activo' : 'Inactivo' ?>
                                </span>
                            </td>
                            <td>
                                <a href="/tesis/updateUsers/<?= $value['usuario_id'] ?>" class="action-btn btn-edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                            <td>
                                <button type="button" class="action-btn btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $value['usuario_id'] ?>">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal<?= $value['usuario_id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            <i class="fas fa-exclamation-triangle me-2"></i>
                                            Confirmar Eliminación
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="mb-2">¿Estás seguro de eliminar este usuario?</p>
                                        <p class="text-muted mb-0">
                                            <strong><?= $value['nombre_usuario']?></strong> será eliminado permanentemente.
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <a href="/tesis/deleteUser/<?= $value['usuario_id'] ?>" class="btn btn-danger">
                                            <i class="fas fa-trash me-1"></i>
                                            Eliminar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            <?php require_once __DIR__ . '/../../components/pagination.php'?>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../../components/layoutPrincipal/footer.main.php' ?>

<!-- Script para manejar la búsqueda de usuarios -->
<script>
    function buscarUsuario() {
        const busqueda = encodeURIComponent(document.getElementById('inputBusqueda').value.trim());
        if(busqueda === '') {
            // Opcional: mostrar mensaje o no buscar vacío
            window.location.href = '/tesis/users/1'; 
            return;
        }
        // Construir URL con busqueda y pagina 1
        window.location.href = `/tesis/searchUsers/${busqueda}/1`;
    }
</script>