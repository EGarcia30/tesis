<?php require_once __DIR__ . '/../../components/layoutPlan/header.plan.php' ?>

<main id="main-content" class="admin-container">
    <!-- Alerts -->
    <div class="position-relative mb-3">
        <div class="position-absolute end-0 top-0">
            <?php require __DIR__ . '/../../components/alerts.php'; ?>
        </div>
    </div>
    <div class="container mx-auto px-3">
        <!-- Header Actions -->
        <div class="header-card">
            <div class="d-flex flex-column flex-md-row gap-3 align-items-stretch align-items-md-center">
                <a href="/tesis/<?=$_GET['regresar']?>" class="btn-modern btn-back">
                    <i class="fas fa-arrow-left"></i>
                    Regresar
                </a>
                <button type="button" class="btn-modern btn-create <?= $this->d['user']->getRol() == "Usuario" || $this->d['user']->getRol() == "Administrador" ? 'disabled': ''?>" data-bs-toggle="modal" data-bs-target="#createPlanModal">
                    <i class="fas fa-plus-circle"></i>
                    Crear Plan de Estudio
                </button>
                
                <!-- Modal Crear -->
                <?php require_once __DIR__ . '/../../components/modalPlan/modalCreatePlan.php' ?>
                
                <form action="/tesis/planes/1" method="post" class="d-flex flex-grow-1 gap-2">
                    <div class="search-box flex-grow-1">
                        <input type="text" name="buscar" class="form-control search-input" placeholder="Buscar plan de estudio...">
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
                            <th>Título</th>
                            <th>Vigencia</th>
                            <th>Estado</th>
                            <th>Ver</th>
                            <th>Descargar</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($this->d['studyPlan'] as $key => $value) :?>
                        <tr>
                            <td><strong><?= $value['plan_estudio_id'] ?></strong></td>
                            <td><?= $value['nombre_carrera'] ?></td>
                            <td><?= $value['vigencia_inicio'].' - '.$value['vigencia_final'] ?></td>
                            <td>
                                <span class="status-badge <?= $value['status'] == 1 ? 'status-active' : 'status-inactive' ?>">
                                    <?= $value['status'] == 1 ? 'Activo' : 'Inactivo' ?>
                                </span>
                            </td>
                            <td>
                                <a href="/tesis/<?= $value['nombre_carrera'] = str_replace(' ','-',$value['nombre_carrera'])?>/historial/1" class="action-btn" style="background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);">
                                    <i class="fas fa-eye text-light"></i>
                                </a>
                            </td>
                            <td>
                                <a href="/tesis/word/<?= $value['plan_estudio_id'] ?>" class="action-btn <?= $value['vigencia_inicio'] == '' || $value['vigencia_final'] == '' ? 'disabled' : '' ?>" style="background: linear-gradient(135deg, #6d1d3c 0%, #8a2449 100%);">
                                    <img src="<?= URL_PATH ?>/img/word.png" class="img-fluid img-word" alt="">
                                </a>
                            </td>
                            <td>
                                <a href="/tesis/plan/editor/<?= $value['plan_estudio_id'] ?>" class="action-btn btn-edit <?= $this->d['user']->getRol() == "Usuario" ? 'disabled': ''?>">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                            <td>
                                <button type="button" class="action-btn btn-delete <?= $this->d['user']->getRol() == "Usuario" || $this->d['user']->getRol() == "Administrador" ? 'disabled': ''?>" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $value['plan_estudio_id'] ?>">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal<?= $value['plan_estudio_id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
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
                                        <p class="mb-2">¿Estás seguro de eliminar este plan de estudio?</p>
                                        <p class="text-muted mb-0">
                                            <strong><?= $value['nombre_carrera']?></strong> será eliminado permanentemente.
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <a href="/tesis/deletePlan/<?= $value['plan_estudio_id'] ?>" class="btn btn-danger <?= $this->d['user']->getRol() == "Usuario" || $this->d['user']->getRol() == "Administrador" ? 'disabled': ''?>">
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

<!-- Select2 Initialization -->
<script>
    $(document).ready(function() {

        $('#opcionFacultad').select2({
            theme: 'bootstrap-5',
            width: '100%',
            dropdownParent: $('#createPlanModal'),
        });

    });
</script>

<!-- Onchange Facultad to load Carreras -->
<script>
    $(document).ready(function() {
        $('#opcionFacultad').on('change', function() {
            var facultadId = $(this).val();

            $.ajax({
                url: '/tesis/getCarreras/' + facultadId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    
                    // REMOVER select anterior
                    $('#opcionCarrera').parent().remove();
                     // Encontrar el div contenedor de la facultad
                    const $facultadContainer = $('#opcionFacultad').closest('.mb-5');
                    
                    // Crear el HTML exacto que quieres
                    let htmlCarreras = `
                        <div class="mb-4">
                            <select name="opcionCarrera" id="opcionCarrera" class="form-select" aria-label="Default select example" style="width: 100%;">
                                <option selected>Seleccionar Carrera:</option>
                    `;
                    
                    // Agregar opciones dinámicamente (igual que tu PHP foreach)
                    $.each(data, function(key, carrera) {
                        htmlCarreras += `<option value="${carrera.carrera_id}">${carrera.nombre_carrera}</option>`;
                    });
                    
                    htmlCarreras += `
                            </select>
                        </div>
                    `;
                    
                    // Insertar JUSTO ABAJO del div de facultad
                    $facultadContainer.after(htmlCarreras);
                    
                    // Re-inicializar Select2 en el nuevo select
                    $('#opcionCarrera').select2({
                        theme: 'bootstrap-5',
                        width: '100%',
                        dropdownParent: $('#createPlanModal'),
                    });
                },
                error: function() {
                    console.error('Error al cargar las carreras.');
                }
            });
        });
    });
</script>