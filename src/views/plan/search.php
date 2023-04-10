<?php require_once __DIR__ . '/../../components/header.main.php' ?>
<main id="main-content" class="w-custom">
    <div class="w-100 position-relative">
        <div class="d-flex flex-column gap-4 container mx-auto p-3">
            <div class="d-flex flex-wrap gap-2 text-center">
                <a href="/tesis/plan" class="btn btn-utec">Regresar</a>
                <a href="/tesis/create" class="btn btn-primary">Crear nuevo Plan</a>
                <form action="/tesis/plan" method="post" class="w-75 d-flex">
                    <input type="text" name="buscar" class="form-control">
                    <div>
                        <button type="submit" class="btn btn-utec ms-0 ms-sm-2">
                            <span class="icon search-icon">
                                <i class="fas fa-search"></i>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
            <div class="table-responsive table-height text-center rounded-2">
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Titulo</th>
                            <th scope="col">Descargar</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php foreach($this->d['studyPlan'] as $key => $value) :?>
                            <tr >
                                <td scope="row"><?= $value['documento_id'] ?></td>
                                <td><?= $value['titulo'] ?></td>
                                <td><a href="/tesis/word/<?= $value['documento_id'] ?>" class="btn btn-utec">
                                        <div class="img-word">
                                            <img src="<?= URL_PATH ?>/img/word.png" class="img-fluid" alt="">
                                        </div>
                                    </a>
                                </td>
                                <td><a href="/tesis/update/<?= $value['documento_id'] ?>" class="btn btn-success">Editar</a></td>
                                <td>
                                    <a href="/tesis/delete/<?= $value['documento_id'] ?>" class="btn btn-danger">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            
        </div>
    </div>
</main>
<?php require_once __DIR__ . '/../../components/footer.main.php' ?>