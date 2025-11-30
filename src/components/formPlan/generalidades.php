<style>
    .info-display {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-left: 4px solid #6d1d3c;
        padding: 0.75rem 1rem;
        border-radius: 10px;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .info-display i {
        color: #6d1d3c;
        font-size: 1.1rem;
    }
    
    .info-display strong {
        color: #6d1d3c;
        margin-right: 0.5rem;
    }
    
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }
    
    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
            gap: 0;
        }
    }
</style>

<form action="" method="post" class="form-section" id="formGeneralidades">
    <h2 class="section-title">Generalidades de la Carrera</h2>
    
    <input type="hidden" name="opcionGeneralidad[]" value="<?= $this->d['generalidad'] == NULL ? 0 : $this->d['generalidad']->getId() ?>">
    
    <!-- Información de la Carrera -->
    <div class="info-display">
        <i class="fas fa-graduation-cap"></i>
        <span><strong>Nombre de la Carrera:</strong> <?= $this->d['plan']->getNameCar()?></span>
    </div>
    
    <!-- Requisito de Ingreso -->
    <div class="form-group-custom">
        <label class="form-label-custom">
            <i class="fas fa-clipboard-check"></i>
            Requisito de Ingreso
        </label>
        <div class="input-wrapper-custom">
            <i class="fas fa-clipboard-check input-icon-custom"></i>
            <input type="text" name="opcionGeneralidad[]" id="requisito" class="form-control-custom" placeholder="Ejemplo: Bachillerato" value="<?= $this->d['generalidad'] == NULL ? '' : $this->d['generalidad']->getRequisito() ?>">
        </div>
    </div>
    
    <!-- Título a Otorgar -->
    <div class="info-display">
        <i class="fas fa-certificate"></i>
        <span><strong>Título a Otorgar:</strong> <?= $this->d['plan']->getNameCar()?></span>
    </div>
    
    <!-- Duración - Grid de 2 columnas -->
    <div class="form-row">
        <div class="form-group-custom">
            <label class="form-label-custom">
                <i class="fas fa-calendar-alt"></i>
                Duración en Años
            </label>
            <div class="input-wrapper-custom">
                <i class="fas fa-calendar-alt input-icon-custom"></i>
                <input type="number" name="opcionGeneralidad[]" id="duracionAnios" class="form-control-custom" placeholder="Ej: 2" step="1" min="1" value="<?= $this->d['generalidad'] == NULL ? '' : $this->d['generalidad']->getYears() ?>">
            </div>
        </div>
        
        <div class="form-group-custom">
            <label class="form-label-custom">
                <i class="fas fa-calendar"></i>
                Duración en Ciclos
            </label>
            <div class="input-wrapper-custom">
                <i class="fas fa-calendar input-icon-custom"></i>
                <input type="number" name="opcionGeneralidad[]" id="duracionCiclos" class="form-control-custom" placeholder="Ej: 4" step="1" min="1" value="<?= $this->d['generalidad'] == NULL ? '' : $this->d['generalidad']->getCiclos() ?>">
            </div>
        </div>
    </div>
    
    <!-- Asignaturas y Unidades - Grid de 2 columnas -->
    <div class="form-row">
        <div class="form-group-custom">
            <label class="form-label-custom">
                <i class="fas fa-book"></i>
                Número de Asignaturas
            </label>
            <div class="input-wrapper-custom">
                <i class="fas fa-book input-icon-custom"></i>
                <input type="number" name="opcionGeneralidad[]" id="numAsignatura" class="form-control-custom" placeholder="Ej: 30" step="1" min="1" value="<?= $this->d['generalidad'] == NULL ? '' : $this->d['generalidad']->getAsignatura() ?>">
            </div>
        </div>
        
        <div class="form-group-custom">
            <label class="form-label-custom">
                <i class="fas fa-star"></i>
                Unidades Valorativas
            </label>
            <div class="input-wrapper-custom">
                <i class="fas fa-star input-icon-custom"></i>
                <input type="number" name="opcionGeneralidad[]" id="unidadesValorativas" class="form-control-custom" placeholder="Ej: 120" step="1" min="1" value="<?= $this->d['generalidad'] == NULL ? '' : $this->d['generalidad']->getValorativas() ?>">
            </div>
        </div>
    </div>
    
    <!-- Modalidad de Entrega -->
    <div class="info-display">
        <i class="fas fa-chalkboard-teacher"></i>
        <span><strong>Modalidad de Entrega:</strong> <?= $this->d['plan']->getModalityCar()?></span>
    </div>
    
    <!-- Sede -->
    <div class="form-group-custom">
        <label class="form-label-custom">
            <i class="fas fa-map-marker-alt"></i>
            Sede donde se Impartirá
        </label>
        <div class="input-wrapper-custom">
            <i class="fas fa-map-marker-alt input-icon-custom"></i>
            <input type="text" name="opcionGeneralidad[]" id="sede" class="form-control-custom" placeholder="Universidad Tecnológica de El Salvador" value="<?= $this->d['generalidad'] == NULL ? '' : $this->d['generalidad']->getSede() ?>">
        </div>
    </div>
    
    <!-- Unidad Responsable -->
    <div class="form-group-custom">
        <label class="form-label-custom">
            <i class="fas fa-university"></i>
            Unidad Responsable
        </label>
        <div class="input-wrapper-custom">
            <i class="fas fa-university input-icon-custom"></i>
            <input type="text" name="opcionGeneralidad[]" id="responsable" class="form-control-custom" placeholder="Facultad de Informática y Ciencias Aplicadas" value="<?= $this->d['generalidad'] == NULL ? '' : $this->d['generalidad']->getResponsible()?>">
        </div>
    </div>
    
    <!-- Ciclo de Inicio -->
    <div class="info-display">
        <i class="fas fa-calendar-check"></i>
        <span><strong>Ciclo de Inicio:</strong> <?= $this->d['plan']->getStartValidity()?></span>
    </div>
    
    <!-- Año de Inicio -->
    <div class="form-group-custom">
        <label class="form-label-custom">
            <i class="fas fa-calendar-day"></i>
            Año de Inicio
        </label>
        <div class="input-wrapper-custom">
            <i class="fas fa-calendar-day input-icon-custom"></i>
            <input type="number" name="opcionGeneralidad[]" id="inicio" class="form-control-custom" placeholder="Ej: 2023" step="1" min="2000" max="2100" value="<?= $this->d['generalidad'] == NULL ? '' : $this->d['generalidad']->getInicio() ?>">
        </div>
    </div>
    
    <!-- Vigencia del Plan -->
    <div class="info-display">
        <i class="fas fa-clock"></i>
        <span><strong>Vigencia del Plan:</strong> <?= $this->d['plan']->getStartValidity()?> - <?= $this->d['plan']->getEndValidity()?></span>
    </div>
    
    <!-- Recordatorio de Guardado -->
    <div class="save-reminder">
        <i class="fas fa-exclamation-triangle"></i>
        <span>Recuerda guardar los cambios antes de continuar a la siguiente sección</span>
    </div>
    
    <!-- Navegación -->
    <div class="navigation-buttons">
        <button type="button" class="btn-prev-section nav_link" data-bs-target="formCreador">
            <i class="fas fa-arrow-left"></i>
            Anterior
        </button>
        <button type="button" class="btn-next-section nav_link" data-bs-target="formProposito">
            Siguiente
            <i class="fas fa-arrow-right"></i>
        </button>
    </div>
</form>