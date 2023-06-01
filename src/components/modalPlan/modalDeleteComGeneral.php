<!-- Modal -->
<div class="modal fade" id="deleteComGeneral<?= $value['general_id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">¿Quieres eliminar la competencia general?</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p class="text-start text-break"><b><?= $value['descripcion']?></b>, Se eliminará la vinculación con este plan de estudio.</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Regresar</button>
            <a href="/tesis/general/plan/<?= $value['general_id']?>/<?=$this->d['plan']->getId()?>" class="btn btn-danger">Eliminar</a>
        </div>
        </div>
    </div>
</div>