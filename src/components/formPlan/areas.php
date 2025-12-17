<style>
    .areas-layout {
        display: grid;
        grid-template-columns: 1fr;
        gap: 2rem;
        margin-top: 2rem;
    }
    
    .area-form-section {
        background: linear-gradient(135deg, #fafafa 0%, #f5f5f5 100%);
        border-radius: 16px;
        padding: 2rem;
        border: 2px solid rgba(109, 29, 60, 0.1);
    }
    
    .checkbox-group {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        margin-top: 0.5rem;
    }
    
    .checkbox-modern {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1.25rem;
        background: white;
        border: 2px solid rgba(109, 29, 60, 0.15);
        border-radius: 12px;
        transition: all 0.3s ease;
        cursor: pointer;
        flex: 1;
        min-width: 200px;
    }
    
    .checkbox-modern:hover {
        border-color: #6d1d3c;
        background: linear-gradient(135deg, rgba(109, 29, 60, 0.03) 0%, rgba(138, 36, 73, 0.03) 100%);
        transform: translateY(-2px);
    }
    
    .checkbox-modern input[type="checkbox"] {
        width: 1.25rem;
        height: 1.25rem;
        cursor: pointer;
        accent-color: #6d1d3c;
        flex-shrink: 0;
    }
    
    .checkbox-modern label {
        margin: 0;
        cursor: pointer;
        font-weight: 500;
        user-select: none;
    }
    
    .areas-table-section {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 15px rgba(109, 29, 60, 0.08);
    }
    
    .areas-table {
        width: 100%;
        margin: 0;
        min-width: 800px;
    }
    
    .areas-table thead {
        background: linear-gradient(135deg, #6d1d3c 0%, #8a2449 100%);
    }
    
    .areas-table thead th {
        color: white;
        font-weight: 600;
        padding: 1rem;
        border: none;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        white-space: nowrap;
    }
    
    .areas-table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid rgba(109, 29, 60, 0.1);
    }
    
    .areas-table tbody tr:hover {
        background: linear-gradient(135deg, rgba(109, 29, 60, 0.03) 0%, rgba(138, 36, 73, 0.03) 100%);
    }
    
    .areas-table tbody td {
        padding: 1rem;
        vertical-align: middle;
    }
    
    .form-divider {
        border: none;
        height: 2px;
        background: linear-gradient(90deg, transparent, rgba(109, 29, 60, 0.2), transparent);
        margin: 2rem 0 1.5rem 0;
    }
    
    /* Responsive Design */
    @media (max-width: 992px) {
        .area-form-section {
            padding: 1.5rem;
        }
        
        .areas-table-section {
            padding: 1rem;
        }
    }
    
    @media (max-width: 768px) {
        .area-form-section {
            padding: 1.25rem;
        }
        
        .checkbox-group {
            flex-direction: column;
            gap: 1rem;
        }
        
        .checkbox-modern {
            width: 100%;
            min-width: auto;
        }
        
        .areas-table thead th {
            padding: 0.75rem 0.5rem;
            font-size: 0.75rem;
        }
        
        .areas-table tbody td {
            padding: 0.75rem 0.5rem;
            font-size: 0.85rem;
        }
        
        .btn-action-group {
            flex-direction: column;
            gap: 0.75rem;
        }
        
        .btn-add-specialist,
        .btn-remove-specialist {
            width: 100%;
            justify-content: center;
        }
        
        .navigation-buttons {
            flex-direction: column;
            gap: 0.75rem;
        }
        
        .btn-prev-section,
        .btn-next-section {
            width: 100%;
            justify-content: center;
        }
    }
    
    @media (max-width: 576px) {
        .areas-layout {
            gap: 1.5rem;
        }
        
        .area-form-section {
            padding: 1rem;
            border-radius: 12px;
        }
        
        .areas-table-section {
            padding: 0.75rem;
            border-radius: 12px;
        }
        
        .form-divider {
            margin: 1.5rem 0 1rem 0;
        }
        
        .save-reminder {
            padding: 0.85rem;
            font-size: 0.9rem;
        }
        
        /* Optimización de tabla en móvil */
        .areas-table {
            min-width: 600px;
        }
        
        .areas-table thead th,
        .areas-table tbody td {
            padding: 0.5rem 0.35rem;
            font-size: 0.75rem;
        }
        
        .action-btn {
            padding: 0.4rem 0.6rem;
            min-width: 35px;
        }
        
        .action-btn i {
            font-size: 0.85rem;
        }
    }
    
    @media (max-width: 400px) {
        .area-form-section,
        .areas-table-section {
            padding: 0.75rem;
        }
        
        .checkbox-modern {
            padding: 0.6rem 1rem;
            font-size: 0.9rem;
        }
        
        .checkbox-modern input[type="checkbox"] {
            width: 1.1rem;
            height: 1.1rem;
        }
    }
    
    /* Scroll horizontal para tabla en móviles */
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    
    .table-responsive::-webkit-scrollbar {
        height: 8px;
    }
    
    .table-responsive::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    .table-responsive::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #6d1d3c 0%, #8a2449 100%);
        border-radius: 10px;
    }
