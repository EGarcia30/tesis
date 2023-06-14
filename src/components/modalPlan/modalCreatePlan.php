<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">¿Quieres crear un nuevo Plan?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/tesis/planes" method="post">
                <div class="modal-body">
                    <div class="mb-5">
                        <select name="opcion" class="form-select" aria-label="Default select example">
                            <option selected>Seleccionar Facultad:</option>
                            <?php foreach($this->d['facultades'] as $key => $value) :?>
                                <option value="<?= $value['facultad_id']?>"><?=$value['nombre_facultad']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="mb-4">
                        <select name="opcionCarrera" class="form-select" aria-label="Default select example">
                            <option selected>Seleccionar Carrera:</option>
                            <?php foreach($this->d['carreras'] as $key => $value) :?>
                                <option value="<?= $value['carrera_id']?>"><?=$value['nombre_carrera']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>

                    <div class="mb-3 text-start">
                        <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Activo
                        </label>
                    </div>

                    <div class="mb-3 text-start">
                        <small class="form-text text-white">(Esta información servirá para la portada entre otras secciones, dale al boton verde para crear tu plan y ponerlo en marcha.)</small>
                    </div>

                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Regresar</button>
                    <button type="submit" class="btn btn-success">Crear Plan</button>
                </div>
            </form>
        </div>
    </div>
</div>