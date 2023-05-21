<!-- Modal -->
<div class="modal fade" id="updateExperiencia<?=$value['experiencia_id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">¿Quieres actualizar la Experiencia Profesional?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/tesis/updateExperiencia/<?=$value['experiencia_id']?>/<?=$this->d['creador']->getId()?>" method="post">
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="experiencia" class="font-custom">Experiencia Profesional:</label>
                        <input type="text" class="form-control" name="experiencia" id="experiencia" value="<?= $value['Experiencia']?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Regresar</button>
                    <button type="submit" class="btn btn-success">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>