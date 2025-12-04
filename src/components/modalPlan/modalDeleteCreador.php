<!-- Modal -->
<div class="modal fade" id="deleteCreadorPlan<?= $value['creador_id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">¿Quieres desvincular el creador del plan de estudio?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-start text-break"><b><?= $value['Creador']?></b>, Se eliminará la vinculación con este plan de estudio.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Regresar</button>
                <button type="button" class="btn btn-danger btn-eliminar" 
                        data-creador-id="<?= $value['creador_id']?>" 
                        data-plan-id="<?= $this->d['plan']->getId()?>">
                    Eliminar
                </button>
            </div>
        </div>
    </div>
</div>