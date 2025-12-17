<div class="form-section" id="formComEspecialidad">
    <h2 class="section-title">Competencias de Especialidad</h2>
    
    <div class="competence-grid">
        <!-- Sección de Agregar -->
        <div class="add-competence-section">
            <form action="" method="post" id="comEspecialidad">
                <input type="hidden" name="id_plan" id="id_plan" value="<?=$this->d['plan']->getId()?>">
                <div>
                    <div class="form-group-custom competence-input-group">
                        <label class="form-label-custom">
                            <i class="fas fa-certificate"></i>
                            Competencia de Especialidad
                        </label>
                        <div class="input-wrapper-custom">
                            <i class="fas fa-certificate input-icon-custom"></i>
                            <textarea 
                                name="competenciaEspecialidad" 
                                class="textarea-modern" 
                                rows="4"
                                placeholder="Describe la competencia específica de la especialidad que el estudiante dominará..."
                                style="padding-left: 3rem;"
                            ></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group-custom">
                        <label class="form-label-custom">
                            <i class="fas fa-calendar"></i>
                            Ciclo de Cumplimiento
                        </label>
                        <div class="input-wrapper-custom cycle-input-wrapper">
                            <i class="fas fa-calendar input-icon-custom"></i>
                            <input 
                                type="number" 
                                name="cicloEspecialidad" 
                                step="1" 
                                min="1"
                                max="10"
                                class="form-control-custom" 
                                placeholder="Ej: 3"
                                oninput="updateCycleBadgeEspecialidad(this)"
                            >
                            <span class="cycle-badge" id="cycleBadgeEspecialidad" style="display: none;"></span>
                        </div>
                        <small class="form-text-custom">
                            <i class="fas fa-info-circle"></i>
                            Ingresa el número del ciclo (Ej: 1, 2, 3...)
                        </small>
                    </div>
                    
                    <div class="roman-note">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>Los números se convertirán automáticamente a romanos (I, II, III...) en el documento Word</span>
                    </div>
                </div>
                
                <div class="btn-action-group mt-4">
                    <button type="submit" class="btn-add-specialist">
                        <i class="fas fa-save"></i>
                        Guardar
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Sección de Lista -->
        <div class="competence-list-section">
            <h3 class="assigned-title">
                <i class="fas fa-list-check"></i>
                Competencias Asignadas
            </h3>
            
            <?php if(empty($this->d['comEspecialidad'])): ?>
                <div class="empty-state">
                    <i class="fas fa-inbox" style="font-size: 3rem; opacity: 0.3; margin-bottom: 1rem;"></i>
                    <p>No hay competencias de especialidad asignadas aún</p>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="competence-table competence-table-especialidad">
                        <tbody>
                            <?php foreach($this->d['comEspecialidad'] as $key => $value) :?>
                                <tr>
                                    <td style="width: 50%;">
                                        <strong><?= $value['descripcion']?></strong>
                                    </td>
                                    <td style="width: 25%; text-align: center;">
                                        <span class="cycle-badge-table">
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            Ciclo <?= $value['ciclo']?>
                                        </span>
                                    </td>
                                    <td style="width: 12.5%; text-align: center;">
                                        <button type="button" class="action-btn btn-delete btn-table-action" data-bs-toggle="modal" data-bs-target="#deleteComEspecialidad<?= $value['especialidad_id']?>" title="Eliminar competencia">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        <?php require __DIR__ . '/../../components/modalPlan/modalDeleteComEspecialidad.php' ?>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Navegación -->
    <div class="navigation-buttons">
        <button type="button" class="btn-prev-section nav_link" data-bs-target="formComBasico">
            <i class="fas fa-arrow-left"></i>
            Anterior
        </button>
        <button type="button" class="btn-next-section nav_link" data-bs-target="formAreas">
            Siguiente
            <i class="fas fa-arrow-right"></i>
        </button>
    </div>
</div>

<script>
// Función para actualizar el badge del ciclo (Especialidad)
function updateCycleBadgeEspecialidad(input) {
    const value = input.value;
    const badge = document.getElementById('cycleBadgeEspecialidad');
    
    if (value && value > 0) {
        badge.textContent = `Ciclo ${value}`;
        badge.style.display = 'block';
    } else {
        badge.style.display = 'none';
    }
}
</script>