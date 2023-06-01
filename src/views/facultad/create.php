<?php require_once __DIR__ . '/../../components/layoutPrincipal/header.main.php' ?>
<main id="main-content" class="w-custom">
    <div class="w-100 position-relative">
        <div class="d-flex flex-column gap-4 container mx-auto p-3">
            <div class="d-flex flex-wrap gap-2 text-center">
                <a href="/tesis/facultades/1" class="btn btn-utec">Regresar</a>
            </div>

            <div class="position-absolute end-0 top-0 mt-1">
                <?php require __DIR__ . '/../../components/alerts.php'; ?>
            </div>

            <div class="card card-height container p-3 bg-white">
                <h1 class="header-font-custom text-utec text-center">Crear Facultad</h1>
                <form action="/tesis/createFacultad" method="post" class="p-2">
                    <div class="mb-3">
                        <label for="" class="form-label text-utec">Nombre:</label>
                        <input type="text"
                        class="form-control" name="nombre" id="nombre" aria-describedby="helpId">
                        <small id="helpId" class="form-text text-muted">Ejemplo: Facultad de Informática y Ciencias Aplicadas</small>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Acronimo</label>
                        <input type="text"
                            class="form-control" name="acronimo" id="" aria-describedby="helpId">
                        <small id="helpId" class="form-text text-muted">ejemplo: FICA</small>
                    </div>

                    <div class="mt-5">
                        <input type="submit" class="btn btn-utec" value="Crear facultad">
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<?php require_once __DIR__ . '/../../components/layoutPrincipal/footer.main.php' ?>