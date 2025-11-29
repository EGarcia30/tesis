<?php require_once __DIR__ . '/../../components/layoutPlan/header.plan.php' ?>

<main id="main-content" class="admin-container">
    <div class="container mx-auto px-3">
        <!-- Header Actions -->
        <div class="header-card">
            <div class="d-flex flex-column flex-md-row gap-3 align-items-stretch align-items-md-center">
                <a href="/tesis/<?=$_GET['regresar']?>" class="btn-modern btn-back">
                    <i class="fas fa-arrow-left"></i>
                    Regresar
                </a>
                <button type="button" class="btn-modern btn-create" data-bs-toggle="modal" data-bs-target="#especialistaCreador">
                    <i class="fas fa-user-plus"></i>
                    Crear Especialista
                </button>
                
                <!-- Modal Crear -->
                <?php require_once __DIR__ . '/../../components/modalCreador/modalCreate.php' ?>
                
                <form action="/tesis/creadores/1" method="post" class="d-flex flex-grow-1 gap-2">
                    <div class="search-box flex-grow-1">
                        <input type="text" name="buscar" class="form-control search-input" placeholder="Buscar especialista...">
                    </div>
                    <button type="submit" class="btn-search">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- Alerts -->
        <div class="position-relative mb-3">
            <div class="position-absolute end-0 top-0">
                <?php require __DIR__ . '/../../components/alerts.php'; ?>
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
                            <th>Estado</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($this->d['creador'] as $key => $value) :?>
                        <tr>
                            <td><strong><?= $value['creador_id'] ?></strong></td>
                            <td><?= $value['nombre_creador'] ?></td>
                            <td>
                                <span class="status-badge <?= $value['status'] == 1 ? 'status-active' : 'status-inactive' ?>">
                                    <?= $value['status'] == 1 ? 'Activo' : 'Inactivo' ?>
                                </span>
                            </td>
                            <td>
                                <a href="/tesis/creador/editor/<?= $value['creador_id'] ?>" class="action-btn btn-edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                            <td>
                                <button type="button" class="action-btn btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $value['creador_id'] ?>">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal<?= $value['creador_id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
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
                                        <p class="mb-2">¿Estás seguro de eliminar este especialista/creador?</p>
                                        <p class="text-muted mb-0">
                                            <strong><?= $value['nombre_creador']?></strong> será eliminado permanentemente.
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <a href="/tesis/deleteCreador/<?= $value['creador_id'] ?>" class="btn btn-danger">
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