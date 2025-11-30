<style>
    .specialists-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        margin-top: 2rem;
    }
    
    .assign-section {
        background: linear-gradient(135deg, #fafafa 0%, #f5f5f5 100%);
        border-radius: 16px;
        padding: 2rem;
        border: 2px solid rgba(109, 29, 60, 0.1);
    }
    
    .select-modern {
        border: 2px solid rgba(109, 29, 60, 0.15);
        border-radius: 12px;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        width: 100%;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .select-modern:focus {
        border-color: #6d1d3c;
        box-shadow: 0 0 0 0.2rem rgba(109, 29, 60, 0.15);
        outline: none;
    }
    
    .btn-action-group {
        display: flex;
        gap: 0.5rem;
        margin-top: 1rem;
    }
    
    .btn-add-specialist {
        background: linear-gradient(135deg, #28a745 0%, #218838 100%);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 0.6rem 1rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 600;
    }
    
    .btn-add-specialist:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
        color: white;
    }
    
    .btn-remove-specialist {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 0.6rem 1rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 600;
    }
    
    .btn-remove-specialist:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
        color: white;
    }
    
    .help-text-link {
        color: #6d1d3c;
        text-decoration: underline;
        font-weight: 600;
        transition: color 0.3s ease;
    }
    
    .help-text-link:hover {
        color: #8a2449;
    }
    
    .assigned-section {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 15px rgba(109, 29, 60, 0.08);
    }
    
    .assigned-title {
        color: #6d1d3c;
        font-weight: 700;
        font-size: 1.5rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .specialists-table {
        width: 100%;
        margin: 0;
    }
    
    .specialists-table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid rgba(109, 29, 60, 0.1);
    }
    
    .specialists-table tbody tr:hover {
        background: linear-gradient(135deg, rgba(109, 29, 60, 0.03) 0%, rgba(138, 36, 73, 0.03) 100%);
    }
    
    .specialists-table td {
        padding: 1rem;
        vertical-align: middle;
    }
    
    .btn-table-action {
        padding: 0.5rem 0.75rem;
        border-radius: 8px;
        border: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    
    .empty-state {
        text-align: center;
        padding: 2rem;
        color: #6c757d;
        font-style: italic;
    }
    
    @media (max-width: 992px) {
        .specialists-container {
            grid-template-columns: 1fr;
        }
        
        .assign-section, .assigned-section {
            padding: 1.5rem;
        }
    }
    
    @media (max-width: 576px) {
        .btn-action-group {
            flex-direction: column;
        }
        
        .btn-add-specialist,
        .btn-remove-specialist {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="form-section" id="formCreador">
    <h2 class="section-title">Especialistas / Creadores</h2>
    
    <div class="specialists-container">
        <!-- Sección de Asignación -->
        <div class="assign-section">
            <div class="form-group-custom">
                <label class="form-label-custom">
                    <i class="fas fa-user-plus"></i>
                    Asignar Especialistas
                </label>
                
                <form action="" method="post">
                    <div id="selectsCreador" class="mb-3">
                        <select class="select-modern" name="opcionCreador[]" id="opcionCreador">
                            <option value="">Seleccionar especialista...</option>
                            <?php foreach($this->d['creadores'] as $key => $value) :?>
                                <option value="<?= $value['creador_id']?>"><?= $value['nombre_creador']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="btn-action-group">
                        <button type="button" class="btn-add-specialist" onclick="agregarCreador()">
                            <i class="fas fa-plus"></i>
                            Agregar
                        </button>
                        <button type="button" class="btn-remove-specialist" onclick="eliminarCreador()">
                            <i class="fas fa-minus"></i>
                            Eliminar
                        </button>
                    </div>
                </form>
            </div>
            
            <div class="save-reminder mt-3">
                <i class="fas fa-info-circle"></i>
                <span>
                    ¿No existe el especialista que buscas? 
                    <a href="/tesis/creadores/1" class="help-text-link">Crear nuevo especialista</a>
                </span>
            </div>
        </div>
        
        <!-- Sección de Asignados -->
        <div class="assigned-section">
            <h3 class="assigned-title">
                <i class="fas fa-users"></i>
                Especialistas Asignados
            </h3>
            
            <?php if(empty($this->d['creador'])): ?>
                <div class="empty-state">
                    <i class="fas fa-inbox" style="font-size: 3rem; opacity: 0.3; margin-bottom: 1rem;"></i>
                    <p>No hay especialistas asignados aún</p>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="specialists-table">
                        <tbody>
                            <?php foreach($this->d['creador'] as $key => $value) :?>
                                <tr>
                                    <td style="width: 60%;">
                                        <strong><?= $value['Creador']?></strong>
                                    </td>
                                    <td style="width: 20%; text-align: center;">
                                        <a href="/tesis/creador/editor/<?= $value['creador_id']?>" class="action-btn btn-edit btn-table-action" title="Editar especialista">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    <td style="width: 20%; text-align: center;">
                                        <button type="button" class="action-btn btn-delete btn-table-action" data-bs-toggle="modal" data-bs-target="#deleteCreadorPlan<?= $value['creador_id']?>" title="Eliminar especialista">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        <?php require __DIR__ . '/../../components/modalPlan/modalDeleteCreador.php' ?>
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
        <button type="button" class="btn-prev-section nav_link" data-bs-target="formFundamentacion">
            <i class="fas fa-arrow-left"></i>
            Anterior
        </button>
        <button type="button" class="btn-next-section nav_link" data-bs-target="formGeneralidades">
            Siguiente
            <i class="fas fa-arrow-right"></i>
        </button>
    </div>
</div>