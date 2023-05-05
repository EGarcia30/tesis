<form action="" method="post" class="position-relative form-container" id="formGeneralidades">
    <h2 class="text-utec text-center header-font-custom">Generalidades de la carrera</h2>
    <div class="w-75 mx-auto mb-3">
        <input type="hidden" name="opcionGeneralidad[]" value="<?= $this->d['generalidad'] == NULL ? 0 : $this->d['generalidad']->getId() ?>">
        <p class="font-custom m-2 ms-0">
            Nombre de la Carrera: <?= $this->d['plan']->getNameCar()?>
        </p>
        <label for="requisito" class="text-utec font-custom">Requisito de Ingreso:</label>
        <input type="text" name="opcionGeneralidad[]" id="requisito" class="form-control" placeholder="Ejemplo: Bachillerato" value="<?= $this->d['generalidad'] == NULL ? '' : $this->d['generalidad']->getRequisito() ?>">

        <p class="font-custom m-2 ms-0">
            Titulo a otorgar: <?= $this->d['plan']->getNameCar()?>
        </p>

        <label for="duracionAnios" class="text-utec font-custom">Duracion en años:</label>
        <input type="number" name="opcionGeneralidad[]" id="duracionAnios" class="form-control" placeholder="Ejemplo: 2" step="1" value="<?= $this->d['generalidad'] == NULL ? '' : $this->d['generalidad']->getYears() ?>">
        <br>
        <label for="duracionCiclos" class="text-utec font-custom">Duracion en ciclos:</label>
        <input type="number" name="opcionGeneralidad[]" id="duracionCiclos" class="form-control" placeholder="Ejemplo: 2" step="1" value="<?= $this->d['generalidad'] == NULL ? '' : $this->d['generalidad']->getCiclos() ?>">
        <br>
        <label for="numAsignatura" class="text-utec font-custom">Numero de Asignaturas:</label>
        <input type="number" name="opcionGeneralidad[]" id="numAsignatura" class="form-control" placeholder="Ejemplo: 2" step="1" value="<?= $this->d['generalidad'] == NULL ? '' : $this->d['generalidad']->getAsignatura() ?>">
        <br>
        <label for="unidadesValorativas" class="text-utec font-custom">Numero de Unidades Valorativas:</label>
        <input type="number" name="opcionGeneralidad[]" id="unidadesValorativas" class="form-control" placeholder="Ejemplo: 2" step="1" value="<?= $this->d['generalidad'] == NULL ? '' : $this->d['generalidad']->getValorativas() ?>">
        <p class="font-custom m-2 ms-0">
            Modalidad de Entrega: <?= $this->d['plan']->getModalityCar()?>
        </p>

        <label for="sede" class="text-utec font-custom">Sede donde se impartirá:</label>
        <input type="text" name="opcionGeneralidad[]" id="sede" class="form-control" placeholder="Ejemplo: Universidad Tecnógica de El Salvador" value="<?= $this->d['generalidad'] == NULL ? '' : $this->d['generalidad']->getSede() ?>">
        <br>
        <label for="responsable" class="text-utec font-custom">Unidad Responsable:</label>
        <input type="text" name="opcionGeneralidad[]" id="responsable" class="form-control" placeholder="Ejemplo: Facultad de Informatica" value="<?= $this->d['generalidad'] == NULL ? '' : $this->d['generalidad']->getResponsible()?>">

        <p class="font-custom m-2 ms-0">
            Ciclo de Inicio: <?= $this->d['plan']->getStartValidity()?>
        </p>

        <label for="inicio" class="text-utec font-custom">Año de Inicio:</label>
        <input type="number" name="opcionGeneralidad[]" id="inicio" class="form-control" placeholder="Ejemplo: 2" step="1" value="<?= $this->d['generalidad'] == NULL ? '' : $this->d['generalidad']->getInicio() ?>">

        <p class="font-custom m-2 ms-0">
            Vigencia del Plan: <?= $this->d['plan']->getStartValidity()?> - <?= $this->d['plan']->getEndValidity()?> 
        </p>
    </div>
    <div class="w-75 mx-auto m-2">
        <button type="button" class="btn btn-outline-utec nav_link p-0 px-2" data-bs-target="formCreador">
            <span class="icon profile-icon">
                <i class="fas fa-angle-double-left"></i>
            </span>
        </button>
        <button type="button" class="btn btn-outline-utec nav_link p-0 px-2" data-bs-target="formProposito">
            <span class="icon profile-icon">
                <i class="fas fa-angle-double-right"></i>
            </span>
        </button>
    </div>
</form>