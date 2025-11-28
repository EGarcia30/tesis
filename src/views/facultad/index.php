<?php require_once __DIR__ . '/../../components/layoutPrincipal/header.main.php' ?>
<main id="main-content" class="admin-container">
    <div class="container mx-auto px-3">
        <div class="header-card">
            <div class="d-flex flex-column flex-md-row gap-3 align-items-stretch align-items-md-center">
                <a href="/tesis/home" class="btn-modern btn-back">
                    <i class="fas fa-arrow-left"></i>
                    Regresar
                </a>
                <a href="/tesis/createFacultad" class="btn-modern btn-create <?= $this->d['user']->getRol() == "Usuario" ? 'disabled': ''?>">
                    <i class="fas fa-plus-circle"></i>
                    Crear nueva Facultad
                </a>
                <form onsubmit="event.preventDefault(); buscarFacultad();" class="d-flex flex-grow-1 gap-2">
                    <div class="search-box flex-grow-1">
                        <input type="text" id="inputBusqueda" class="form-control search-input" placeholder="Buscar usuario..." value="<?= isset($_GET['busqueda']) ? $_GET['busqueda'] : '' ?>">
                    </div>
                    <button type="submit" class="btn-search">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
        <div class="table-card">
            <div class="table-responsive">
                <table class="table modern-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Acronimo</th>
                            <th>Estado</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($this->d['facultades'] as $key => $value) :?>
                            <tr>
                                <td><strong><?= $value['facultad_id'] ?></strong></td>
                                <td><?= $value['nombre_facultad'] ?></td>
                                <td><?= $value['acronimo_facultad'] ?></td>
                                <td>
                                    <span class="status-badge <?= $value['status'] == 1 ? 'status-active' : 'status-inactive' ?>">
                                        <?= $value['status'] == 1 ? 'Activo' : 'Inactivo' ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="/tesis/updateFacultad/<?= $value['facultad_id'] ?>" class="action-btn btn-edit <?= $this->d['user']->getRol() == "Usuario" ? 'disabled': ''?>">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    <button type="button" class="action-btn btn-delete <?= $this->d['user']->getRol() == "Usuario" || $this->d['user']->getRol() == "Administrador" ? 'disabled': ''?>" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $value['facultad_id'] ?>">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="deleteModal<?= $value['facultad_id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <a href="/tesis/deleteFacultad/<?= $value['facultad_id'] ?>" class="btn btn-danger">
                                        <i class="fas fa-trash me-1"></i>    
                                        Eliminar</a>
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

<!-- Script para manejar la búsqueda de usuarios -->
<script>
    function buscarFacultad() {
        const busqueda = encodeURIComponent(document.getElementById('inputBusqueda').value.trim());
        if(busqueda === '') {
            // Opcional: mostrar mensaje o no buscar vacío
            window.location.href = '/tesis/facultades/1'; 
            return;
        }
        // Construir URL con busqueda y pagina 1
        window.location.href = `/tesis/searchFacultades/${busqueda}/1`;
    }
</script>