<div class="position-relative" id="formMaterias">
    <h2 class="text-utec text-center header-font-custom">Ciclo Extraordinario</h2>
    <div class="d-flex flex-column w-75 mx-auto mt-3 mt-sm-5">
        <form action="/tesis/plan/extraordinario/<?= $this->d['plan']->getId()?>" method="post" class="position-relative">
            <div class="guardar">
                <button type="submit" class="btn btn-success">
                    <span class="icon profile-icon">
                        <i class="fas fa-save"></i>
                    </span>
                </button>
            </div>
            <div id="materias">
                <div class="mb-3 border border-utec p-3 rounded">
                    <div class="mb-3">
                        <label for="" class="form-label text-utec font-custom">Ciclo en que se impartira la materia:</label>
                        <input type="number"
                        class="form-control" name="ciclo[]" id="" aria-describedby="helpId" step="1">
                        <small id="helpId" class="form-text text-muted">Ejemplo: 1</small>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-utec font-custom">Nombre Asignatura:</label>
                        <input type="text"
                        class="form-control" name="ciclo[]" id="" aria-describedby="helpId">
                        <small id="helpId" class="form-text text-muted">Ejemplo: Algoritmo I</small>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-utec font-custom">No. de orden:</label>
                        <input type="number"
                        class="form-control" name="ciclo[]" id="" aria-describedby="helpId" step="1">
                        <small id="helpId" class="form-text text-muted">Ejemplo: 1</small>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-utec font-custom">Codigo de Asignatura:</label>
                        <input type="text"
                        class="form-control" name="ciclo[]" id="" aria-describedby="helpId">
                        <small id="helpId" class="form-text text-muted">Ejemplo: ALG1-E</small>
                    </div>
                    <div class="mb-3">
                        <p class="text-utec font-custom">Areas de formación:</p>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ciclo[]" value="AB">
                            <label class="form-check-label" for="">
                                Area Basica
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ciclo[]" value="AG" >
                            <label class="form-check-label" for="">
                                Area General
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ciclo[]" value="AE">
                            <label class="form-check-label" for="">
                                Area de Especialidad
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-utec font-custom">Prerrequisitos:</label>
                        <div id="selectsPrerrequisito" class="mb-2">
                            <select class="form-select form-select-lg" name="prerrequisito[]" id="">
                                <option selected>Seleccionar</option>
                                <option value="br">Bachiller</option>
                                <?php foreach($this->d['materias'] as $key => $value) :?>
                                <option value="<?= $value['materia_id']?>"><?= $value['nombre_asignatura']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <button type="button" class="btn btn-outline-primary p-0 px-2 mt-2 rounded-5" onclick="agregarPrerrequisito()" >
                            <span class="icon profile-icon">
                                <i class="fas fa-plus"></i>
                            </span>
                        </button>
                        <button type="button" class="btn btn-outline-danger p-0 px-2 mt-2 rounded-5" onclick="eliminarPrerrequisito()" >
                            <span class="icon profile-icon">
                                <i class="fas fa-minus"></i>
                            </span>
                        </button>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-utec font-custom">Horas totales del ciclo:</label>
                        <input type="number"
                        class="form-control" name="ciclo[]" id="" aria-describedby="helpId" step="1">
                        <small id="helpId" class="form-text text-muted">Ejemplo: 90</small>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-utec font-custom">Horas teóricas semanales:</label>
                        <input type="number"
                        class="form-control" name="ciclo[]" id="" aria-describedby="helpId" step="1">
                        <small id="helpId" class="form-text text-muted">Ejemplo: 2</small>
                    </div>
                    <div class="mb-3">
                        <p class="text-utec font-custom">Tipo:</p>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ciclo[]" value="presencial">
                            <label class="form-check-label" for="">
                                Presencial
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ciclo[]" value="no presencial">
                            <label class="form-check-label" for="">
                                No presencial
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-utec font-custom">Horas teóricas practicas:</label>
                        <input type="number"
                        class="form-control" name="ciclo[]" id="" aria-describedby="helpId" step="1">
                        <small id="helpId" class="form-text text-muted">Ejemplo: 2</small>
                    </div>
                    <div class="mb-3">
                        <p class="text-utec font-custom">Tipo:</p>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ciclo[]" value="presencial">
                            <label class="form-check-label" for="">
                                Presencial
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="ciclo[]" value="no presencial">
                            <label class="form-check-label" for="">
                                No presencial
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-utec font-custom">Unidades valorativas:</label>
                        <input type="number"
                        class="form-control" name="ciclo[]" id="" aria-describedby="helpId" step="1">
                        <small id="helpId" class="form-text text-muted">Ejemplo: 4</small>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>