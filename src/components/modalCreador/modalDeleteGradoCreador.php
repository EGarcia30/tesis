<!-- Modal -->
<div class="modal fade" id="deleteGradoCreador<?= $value['grado_id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">¿Quieres eliminar esta Grado Academico?</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p class="text-start text-break"><b><?= $value['Grados_Academicos']?></b>, Se eliminará la vinculación con este Creador.</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Regresar</button>
            <a href="/tesis/deleteGradoCreador/<?= $value['grado_id']?>/<?=$this->d['creador']->getId()?>" class="btn btn-danger">Eliminar</a>
        </div>
        </div>
    </div>
</div>