<!-- Modal -->
<div class="modal fade" id="updateComEspecialidad<?=$value['especialidad_id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">¿Quieres actualizar la competencia de especialidad?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/tesis/especialidad/plan/<?=$value['especialidad_id']?>/<?=$this->d['plan']->getId()?>" method="post">
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="descripcion" class="font-custom">nombre competencia especialidad:</label>
                        <input type="text" class="form-control" name="descripcion" id="descripcion" value="<?= $value['descripcion']?>">
                    </div>
                    <div class="mb-2">
                        <label for="ciclo" class="font-custom">ciclo competencia especialidad:</label>
                        <input type="number" name="ciclo" id="ciclo" step="1" class="form-control" value="<?= $value['ciclo']?>">
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