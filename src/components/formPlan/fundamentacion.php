<form action="" method="post" class="position-relative form-container" id="formFundamentacion">
    <h2 class="text-utec text-center header-font-custom">Fundamentación</h2>
    <div class="w-75 mx-auto mb-3">
        <p class="font-custom">
            La Universidad Tecnológica de El Salvador presenta a la sociedad la carrera de<br>
            <?=$this->d['plan']->getNameCar()?>, para formar con estrategias de entrega <br>
            <?=$this->d['plan']->getModalityCar()?>, 
        </p>
        <label for="" class="text-utec font-custom">Seguir el texto con el apartado de fundamentacion:</label>
        <textarea class="form-control" name="txtFundamentacion" id="txtFundamentacion" rows="6"><?=$this->d['plan']->getFundamentacion()?></textarea>
        <p class="font-custom">
            Con la estrategia de entrega <?=$this->d['plan']->getModalityCar()?>, se podrán eliminar barreras fronterizas y<br>
            se contribuirá al cumplimiento de la Misión Institucional, en la cual se establece que<br>
            "La Universidad Tecnológica de El Salvador existe para brindar a amplios sectores<br>
            poblacionales, innovadores servicios educativos".
        </p>
    </div>
    <div class="w-75 mx-auto m-2">
        <button type="button" class="btn btn-outline-utec nav_link p-0 px-2" data-bs-target="formInicio">
            <span class="icon profile-icon">
                <i class="fas fa-angle-double-left"></i>
            </span>
        </button>
        <button type="button" class="btn btn-outline-utec nav_link p-0 px-2" data-bs-target="formCreador">
            <span class="icon profile-icon">
                <i class="fas fa-angle-double-right"></i>
            </span>
        </button>
    </div>
</form>