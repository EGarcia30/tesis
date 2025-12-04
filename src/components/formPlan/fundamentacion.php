<style>
    .static-text {
        background: linear-gradient(135deg, #fafafa 0%, #f5f5f5 100%);
        border-left: 4px solid #6d1d3c;
        padding: 1.25rem;
        border-radius: 12px;
        margin-bottom: 1.5rem;
        color: #2d3748;
        line-height: 1.8;
    }
    
    .textarea-modern {
        border: 2px solid rgba(109, 29, 60, 0.15);
        border-radius: 14px;
        padding: 1rem;
        transition: all 0.3s ease;
        font-size: 1rem;
        width: 100%;
        font-family: 'Montserrat', sans-serif;
        resize: vertical;
        min-height: 150px;
    }
    
    .textarea-modern:focus {
        border-color: #6d1d3c;
        box-shadow: 0 0 0 0.25rem rgba(109, 29, 60, 0.15);
        outline: none;
    }
    
    .navigation-buttons {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
    }
    
    .btn-prev-section {
        background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .btn-prev-section:hover {
        transform: translateX(-5px);
        box-shadow: 0 5px 15px rgba(108, 117, 125, 0.3);
        color: white;
    }
</style>

<form class="form-section" id="formFundamentacion">
    <h2 class="section-title">Fundamentación</h2>

    <input type="hidden" name="id_plan" id="id_plan" value="<?=$this->d['plan']->getId()?>">
    
    <div class="static-text">
        <p class="mb-0">
            La Universidad Tecnológica de El Salvador presenta a la sociedad la carrera de 
            <strong><?=$this->d['plan']->getNameCar()?></strong>, para formar con estrategias de entrega 
            <strong><?=$this->d['plan']->getModalityCar()?></strong>,
        </p>
    </div>
    
    <div class="form-group-custom">
        <label class="form-label-custom">
            <i class="fas fa-file-alt"></i>
            Continúa el texto con el apartado de fundamentación
        </label>
        <textarea class="textarea-modern" name="fundamentacion" id="fundamentacion" rows="8" placeholder="Escribe aquí la fundamentación del plan de estudio..."><?=$this->d['plan']->getFundamentacion()?></textarea>
        <small class="form-text-custom">
            <i class="fas fa-info-circle"></i>
            Desarrolla los fundamentos académicos y profesionales de la carrera
        </small>
    </div>
    
    <div class="static-text">
        <p class="mb-0">
            Con la estrategia de entrega <strong><?=$this->d['plan']->getModalityCar()?></strong>, se podrán eliminar barreras fronterizas y 
            se contribuirá al cumplimiento de la Misión Institucional, en la cual se establece que 
            "La Universidad Tecnológica de El Salvador existe para brindar a amplios sectores 
            poblacionales, innovadores servicios educativos".
        </p>
    </div>
    
    <div class="navigation-buttons">
        <button type="button" class="btn-prev-section nav_link" data-bs-target="formInicio">
            <i class="fas fa-arrow-left"></i>
            Anterior
        </button>
        <button type="submit" class="btn-next-section nav_link" data-bs-target="formCreador">
            Siguiente
            <i class="fas fa-arrow-right"></i>
        </button>
    </div>
</form>     