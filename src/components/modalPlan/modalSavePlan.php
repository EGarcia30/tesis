<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">¿Quieres guardar?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="enviar">
                <div class="modal-body">

                <small>Guardarás hasta donde te quedaste del plan de estudio: <br> <b><?= $this->d['plan']->getNameCar()?></b></small>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Regresar</button>
                    <button type="submit" class="btn btn-success" onclick="setInformation()">Guardar Plan</button>
                </div>
            </form>
        </div>
    </div>
</div>