<form action="" method="post" class="position-relative form-container" id="formAreas">
    <h2 class="text-utec text-center header-font-custom">Áreas de Desempeño</h2>
    <div class="d-flex flex-wrap-reverse justify-content-around w-75 mx-auto mt-3 mt-sm-5">
        <div class="w-100">
            <div class="mb-3">
                <div id="areas" class="mb-2">

                    <hr class="mt-2">

                    <label for="" class="text-utec font-custom">Ingrese área de desempeño:</label>
                    <input type="text" name="opcionAreas[]" class="form-control">

                    <label for="" class="text-utec font-custom">Ingrese puesto a desempeñar:</label>
                    <input type="text" name="opcionAreas[]" class="form-control">

                    <label for="" class="text-utec font-custom">Ingrese funciones del puesto:</label>
                    <textarea class="form-control" name="opcionAreas[]" style="height: 100px"></textarea>

                    <label for="" class="text-utec font-custom">Ingrese tipo de organización laboral:</label>
                    <input type="text" name="opcionAreas[]" class="form-control">

                </div>
                <button type="button" class="btn btn-outline-primary p-0 px-2 rounded-5 me-0 me-sm-2" onclick="agregarAreas()" >
                    <span class="icon profile-icon">
                        <i class="fas fa-plus"></i>
                    </span>
                </button>
                <button type="button" class="btn btn-outline-danger p-0 px-2 rounded-5" onclick="eliminarAreas()" >
                    <span class="icon profile-icon">
                        <i class="fas fa-minus"></i>
                    </span>
                </button>
            </div>
            <div class="mb-2">
                <button type="button" class="btn btn-outline-utec nav_link p-0 px-2" data-bs-target="formComEspecialidad">
                    <span class="icon profile-icon">
                        <i class="fas fa-angle-double-left"></i>
                    </span>
                </button>
                <a href="/tesis/plan/materia/<?=$this->d['plan']->getId()?>" type="button" class="btn btn-outline-utec nav_link p-0 px-2" onclick="saveInformation()">
                    <span class="icon profile-icon">
                        <i class="fas fa-angle-double-right"></i>
                    </span>
                </a>
            </div>
        </div>
        <div class="m-0 mb-3 mb-sm-0 w-custom">
            <h3 class="header-font-custom text-utec mt-2">Asignados:</h3>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody class="align-middle">
                        <?php foreach($this->d['areas'] as $key => $value) :?>
                            <tr>
                                <td class="font-custom m-0"><?= $value['area']?></td>
                                <td class="font-custom m-0"><?= $value['puesto']?></td>
                                <td class="font-custom m-0"><?= $value['funciones_puesto']?></td>
                                <td class="font-custom m-0"><?= $value['tipo_organizacion']?></td>
                                <td>
                                    <a href="#" class="btn btn-success p-0 px-2">
                                        <span class="icon profile-icon">
                                            <i class="fas fa-edit"></i>
                                        </span>
                                    </a>
                                </td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger p-0 px-2">
                                        <span class="icon profile-icon">
                                            <i class="fas fa-trash-alt"></i>
                                        </span>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</form>