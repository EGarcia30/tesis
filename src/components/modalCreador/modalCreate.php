<!-- Modal -->
<div class="modal fade" id="especialistaCreador" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">¿Quieres crear un nuevo Especialista/Creador?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/tesis/creador" method="post">
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="nombre" class="font-custom">Nombre Completo del creador:</label>
                        <input type="text"
                        class="form-control" name="nombre" id="nombre" aria-describedby="helpId">
                        <small id="helpId" class="form-text text-muted">Ejemplo: Erick Adalberto Penado Garcia</small>
                    </div>

                    <div class="mb-3 text-start">
                        <small class="form-text text-white">(Esta información servirá para la sección de creadores en el doc de word)</small>
                    </div>

                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Regresar</button>
                    <button type="submit" class="btn btn-success">Crear</button>
                </div>
            </form>
        </div>
    </div>
</div>