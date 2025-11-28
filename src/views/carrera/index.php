<?php require_once __DIR__ . '/../../components/layoutPrincipal/header.main.php' ?>

<main id="main-content" class="admin-container">
    <div class="container mx-auto px-3">
        <!-- Header Actions -->
        <div class="header-card">
            <div class="d-flex flex-column flex-md-row gap-3 align-items-stretch align-items-md-center">
                <a href="/tesis/<?= $_GET['regresar']?>" class="btn-modern btn-back">
                    <i class="fas fa-arrow-left"></i>
                    Regresar
                </a>
                <a href="/tesis/createCarreras" class="btn-modern btn-create <?= $this->d['user']->getRol() == "Usuario" ? 'disabled' : ''?>">
                    <i class="fas fa-plus-circle"></i>
                    Crear Carrera
                </a>
                <form onsubmit="event.preventDefault(); buscarCarreras();" class="d-flex flex-grow-1 gap-2">
                    <div class="search-box flex-grow-1">
                        <input type="text" id="inputBusqueda" class="form-control search-input" placeholder="Buscar carrera..." value="<?= isset($_GET['busqueda']) ? $_GET['busqueda'] : '' ?>">
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
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Modalidad</th>
                            <th>Facultad</th>
                            <th>Estado</th>
                            <th>Planes</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($this->d['carreras'] as $key => $value) :?>
                        <tr>
                            <td><strong><?= $value['codigo_carrera'] ?></strong></td>
                            <td><?= $value['nombre_carrera'] ?></td>
                            <td><?= $value['modalidad_carrera'] ?></td>
                            <td><?= $value['acronimo_facultad'] ?></td>
                            <td>
                                <span class="status-badge <?= $value['status'] == 1 ? 'status-active' : 'status-inactive' ?>">
                                    <?= $value['status'] == 1 ? 'Activo' : 'Inactivo' ?>
                                </span>
                            </td>
                            <td>
                                <a href="/tesis/<?= $value['nombre_carrera'] = str_replace(' ','-',$value['nombre_carrera'])?>/planes/1" class="action-btn" style="background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);">
                                    <i class="fas fa-eye text-light"></i>
                                </a>
                            </td>
                            <td>
                                <a href="/tesis/updateCarrera/<?= $value['carrera_id'] ?>" class="action-btn btn-edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                            <td>
                                <button type="button" class="action-btn btn-delete <?= $this->d['user']->getRol() == "Usuario" ? 'disabled': ''?>" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $value['carrera_id'] ?>">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal<?= $value['carrera_id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
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
                                        <p class="mb-2">¿Estás seguro de eliminar esta carrera?</p>
                                        <p class="text-muted mb-0">
                                            <strong><?= $value['nombre_carrera']?></strong> será eliminada permanentemente.
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <a href="/tesis/deleteCarrera/<?= $value['carrera_id'] ?>" class="btn btn-danger">
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
    function buscarCarreras() {
        const busqueda = encodeURIComponent(document.getElementById('inputBusqueda').value.trim());
        if(busqueda === '') {
            // Opcional: mostrar mensaje o no buscar vacío
            window.location.href = '/tesis/carreras/1'; 
            return;
        }
        // Construir URL con busqueda y pagina 1
        window.location.href = `/tesis/searchCarreras/${busqueda}/1`;
    }
</script>