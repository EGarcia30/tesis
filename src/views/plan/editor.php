<?php require_once __DIR__ . '/../../components/layoutEditorPlan/header.php' ?>

<style>
    .editor-actions {
        background: white;
        border-radius: 16px;
        padding: 1rem 1.5rem;
        box-shadow: 0 4px 15px rgba(109, 29, 60, 0.08);
        margin-bottom: 1.5rem;
    }
    
    .btn-editor {
        padding: 0.65rem 1.2rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .btn-editor-back {
        background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
        color: white;
    }
    
    .btn-editor-back:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(108, 117, 125, 0.3);
        color: white;
    }
    
    .btn-editor-save {
        background: linear-gradient(135deg, #28a745 0%, #218838 100%);
        color: white;
    }
    
    .btn-editor-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
        color: white;
    }
    
    .btn-editor-word {
        background: linear-gradient(135deg, #6d1d3c 0%, #8a2449 100%);
        color: white;
        padding: 0.65rem 1rem;
    }
    
    .btn-editor-word:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(109, 29, 60, 0.3);
        color: white;
    }
    
    .btn-editor-view {
        background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
        color: white;
        padding: 0.65rem 1rem;
    }
    
    .btn-editor-view:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
        color: white;
    }
    
    .editor-card {
        background: white;
        border-radius: 24px;
        box-shadow: 0 10px 30px rgba(109, 29, 60, 0.1);
        padding: 2rem;
        border: 1px solid rgba(109, 29, 60, 0.1);
        position: relative;
        overflow: hidden;
        max-height: calc(100vh - 200px);
        display: flex;
        flex-direction: column;
    }
    
    .editor-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(135deg, #6d1d3c 0%, #8a2449 100%);
    }
    
    .editor-content {
        overflow-y: auto;
        flex: 1;
        padding-right: 1rem;
    }
    
    .editor-content::-webkit-scrollbar {
        width: 8px;
    }
    
    .editor-content::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    .editor-content::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #6d1d3c 0%, #8a2449 100%);
        border-radius: 10px;
    }
    
    .editor-content::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, #541730 0%, #6d1d3c 100%);
    }
    
    .editor-title {
        background: linear-gradient(135deg, #6d1d3c 0%, #8a2449 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 800;
        font-size: 2.5rem;
        margin-bottom: 1rem;
        text-align: center;
    }
    
    .editor-subtitle {
        color: #6d1d3c;
        font-weight: 700;
        font-size: 1.75rem;
        margin-bottom: 1.5rem;
        text-align: center;
    }
    
    .editor-divider {
        border: none;
        height: 2px;
        background: linear-gradient(90deg, transparent, #6d1d3c, transparent);
        margin: 2rem auto;
        width: 75%;
    }
    
    @media (max-width: 768px) {
        .editor-actions {
            padding: 1rem;
        }
        
        .btn-editor {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }
        
        .editor-card {
            padding: 1.5rem;
            max-height: calc(100vh - 180px);
        }
        
        .editor-title {
            font-size: 2rem;
        }
        
        .editor-subtitle {
            font-size: 1.4rem;
        }
    }
</style>

<main id="main-content" class="admin-container">
    <div class="container-fluid mx-auto px-3">
        <!-- Editor Actions -->
        <div class="editor-actions">
            <div class="d-flex flex-wrap gap-2 align-items-center">
                <a href="/tesis/planes/1" class="btn-editor btn-editor-back">
                    <i class="fas fa-arrow-left"></i>
                    Regresar
                </a>
                
                <button type="button" class="btn-editor btn-editor-save" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <i class="fas fa-save"></i>
                    Guardar
                </button>
                
                <!-- Modal Guardar -->
                <?php require __DIR__ . '/../../components/modalPlan/modalSavePlan.php'; ?>
                
                <a href="/tesis/word/<?= $this->d['plan']->getId()?>" class="btn-editor btn-editor-word">
                    <i class="fas fa-file-word"></i>
                    Exportar
                </a>
                
                <a href="/tesis/<?= $name = str_replace(' ','-',$this->d['plan']->getNameCar())?>/planes/1" class="btn-editor btn-editor-view">
                    <i class="fas fa-eye"></i>
                    Ver Planes
                </a>
            </div>
        </div>

        <!-- Alerts -->
        <div class="position-relative mb-3">
            <div class="position-absolute end-0 top-0">
                <?php require __DIR__ . '/../../components/alerts.php'; ?>
            </div>
        </div>

        <!-- Editor Card -->
        <div class="editor-card">
            <div class="editor-content">
                <h1 class="editor-title">Plan de Estudio</h1>
                <h2 class="editor-subtitle"><?= $this->d['plan']->getNameCar()?></h2>
                <hr class="editor-divider"/>
                
                <?php require_once __DIR__ . '/../../components/formPlan/portada.php' ?>
                <?php require_once __DIR__ . '/../../components/formPlan/fundamentacion.php' ?>
                <?php require_once __DIR__ . '/../../components/formPlan/creador.php' ?>
                <?php require_once __DIR__ . '/../../components/formPlan/generalidades.php' ?>
                <?php require_once __DIR__ . '/../../components/formPlan/proposito.php' ?>
                <?php require_once __DIR__ . '/../../components/formPlan/competenciasGenerales.php' ?>
                <?php require_once __DIR__ . '/../../components/formPlan/competenciasBasicas.php' ?>
                <?php require_once __DIR__ . '/../../components/formPlan/competenciasEspecialidad.php' ?>
                <?php require_once __DIR__ . '/../../components/formPlan/areas.php' ?>
            </div>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../../components/layoutEditorPlan/footer.php' ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        formInicioSubmit();
        formFundamentacionSubmit();
        formCreadorChange();
        formGeneralidadesSubmit();
        formPropositoSubmit();
        formComGeneralSubmit();
    });

    //PORTADA
    function formInicioSubmit() {
        const form = document.getElementById('formInicio');

        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Evita recargar la página

            const formData = new FormData(event.target);

            const idPlan = formData.get('id_plan');
            const datosEnviar = new URLSearchParams(formData);

            fetch(`/tesis/plan/portada/${idPlan}`, {
                method: 'POST',
                body: datosEnviar,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del controlador');
                }
                return response.json();
            })
            .then(data => {
            //console.log('Respuesta de la API:', data);
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Hubo un error al guardar la portada.');
            });
        });
    }

    //FUNDAMENTACIÓN
    function formFundamentacionSubmit() {
        const form = document.getElementById('formFundamentacion');        

        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Evita recargar la página

            const formData = new FormData(event.target);

            const idPlan = formData.get('id_plan');
            const datosEnviar = new URLSearchParams(formData);

            fetch(`/tesis/plan/fundamentacion/${idPlan}`, {
                method: 'POST', 
                body: datosEnviar,                                                                     
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del controlador');
                }
                return response.json();
            })
            .then(data => {
                //console.log('Éxito:', data);
                //alert('Fundamentación guardada correctamente.');
            })
            .catch((error) => {
                console.error('Error:', error);
                alert('Hubo un error al guardar la fundamentación.');
            });
        });
    }

    //CREADOR
    //Select2 Initialization
    $(document).ready(function() {

        $('#opcionCreador').select2({
            theme: 'bootstrap-5',
            width: '100%'
        });

    });

    function formCreadorChange() {
        const $form = $('#asignarCreador');
        const $select = $('#opcionCreador');

        $select.on('select2:select', function(event) {
            const formData = new FormData($form[0]);
            const idPlan = formData.get('id_plan');
            const opcionCreador = formData.get('opcionCreador');

            if (opcionCreador) {
                const datosEnviar = new URLSearchParams(formData);

                fetch(`/tesis/plan/creador/${idPlan}`, {
                    method: 'POST',
                    body: datosEnviar,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8'
                    }
                })
                .then(response => {
                    if (!response.ok) throw new Error('Error en la respuesta');
                    return response.json();
                })
                .then(data => {
                    //console.log('Guardado OK:', data);
                    
                    if (data.status === 'success' && data.creador) {
                        agregarCreadorATabla(data.creador, idPlan);
                    }
                    
                    // Reiniciar select
                    $select.val(null).trigger('change');
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Hubo un error al guardar el especialista.');
                });
            }
        });
    }

    // ✅ FUNCIÓN para agregar fila + modal dinámicamente
    function agregarCreadorATabla(creador, idPlan) {
        let tbody = document.querySelector('.specialists-table tbody');

        if (!tbody) {
            // La tabla no existe, crear estructura y agregar al DOM
            const assignedSection = document.querySelector('.assigned-section');
            
            // Remover mensaje estado vacío si existe
            const emptyState = document.querySelector('.empty-state');
            if (emptyState) emptyState.remove();

            const tableHTML = `
                <div class="table-responsive">
                    <table class="specialists-table">
                        <tbody></tbody>
                    </table>
                </div>
            `;
            assignedSection.insertAdjacentHTML('beforeend', tableHTML);
            tbody = document.querySelector('.specialists-table tbody');
        }

        const nuevoTr = document.createElement('tr');
        nuevoTr.innerHTML = `
            <td style="width: 60%;">
                <strong>${creador.nombre_creador}</strong>
            </td>
            <td style="width: 20%; text-align: center;">
                <button type="button" class="action-btn btn-delete btn-table-action" 
                        data-bs-toggle="modal" 
                        data-bs-target="#deleteCreadorPlan${creador.creador_id}" 
                        title="Eliminar especialista">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </td>
        `;

        // Crear el modal dinámico (como en tu código)
        const modalId = `deleteCreadorPlan${creador.creador_id}`;
        const modalHTML = `
            <div class="modal fade" id="${modalId}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">¿Quieres desvincular el creador del plan de estudio?</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="text-start text-break"><b>${creador.nombre_creador}</b>, Se eliminará la vinculación con este plan de estudio.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Regresar</button>
                            <a href="/tesis/creador/plan/${creador.creador_id}/${idPlan}" class="btn btn-danger">Eliminar</a>
                        </div>
                    </div>
                </div>
            </div>
        `;

        tbody.appendChild(nuevoTr);
        document.body.insertAdjacentHTML('beforeend', modalHTML);
    }

    //ELIMINAR CREADOR
    function eliminarCreador(idCreador, idPlan, filaTr) {
        fetch(`/tesis/creador/plan/${idCreador}/${idPlan}`, {
            method: 'DELETE'
        })
        .then(response => {
            if (!response.ok) throw new Error('Error en la eliminación');
            return response.json();
        })
        .then(data => {
            if (data.status === 'success') {
                // 1. ✅ Remover fila de la tabla
                if (filaTr) filaTr.remove();
                
                // 2. ✅ Mostrar alerta
                mostrarMensaje('Creador desvinculado correctamente', 'success');
                
                // 3. ✅ LIMPIAR COMPLETAMENTE EL MODAL + BACKDROP
                limpiarModalCompletamenteCreador(idCreador);
                
                // 4. ✅ Verificar estado vacío
                const tbody = document.querySelector('.specialists-table tbody');
                if (tbody && tbody.children.length === 0) {
                    mostrarEstadoVacio();
                }
            } else {
                mostrarMensaje(data.message || 'Error al eliminar el creador', 'danger');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            mostrarMensaje('Error de conexión', 'danger');
        });
    }

    // ✅ NUEVA FUNCIÓN: Limpia modal + backdrop completamente
    function limpiarModalCompletamenteCreador(idCreador) {
        const modalId = `deleteCreadorPlan${idCreador}`;
        const modalElement = document.querySelector(`#${modalId}`);
        
        if (modalElement) {
            // Obtener instancia del modal
            const modal = bootstrap.Modal.getInstance(modalElement);
            
            if (modal) {
                // Escuchar evento 'hidden.bs.modal' para limpiar backdrop
                modalElement.addEventListener('hidden.bs.modal', function cleanup() {
                    // ✅ FORZAR LIMPIEZA DEL BACKDROP
                    document.body.classList.remove('modal-open');
                    const backdrops = document.querySelectorAll('.modal-backdrop');
                    backdrops.forEach(backdrop => backdrop.remove());
                    
                    // Remover listener para evitar memory leaks
                    modalElement.removeEventListener('hidden.bs.modal', cleanup);
                }, { once: true });
                
                // Ocultar modal
                modal.hide();
            } else {
                // Si no hay instancia, limpiar manualmente
                modalElement.remove();
                document.body.classList.remove('modal-open');
                document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
            }
        } else {
            // Limpieza de emergencia si no encuentra el modal
            document.body.classList.remove('modal-open');
            document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
        }
    }

    // ✅ Usar tu sistema de alertas existente
    // ✅ FUNCIÓN mostrarMensaje() - IDÉNTICA AL PHP
    function mostrarMensaje(mensaje, tipo) {
        // Buscar contenedor correcto
        const alertWrapper = document.querySelector('.position-relative.mb-3 .position-absolute.end-0.top-0');
        
        if (!alertWrapper) {
            console.warn('Contenedor para alertas no encontrado');
            return;
        }

        // ✅ LIMPIAR alertas previas (igual que PHP)
        alertWrapper.innerHTML = '';

        // ✅ CONFIG ICONOS IDÉNTICA al PHP $iconMap
        const config = {
            'success': { icon: 'fa-check-circle', clase: 'alert-modern-success' },
            'danger': { icon: 'fa-exclamation-circle', clase: 'alert-modern-danger' },
            'warning': { icon: 'fa-exclamation-triangle', clase: 'alert-modern-warning' },
            'info': { icon: 'fa-info-circle', clase: 'alert-modern-info' },
            'primary': { icon: 'fa-bell', clase: 'alert-modern-primary' }
        };

        const tipoConfig = config[tipo] || config['info'];

        // ✅ HTML EXACTAMENTE IGUAL al PHP
        const alertaHTML = `
            <div id="alerta" class="alert alert-modern ${tipoConfig.clase} alert-dismissible fade show" role="alert">
                <div class="alert-icon">
                    <i class="fas ${tipoConfig.icon}"></i>
                </div>
                <div class="alert-content">
                    ${mensaje}
                </div>
                <button type="button" class="btn-close btn-close-modern" data-bs-dismiss="alert" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;

        alertWrapper.insertAdjacentHTML('afterbegin', alertaHTML);
        
        // ✅ INICIALIZAR Bootstrap Alert (igual que PHP)
        const alerta = new bootstrap.Alert(document.getElementById('alerta'));
    }

    function crearContenedorAlerta() {
        const alertaContainer = document.createElement('div');
        alertaContainer.id = 'alertas-container';
        alertaContainer.className = 'position-relative mt-3';
        document.querySelector('.form-section')?.insertAdjacentElement('afterbegin', alertaContainer);
        return alertaContainer;
    }

    function mostrarEstadoVacio() {
        // Buscar la sección de asignados
        const assignedSection = document.querySelector('.assigned-section');
        if (!assignedSection) return;

        // Remover tabla si existe
        const tableContainer = assignedSection.querySelector('.table-responsive');
        if (tableContainer) {
            tableContainer.remove();
        }

        // Remover cualquier tbody vacío que quede
        const tbody = assignedSection.querySelector('.specialists-table tbody');
        if (tbody) {
            tbody.remove();
        }

        // Insertar estado vacío
        assignedSection.insertAdjacentHTML('beforeend', `
            <div class="empty-state">
                <i class="fas fa-inbox" style="font-size: 3rem; opacity: 0.3; margin-bottom: 1rem;"></i>
                <p>No hay especialistas asignados aún</p>
            </div>
        `);
    }

    window.limpiarBackdrops = function() {
        document.body.classList.remove('modal-open');
        document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
    };

    // ✅ INTERCEPTAR CLICKS DE BOTONES ELIMINAR EN MODALES (IMPORTANTE)
    // ✅ INTERCEPTADOR QUE MANEJA AMBOS TIPOS DE BOTONES
    document.addEventListener('click', function(e) {
        const btnEliminar = e.target.closest('[data-creador-id]');
        if (btnEliminar) {
            e.preventDefault();
            e.stopPropagation();
            
            // ✅ MÉTODO 1: Si tiene data attributes (modales estáticos/dinámicos corregidos)
            let idCreador = btnEliminar.getAttribute('data-creador-id');
            let idPlan = btnEliminar.getAttribute('data-plan-id');
            
            // ✅ MÉTODO 2: Fallback por ID del modal (modales antiguos)
            if (!idCreador) {
                const modal = btnEliminar.closest('.modal');
                const modalId = modal.id;
                idCreador = modalId.replace('deleteCreadorPlan', '');
                idPlan = document.getElementById('id_plan').value;
            }
            
            const filaTr = document.querySelector(`[data-bs-target="#${btnEliminar.closest('.modal').id}"]`)?.closest('tr');
            
            eliminarCreador(idCreador, idPlan, filaTr);
        }
    });

    //GENERALIDADES
    function formGeneralidadesSubmit() {
        const form = document.getElementById('formGeneralidades');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            
            const formData = new FormData(event.target);
            const idPlan = formData.get('id_plan');
            const idGeneralidad = formData.get('generalidad_id');
            
            const esUpdate = idGeneralidad != 0;
            
            if (esUpdate) {
                // PUT: JSON
                const datosEnviar = Object.fromEntries(formData);
                fetch(`/tesis/plan/generalidades/${idPlan}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(datosEnviar)
                })
                .then(response => {
                    if (!response.ok) throw new Error('Error servidor');
                    return response.json();
                })
                .then(data => {
                    const divGeneralidades = document.getElementById('generalidad_id');
                    divGeneralidades.value = data.id_generalidad;
                })
                .catch(error => {
                    console.error(error);
                    alert('Error al guardar');
                });
            } else {
                // POST: FormData nativo (sin headers)
                fetch(`/tesis/plan/generalidades/${idPlan}`, {
                    method: 'POST',
                    body: formData  // FormData directo
                })
                .then(response => {
                    if (!response.ok) throw new Error('Error servidor');
                    return response.json();
                })
                .then(data => {
                    const divGeneralidades = document.getElementById('generalidad_id');
                    divGeneralidades.value = data.id_generalidad;
                })
                .catch(error => {
                    console.error(error);
                    alert('Error al guardar');
                });
            }
        });
    }

    //PROPÓSITO
    function formPropositoSubmit() {
        const form = document.getElementById('formProposito');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            
            const formData = new FormData(event.target);
            const idPlan = formData.get('id_plan');
            const idProposito = formData.get('proposito_id');
            
            const esUpdate = idProposito != 0;
            
            if (esUpdate) {
                // PUT: JSON
                const datosEnviar = Object.fromEntries(formData);
                fetch(`/tesis/plan/proposito/${idPlan}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(datosEnviar)
                })
                .then(response => {
                    if (!response.ok) throw new Error('Error servidor');
                    return response.json();
                })
                .then(data => {
                    const divProposito = document.getElementById('proposito_id');
                    divProposito.value = data.id_proposito;
                })
                .catch(error => {
                    console.error(error);
                    alert('Error al guardar');
                });
            } else {
                // POST: FormData nativo (sin headers)
                fetch(`/tesis/plan/proposito/${idPlan}`, {
                    method: 'POST',
                    body: formData  // FormData directo
                })
                .then(response => {
                    if (!response.ok) throw new Error('Error servidor');
                    return response.json();
                })
                .then(data => {
                    const divProposito = document.getElementById('proposito_id');
                    divProposito.value = data.id_proposito;
                })
                .catch(error => {
                    console.error(error);
                    alert('Error al guardar');
                });
            }
        });
    }

    //COMPETENCIAS GENERALES
    function formComGeneralSubmit() {
        const form = document.getElementById('comGeneral');

        form.addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(form);
            const idPlan = formData.get('id_plan');
            
            fetch(`/tesis/plan/competencias-generales/${idPlan}`, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success' && data.descripcion) {
                    agregarCompetenciaGeneralATabla(data, idPlan);
                    form.reset();
                    updateCycleBadge(document.getElementById('ciclo'));
                }
            })
            .catch(error => {
                console.error(error);
                alert('Error al guardar');
            });
        });
    }

    // ✅ FUNCIÓN para agregar competencia general + modal dinámicamente (CORREGIDA)
    function agregarCompetenciaGeneralATabla(data, idPlan) {
        let tbody = document.querySelector('.competence-table tbody');

        if (!tbody) {
            // La tabla no existe, crear estructura y agregar al DOM
            const assignedSection = document.querySelector('.competence-list-section'); // ✅ Sección específica
            
            // Remover mensaje estado vacío si existe
            const emptyState = document.querySelector('.empty-state');
            if (emptyState) emptyState.remove();

            const tableHTML = `
                <div class="table-responsive">
                    <table class="competence-table">
                        <tbody></tbody>
                    </table>
                </div>
            `;
            assignedSection.insertAdjacentHTML('beforeend', tableHTML);
            tbody = document.querySelector('.competence-table tbody');
        }

        // Convertir ciclo a romano
        const cicloRomano = toRoman(data.ciclo);
        
        const nuevoTr = document.createElement('tr');
        nuevoTr.innerHTML = `
            <td style="width: 50%;">
                <strong>${data.descripcion}</strong>
            </td>
            <td style="width: 25%; text-align: center;">
                <span class="cycle-badge-table">
                    <i class="fas fa-calendar-alt me-1"></i>
                    Ciclo ${cicloRomano}
                </span>
            </td>
            <td style="width: 25%; text-align: center;">
                <button type="button" class="action-btn btn-delete btn-table-action" 
                        data-bs-toggle="modal" 
                        data-bs-target="#deleteComGeneral${data.general_id}" 
                        title="Eliminar competencia">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </td>
        `;

        // Crear el modal dinámico (EXACTAMENTE como agregarCreadorATabla)
        const modalId = `deleteComGeneral${data.general_id}`;
        const modalHTML = `
            <div class="modal fade" id="${modalId}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content bg-dark text-white">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">¿Quieres eliminar la competencia general?</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="text-start text-break"><b>${data.descripcion}</b>, Se eliminará la vinculación con este plan de estudio.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Regresar</button>
                            <button type="button" class="btn btn-danger btn-eliminar" 
                                    data-general-id="${data.general_id}"
                                    data-plan-id="${idPlan}">
                                Eliminar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;

        tbody.appendChild(nuevoTr);
        document.body.insertAdjacentHTML('beforeend', modalHTML); // ✅ Solo modalDeleteHTML
    }

    //Elinar competencia general
    function eliminarComGeneral(idPlan, idComGeneral, filaTr) {
        fetch(`/tesis/plan/competencias-generales/${idPlan}/${idComGeneral}`, {
            method: 'DELETE'
        })
        .then(response => {
            if (!response.ok) throw new Error('Error en la eliminación');
            return response.json();
        })
        .then(data => {
            if (data.status === 'success') {
                // 1. ✅ Remover fila de la tabla
                if (filaTr) filaTr.remove();
                
                // 2. ✅ Mostrar alerta
                mostrarMensaje('Competencia general eliminada correctamente', 'success');
                
                // 3. ✅ LIMPIAR COMPLETAMENTE EL MODAL + BACKDROP
                limpiarModalCompletamenteComGeneral(idComGeneral);
                
                // 4. ✅ Verificar estado vacío
                const tbody = document.querySelector('.competence-table tbody');
                if (tbody && tbody.children.length === 0) {
                    mostrarEstadoVacio();
                }
            } else {
                mostrarMensaje(data.message || 'Error al eliminar la competencia general', 'danger');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            mostrarMensaje('Error de conexión', 'danger');
        });
    }

    function limpiarModalCompletamenteComGeneral(idComGeneral) {
        const modalId = `deleteComGeneral${idComGeneral}`;
        const modalElement = document.querySelector(`#${modalId}`);
        
        if (modalElement) {
            // Obtener instancia del modal
            const modal = bootstrap.Modal.getInstance(modalElement);
            
            if (modal) {
                // Escuchar evento 'hidden.bs.modal' para limpiar backdrop
                modalElement.addEventListener('hidden.bs.modal', function cleanup() {
                    // ✅ FORZAR LIMPIEZA DEL BACKDROP
                    document.body.classList.remove('modal-open');
                    const backdrops = document.querySelectorAll('.modal-backdrop');
                    backdrops.forEach(backdrop => backdrop.remove());
                    
                    // Remover listener para evitar memory leaks
                    modalElement.removeEventListener('hidden.bs.modal', cleanup);
                }, { once: true });
                
                // Ocultar modal
                modal.hide();
            } else {
                // Si no hay instancia, limpiar manualmente
                modalElement.remove();
                document.body.classList.remove('modal-open');
                document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
            }
        } else {
            // Limpieza de emergencia si no encuentra el modal
            document.body.classList.remove('modal-open');
            document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
        }
    }

    // ✅ INTERCEPTAR CLICKS DE BOTONES ELIMINAR EN MODALES (IMPORTANTE)
    // ✅ INTERCEPTADOR QUE MANEJA AMBOS TIPOS DE BOTONES
    document.addEventListener('click', function(e) {
        const btnEliminar = e.target.closest('[data-general-id]');
        if (btnEliminar) {
            e.preventDefault();
            e.stopPropagation();
            
            // ✅ MÉTODO 1: Si tiene data attributes (modales estáticos/dinámicos corregidos)
            let idComGeneral = btnEliminar.getAttribute('data-general-id');
            let idPlan = btnEliminar.getAttribute('data-plan-id');
            
            // ✅ MÉTODO 2: Fallback por ID del modal (modales antiguos)
            if (!idComGeneral) {
                const modal = btnEliminar.closest('.modal');
                const modalId = modal.id;
                idComGeneral = modalId.replace('deleteComGeneral', '');
                idPlan = document.getElementById('id_plan').value;
            }
            
            const filaTr = document.querySelector(`[data-bs-target="#${btnEliminar.closest('.modal').id}"]`)?.closest('tr');
            
            eliminarComGeneral(idPlan, idComGeneral, filaTr);
        }
    });

    </script>