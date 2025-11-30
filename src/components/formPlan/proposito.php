<style>
    .textarea-counter {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 0.5rem;
        font-size: 0.85rem;
        color: #6c757d;
    }
    
    .char-counter {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .char-counter.warning {
        color: #ffc107;
    }
    
    .char-counter.danger {
        color: #dc3545;
    }
    
    .format-note {
        background: linear-gradient(135deg, #e7f3ff 0%, #d6e9ff 100%);
        border-left: 4px solid #0d6efd;
        padding: 1rem;
        border-radius: 10px;
        margin-top: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: #084298;
    }
    
    .format-note i {
        font-size: 1.25rem;
    }
</style>

<form action="" method="post" class="form-section" id="formProposito">
    <h2 class="section-title">Propósito de la Carrera</h2>
    
    <input type="hidden" name="opcionProposito[]" value="<?= $this->d['proposito'] == NULL ? 0 : $this->d['proposito']->getId()?>">
    
    <div class="form-group-custom">
        <label class="form-label-custom">
            <i class="fas fa-bullseye"></i>
            Propósito de la Carrera
        </label>
        <textarea 
            class="textarea-modern" 
            name="opcionProposito[]" 
            id="txtProposito" 
            rows="14"
            placeholder="Describe el propósito, objetivos y alcance de la carrera. Explica qué competencias desarrollará el estudiante y cómo contribuirá a su desarrollo profesional..."
            maxlength="5000"
            oninput="updateCharCounter(this)"
        ><?= $this->d['proposito'] == NULL ? '' : $this->d['proposito']->getDescripcion()?></textarea>
        
        <div class="textarea-counter">
            <small class="form-text-custom" style="padding-left: 0;">
                <i class="fas fa-info-circle"></i>
                Define claramente el propósito formativo de la carrera
            </small>
            <div class="char-counter" id="charCounter">
                <i class="fas fa-keyboard"></i>
                <span id="charCount">0</span> / 5000
            </div>
        </div>
    </div>
    
    <div class="format-note">
        <i class="fas fa-file-word"></i>
        <span>
            <strong>Nota:</strong> Los estilos de formato se aplicarán automáticamente al exportar el documento a Word.
        </span>
    </div>
    
    <div class="save-reminder">
        <i class="fas fa-exclamation-triangle"></i>
        <span>Guarda tu progreso antes de continuar a la siguiente sección</span>
    </div>
    
    <div class="navigation-buttons">
        <button type="button" class="btn-prev-section nav_link" data-bs-target="formGeneralidades">
            <i class="fas fa-arrow-left"></i>
            Anterior
        </button>
        <button type="button" class="btn-next-section nav_link" data-bs-target="formComGeneral">
            Siguiente
            <i class="fas fa-arrow-right"></i>
        </button>
    </div>
</form>

<script>
// Contador de caracteres
function updateCharCounter(textarea) {
    const charCount = textarea.value.length;
    const maxChars = parseInt(textarea.getAttribute('maxlength')) || 5000;
    const counter = document.getElementById('charCount');
    const counterContainer = document.getElementById('charCounter');
    
    if (counter) {
        counter.textContent = charCount;
        
        // Cambiar color según el límite
        counterContainer.classList.remove('warning', 'danger');
        if (charCount > maxChars * 0.9) {
            counterContainer.classList.add('danger');
        } else if (charCount > maxChars * 0.75) {
            counterContainer.classList.add('warning');
        }
    }
}

// Inicializar contador al cargar
document.addEventListener('DOMContentLoaded', function() {
    const textarea = document.getElementById('txtProposito');
    if (textarea) {
        updateCharCounter(textarea);
    }
});
</script>