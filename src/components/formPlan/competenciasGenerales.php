<form action="" method="post" class="position-relative form-container" id="formComGeneral">
    <h2 class="text-utec text-center header-font-custom">Competencias Generales</h2>
    <div class="d-flex flex-wrap-reverse justify-content-around w-75 mx-auto mt-3 mt-sm-5">
        <div>
            <div class="mb-3">
                <div id="comGeneral">
                    <label for="" class="text-utec font-custom">Ingrese Competencia General:</label>
                    <input type="text" name="opcionCompetencia[]" class="form-control">

                    <label for="" class="text-utec font-custom">Ingrese en que ciclo se cumple:</label>
                    <input type="number" name="opcionCompetencia[]" step="1" class="form-control">
                    <p class="text-utec font-custom">Los números pasarán a romanos en el documento de Word.</p>
                </div>
                <button type="button" class="btn btn-outline-primary p-0 px-2" onclick="agregarComGeneral()" >
                    <span class="icon profile-icon">
                        <i class="fas fa-plus"></i>
                    </span>
                </button>
            </div>
            <div class="mb-2">
                <button type="button" class="btn btn-outline-utec nav_link p-0 px-2" data-bs-target="formProposito">
                    <span class="icon profile-icon">
                        <i class="fas fa-angle-double-left"></i>
                    </span>
                </button>
                <button type="button" class="btn btn-outline-utec nav_link p-0 px-2" data-bs-target="formComBasico">
                    <span class="icon profile-icon">
                        <i class="fas fa-angle-double-right"></i>
                    </span>
                </button>
            </div>
        </div>
        <div class="mb-3 mb-sm-0">
            <h3 class="header-font-custom text-utec mt-2">Asignados:</h3>
            <table class="table table-bordered">
                <?php foreach($this->d['comGeneral'] as $key => $value) :?>
                    <tr>
                        <td class="font-custom m-0"><?= $value['descripcion']?></td>
                        <td class="font-custom m-0">Ciclo: <?= $value['ciclo']?></td>
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
</form>