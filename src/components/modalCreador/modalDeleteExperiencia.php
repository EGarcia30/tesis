<!-- Modal -->
<div class="modal fade" id="deleteExperiencia<?= $value['experiencia_id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">¿Quieres eliminar esta Experiencia Profesional?</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p class="text-start text-break"><b><?= $value['Experiencia']?></b>, Se eliminará al apretar el boton rojo.</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Regresar</button>
            <a href="/tesis/deleteExperiencia/<?= $value['experiencia_id']?>/<?=$this->d['creador']->getId()?>" class="btn btn-danger">Eliminar</a>
        </div>
        </div>
    </div>
</div>