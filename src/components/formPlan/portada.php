<style>
    .form-section {
        background: white;
        border-radius: 20px;
        padding: 2.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 20px rgba(109, 29, 60, 0.08);
        border: 2px solid rgba(109, 29, 60, 0.1);
        position: relative;
    }
    
    .form-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 5px;
        height: 100%;
        background: linear-gradient(135deg, #6d1d3c 0%, #8a2449 100%);
        border-radius: 20px 0 0 20px;
    }
    
    .section-title {
        background: linear-gradient(135deg, #6d1d3c 0%, #8a2449 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 800;
        font-size: 2rem;
        margin-bottom: 2rem;
        text-align: center;
    }
    
    .btn-next-section {
        background: linear-gradient(135deg, #6d1d3c 0%, #8a2449 100%);
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
    
    .btn-next-section:hover {
        transform: translateX(5px);
        box-shadow: 0 5px 15px rgba(109, 29, 60, 0.3);
        color: white;
    }
    
    .save-reminder {
        background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
        border-left: 4px solid #ffc107;
        padding: 1rem;
        border-radius: 10px;
        color: #856404;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
</style>

<form class="form-section" id="formInicio">
    <h2 class="section-title">Portada</h2>
    
    <input type="hidden" name="id_plan" id="id_plan" value="<?=$this->d['plan']->getId()?>">
    
    <div class="form-group-custom">
        <label class="form-label-custom">
            <i class="fas fa-calendar-alt"></i>
            Vigencia Inicio
        </label>
        <div class="input-wrapper-custom">
            <i class="fas fa-calendar-alt input-icon-custom"></i>
            <input type="text" name="vigenciaInicio" id="vigenciaInicio" class="form-control-custom" placeholder="Ciclo 01-2023" value="<?= $this->d['plan']->getStartValidity() == "" ? "" : $this->d['plan']->getStartValidity()?>">
        </div>
        <small class="form-text-custom">
            <i class="fas fa-info-circle"></i>
            Ejemplo: Ciclo 01-2023
        </small>
    </div>
    
    <div class="form-group-custom">
        <label class="form-label-custom">
            <i class="fas fa-calendar-check"></i>
            Vigencia Final
        </label>
        <div class="input-wrapper-custom">
            <i class="fas fa-calendar-check input-icon-custom"></i>
            <input type="text" name="vigenciaFinal" id="vigenciaFinal" class="form-control-custom" placeholder="Ciclo 02-2027" value="<?= $this->d['plan']->getEndValidity()?>">
        </div>
        <small class="form-text-custom">
            <i class="fas fa-info-circle"></i>
            Ejemplo: Ciclo 02-2027
        </small>
    </div>
    
    <div class="form-group-custom">
        <label class="form-label-custom">
            <i class="fas fa-file-signature"></i>
            Fecha Presentación MINED
        </label>
        <div class="input-wrapper-custom">
            <i class="fas fa-file-signature input-icon-custom"></i>
            <input type="text" class="form-control-custom" name="fechaPresentacion" id="fechaPresentacion" placeholder="Marzo 2023" value="<?= $this->d['plan']->getReviewDate()?>">
        </div>
        <small class="form-text-custom">
            <i class="fas fa-info-circle"></i>
            Mes y año ejemplo: Marzo 2023
        </small>
    </div>
    
    <div class="save-reminder mb-3">
        <i class="fas fa-exclamation-triangle" style="font-size: 1.25rem;"></i>
        <span>Se recomienda guardar el avance antes de seguir a otra sección</span>
    </div>
    
    <div>
        <button type="submit" class="btn-next-section nav_link" data-bs-target="formFundamentacion">
            Siguiente Sección
            <i class="fas fa-arrow-right"></i>
        </button>
    </div>
</form>