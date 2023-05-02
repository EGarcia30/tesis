<form action="/tesis/grado/<?= $this->d['creador']->getId()?>" method="post" class="position-relative form-container" id="formCreateGrado">
    <h2 class="text-utec text-center header-font-custom">Crear Grado Academico</h2>
    <div class="w-75 mx-auto mb-3">
        <label for="" class="text-utec font-custom">Grado Academico:</label>
        <input type="text" name="gradoAcademico" class="form-control" aria-describedby="helpId">
        <small id="helpId" class="form-text text-muted">Ejemplo: Ingenierio en Sistemas Informaticos</small>
    </div>
    <div class="w-75 mx-auto m-2">
        <button type="submit" class="btn btn-success">Crear</button>
        <button type="button" class="btn btn-danger nav_link" data-bs-target="formInicio">regresar</button>
    </div>
</form>