<!-- Modal -->
<div class="modal fade" id="updateParticipacion<?=$value['participacion_id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">¿Quieres actualizar la participación?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/tesis/updateParticipacion/<?=$value['participacion_id']?>/<?=$this->d['creador']->getId()?>" method="post">
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="participacion" class="font-custom">Participación:</label>
                        <input type="text" class="form-control" name="participacion" id="participacion" value="<?= $value['descripcion']?>">
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