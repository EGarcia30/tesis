<style>
    .competence-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        margin-top: 2rem;
    }
    
    .add-competence-section {
        background: linear-gradient(135deg, #fafafa 0%, #f5f5f5 100%);
        border-radius: 16px;
        padding: 2rem;
        border: 2px solid rgba(109, 29, 60, 0.1);
    }
    
    .competence-input-group {
        margin-bottom: 1.5rem;
    }
    
    .cycle-input-wrapper {
        position: relative;
    }
    
    .cycle-badge {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        background: linear-gradient(135deg, #6d1d3c 0%, #8a2449 100%);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        pointer-events: none;
    }
    
    .roman-note {
        background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
        border-left: 4px solid #ffc107;
        padding: 0.75rem 1rem;
        border-radius: 10px;
        margin-top: 1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: #856404;
        font-size: 0.9rem;
    }
    
    .competence-list-section {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 15px rgba(109, 29, 60, 0.08);
        max-height: 600px;
        overflow-y: auto;
    }
    
    .competence-list-section::-webkit-scrollbar {
        width: 6px;
    }
    
    .competence-list-section::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    .competence-list-section::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #6d1d3c 0%, #8a2449 100%);
        border-radius: 10px;
    }
    
    .competence-table {
        width: 100%;
        margin: 0;
    }
    
    .competence-table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid rgba(109, 29, 60, 0.1);
    }
    
    .competence-table tbody tr:hover {
        background: linear-gradient(135deg, rgba(109, 29, 60, 0.03) 0%, rgba(138, 36, 73, 0.03) 100%);
    }
    
    .competence-table td {
        padding: 1rem;
        vertical-align: middle;
    }
    
    .cycle-badge-table {
        background: linear-gradient(135deg, #6d1d3c 0%, #8a2449 100%);
        color: white;
        padding: 0.35rem 0.75rem;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
    }
    
    @media (max-width: 992px) {
        .competence-grid {
            grid-template-columns: 1fr;
        }
        
        .competence-list-section {
            max-height: none;
        }
    }
</style>

<div class="form-section" id="formComGeneral">
    <h2 class="section-title">Competencias Generales</h2>
    
    <div class="competence-grid">
        <!-- Sección de Agregar -->
        <div class="add-competence-section">
            <form action="" method="post" id="comGeneral">
                <input type="hidden" name="id_plan" id="id_plan" value="<?=$this->d['plan']->getId()?>">
                <div>
                    <div class="form-group-custom competence-input-group">
                        <label class="form-label-custom">
                            <i class="fas fa-star"></i>
                            Competencia General
                        </label>
                        <div class="input-wrapper-custom">
                            <i class="fas fa-star input-icon-custom"></i>
                            <textarea 
                                name="competenciaGeneral" 
                                id="competenciaGeneral"
                                class="textarea-modern" 
                                rows="4"
                                placeholder="Describe la competencia general que el estudiante desarrollará..."
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
                                name="ciclo" 
                                id="ciclo"
                                step="1" 
                                min="1"
                                max="10"
                                class="form-control-custom" 
                                placeholder="Ej: 4"
                                oninput="updateCycleBadge(this)"
                            >
                            <span class="cycle-badge" id="cycleBadge" style="display: none;"></span>
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
            
            <?php if(empty($this->d['comGeneral'])): ?>
                <div class="empty-state">
                    <i class="fas fa-inbox" style="font-size: 3rem; opacity: 0.3; margin-bottom: 1rem;"></i>
                    <p>No hay competencias generales asignadas aún</p>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="competence-table">
                        <tbody>
                            <?php foreach($this->d['comGeneral'] as $key => $value) :?>
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
                                        <button type="button" class="action-btn btn-delete btn-table-action" data-bs-toggle="modal" data-bs-target="#deleteComGeneral<?= $value['general_id']?>" title="Eliminar competencia">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        <?php require __DIR__ . '/../../components/modalPlan/modalDeleteComGeneral.php' ?>
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
        <button type="button" class="btn-prev-section nav_link" data-bs-target="formProposito">
            <i class="fas fa-arrow-left"></i>
            Anterior
        </button>
        <button type="button" class="btn-next-section nav_link" data-bs-target="formComBasico">
            Siguiente
            <i class="fas fa-arrow-right"></i>
        </button>
    </div>
</div>

<script>
// Función para actualizar el badge del ciclo
function updateCycleBadge(input) {
    const value = input.value;
    const badge = document.getElementById('cycleBadge');
    
    if (value && value > 0) {
        badge.textContent = `Ciclo ${value}`;
        badge.style.display = 'block';
    } else {
        badge.style.display = 'none';
    }
}

// Conversión a números romanos (para referencia visual)
function toRoman(num) {
    if (num < 1 || num > 3999) return "Fuera de rango (1-3999)";
    
    const romanNumerals = [
        [1000, 'M'], [900, 'CM'], [500, 'D'], [400, 'CD'],
        [100, 'C'], [90, 'XC'], [50, 'L'], [40, 'XL'],
        [10, 'X'], [9, 'IX'], [5, 'V'], [4, 'IV'], [1, 'I']
    ];
    
    let result = '';
    for (let [value, symbol] of romanNumerals) {
        while (num >= value) {
            result += symbol;
            num -= value;
        }
    }
    return result;
}
</script>