</style>

<div class="form-section" id="formAreas">
    <h2 class="section-title">Áreas de Desempeño</h2>
    
    <div class="areas-layout">
        <!-- Formulario de Áreas -->
        <div class="area-form-section">
            <form action="" method="post" id="areas">
                <input type="hidden" name="id_plan" id="id_plan" value="<?=$this->d['plan']->getId()?>">
                <div>
                    <hr class="form-divider">
                    
                    <div class="form-group-custom">
                        <label class="form-label-custom">
                            <i class="fas fa-briefcase"></i>
                            Área de Desempeño
                        </label>
                        <div class="input-wrapper-custom">
                            <i class="fas fa-briefcase input-icon-custom"></i>
                            <input type="text" name="competenciaArea" class="form-control-custom" placeholder="Ej: Desarrollo de Software">
                        </div>
                    </div>
                    
                    <div class="form-group-custom">
                        <label class="form-label-custom">
                            <i class="fas fa-user-tie"></i>
                            Puesto a Desempeñar
                        </label>
                        <div class="input-wrapper-custom">
                            <i class="fas fa-user-tie input-icon-custom"></i>
                            <input type="text" name="competenciaAreaPuesto" class="form-control-custom" placeholder="Ej: Desarrollador Full Stack">
                        </div>
                    </div>
                    
                    <div class="form-group-custom">
                        <label class="form-label-custom">
                            <i class="fas fa-tasks"></i>
                            Funciones del Puesto
                        </label>
                        <textarea 
                            name="competenciaAreaFunciones" 
                            class="textarea-modern" 
                            rows="5"
                            placeholder="Describe las principales funciones y responsabilidades del puesto..."
                        ></textarea>
                    </div>
                    
                    <div class="form-group-custom">
                        <label class="form-label-custom">
                            <i class="fas fa-building"></i>
                            Tipo de Organización Laboral
                        </label>
                        <div class="checkbox-group">
                            <div class="checkbox-modern">
                                <input 
                                    class="form-check-input" 
                                    name="competenciaAreaOrganizacion" 
                                    type="checkbox" 
                                    value="empresa privada" 
                                    id="empresaPrivada"
                                >
                                <label for="empresaPrivada">
                                    <i class="fas fa-industry me-1"></i>
                                    Empresa Privada
                                </label>
                            </div>
                            <div class="checkbox-modern">
                                <input 
                                    class="form-check-input" 
                                    name="competenciaAreaOrganizacion" 
                                    type="checkbox" 
                                    value="empresa publica" 
                                    id="empresaPublica"
                                >
                                <label for="empresaPublica">
                                    <i class="fas fa-landmark me-1"></i>
                                    Empresa Pública
                                </label>
                            </div>
                        </div>
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
        
        <!-- Tabla de Áreas Asignadas -->
        <div class="areas-table-section">
            <h3 class="assigned-title">
                <i class="fas fa-list-check"></i>
                Áreas Asignadas
            </h3>
            
            <?php if(empty($this->d['areas'])): ?>
                <div class="empty-state">
                    <i class="fas fa-inbox" style="font-size: 3rem; opacity: 0.3; margin-bottom: 1rem;"></i>
                    <p>No hay áreas de desempeño asignadas aún</p>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="areas-table">
                        <thead>
                            <tr>
                                <th>Área</th>
                                <th>Puesto</th>
                                <th>Funciones</th>
                                <th>Organización</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($this->d['areas'] as $key => $value) :?>
                                <tr>
                                    <td><strong><?= $value['area']?></strong></td>
                                    <td><?= $value['puesto']?></td>
                                    <td><?= $value['funciones_puesto']?></td>
                                    <td><?= $value['tipo_organizacion']?></td>
                                    <td style="text-align: center;">
                                        <button type="button" class="action-btn btn-delete btn-table-action" data-bs-toggle="modal" data-bs-target="#deleteArea<?= $value['area_id']?>" title="Eliminar área">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        <?php require __DIR__ . '/../../components/modalPlan/modalDeleteArea.php' ?>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Navegación Final -->
    <div class="navigation-buttons mb-3">
        <button type="button" class="btn-prev-section nav_link" data-bs-target="formComEspecialidad">
            <i class="fas fa-arrow-left"></i>
            Anterior
        </button>
        <a href="/tesis/plan/materia/<?=$this->d['plan']->getId()?>" type="button" class="btn-next-section" onclick="saveInformation()">
            Ir a Materias
            <i class="fas fa-arrow-right"></i>
        </a>
    </div>
    
    <div class="save-reminder">
        <i class="fas fa-save"></i>
        <span><strong>¡Importante!</strong> Guarda todos los cambios antes de continuar a la sección de Materias</span>
    </div>
</div>