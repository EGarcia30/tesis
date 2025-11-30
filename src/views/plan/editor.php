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
                <a href="/tesis/planes/1" class="btn-editor btn-editor-back" onclick="emptyInformation()">
                    <i class="fas fa-arrow-left"></i>
                    Regresar
                </a>
                
                <button type="button" class="btn-editor btn-editor-save" data-bs-toggle="modal" data-bs-target="#staticBackdrop" onclick="saveInformation()">
                    <i class="fas fa-save"></i>
                    Guardar
                </button>
                
                <!-- Modal Guardar -->
                <?php require __DIR__ . '/../../components/modalPlan/modalSavePlan.php'; ?>
                
                <a href="/tesis/word/<?= $this->d['plan']->getId()?>" class="btn-editor btn-editor-word">
                    <i class="fas fa-file-word"></i>
                    Exportar
                </a>
                
                <a href="/tesis/<?= $name = str_replace(' ','-',$this->d['plan']->getNameCar())?>/planes/1" class="btn-editor btn-editor-view" onclick="emptyInformation()">
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