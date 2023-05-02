<form action="/tesis/participacion/<?= $this->d['creador']->getId()?>" method="post" class="position-relative form-container" id="formCreateParticipacion">
    <h2 class="text-utec text-center header-font-custom">Crear Nivel de Participación</h2>
    <div class="w-75 mx-auto mb-3">
        <label for="" class="text-utec font-custom">Nivel de Participación:</label>
        <input type="text" name="participacion" class="form-control" aria-describedby="helpId">
        <small id="helpId" class="form-text text-muted">Ejemplo: Desarrollador de logica de materias</small>
    </div>
    <div class="w-75 mx-auto m-2">
        <button type="submit" class="btn btn-success">Crear</button>
        <button type="button" class="btn btn-danger nav_link" data-bs-target="formParticipacion">regresar</button>
    </div>
</form>