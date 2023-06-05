<!-- Modal -->
<div class="modal fade" id="updateArea<?=$value['area_id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">¿Quieres actualizar la competencia basica?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/tesis/area/plan/<?=$value['area_id']?>/<?=$this->d['plan']->getId()?>" method="post">
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="" class="font-custom">área de desempeño:</label>
                        <input type="text" name="area" class="form-control" value="<?=$value['area']?>">

                        <label for="" class="font-custom">puesto a desempeñar:</label>
                        <input type="text" name="puesto" class="form-control" value="<?=$value['puesto']?>">

                        <label for="" class="font-custom">funciones del puesto:</label>
                        <textarea class="form-control" name="funcion"><?= $value['funciones_puesto']?></textarea>

                        <label for="" class="font-custom">tipo de organización laboral:</label>
                            <div class="form-check">
                                <input class="form-check-input" name="tipo" type="checkbox" value="empresa privada" <?= strpos($value['tipo_organizacion'], 'empresa privada') !== false ? 'checked' : '' ?>>
                                <label class="form-check-label">
                                    Empresa Privada
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="tipo" type="checkbox" value="empresa publica" <?= $value['tipo_organizacion'] == 'empresa publica' ? 'checked' : ''?>>
                                <label class="form-check-label">
                                    Empresa publica
                                </label>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Regresar</button>
                    <button type="submit" class="btn btn-success">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>