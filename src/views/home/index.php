<?php require_once __DIR__ . '/../../components/header.main.php' ?>
<main id="main-content" class="w-custom">
    <div class="container mx-auto p-3 pt-5 h-custom d-flex flex-column justify-content-start justify-content-lg-center overflow-scroll">
        <div class="card mx-sm-auto bg-white p-4">
            <h2 class="text-utec text-center header-font-custom">Bienvenido: <?= $this->d['user']->getName() ?></h2>
            <p class="font-custom">En este lugar podras consultar, crear modificar y eliminar planes de estudios del año actual o anteriores,<br/>
            navega por el sistema para realizar las consultas que necesitas.    
            </p>
        </div>

        <div class="d-flex flex-column-reverse flex-md-row pt-5 justify-content-center">
            <div class="mb-4 mb-lg-0 rounded-4">
                <h3 class="font-custom pb-3 text-center m-0">Ultimos planes de estudio:</h3>
                <div class="card mx-auto bg-white p-3 p-md-4">
                    <div class="d-flex justify-content-center align-items-center bg-secondary bg-opacity-10 p-2 mb-2 rounded-4">
                        <div class="img-word">
                            <img src="<?= URL_PATH?>/img/word.png" class="img-fluid" alt="">
                        </div>
                        <p class="font-custom m-0">Tecnico en Software Plan 2018</p>
                    </div>
                    <div class="d-flex justify-content-center align-items-center bg-secondary bg-opacity-10 p-2 mb-2 rounded-4">
                        <div class="img-word">
                            <img src="<?= URL_PATH?>/img/word.png" class="img-fluid" alt="">
                        </div>
                        <p class="font-custom m-0">Tecnico en Software Plan 2018</p>
                    </div>
                    <div class="p-2">
                        <a href="/tesis/home" class="font-custom">Ver Todos...</a>
                    </div>
                </div>
            </div>
            <div>
                <div class="img-logo mt-0 mt-md-4 p-4 mx-auto">
                    <img src="<?= URL_PATH ?>/img/logo_res_utec.png" class="img-fluid" alt="">
                </div>
            </div>
            <div class="">
                <h3 class="font-custom pb-3 text-center m-0">¿Que te gustaría hacer?</h3>
                <div class="card mx-auto bg-white p-3 ms-0 ms-md-2">
                    <a href="/tesis/create" class="text-dark text-decoration-none">
                        <div class="d-flex justify-content-center justify-content-md-start align-items-center bg-secondary bg-opacity-10 p-2 mb-2 rounded-4">
                            <span class="icon profile-icon pe-2">
                                <i class="fas fa-plus"></i>
                            </span>
                            <p class="font-custom m-0">Crear nuevo plan de estudio</p>
                        </div>
                    </a>
                    <a href="/tesis/home" class="text-dark text-decoration-none">
                        <div class="d-flex justify-content-center justify-content-md-start align-items-center bg-secondary bg-opacity-10 p-2 mb-2 rounded-4">
                            <span class="icon profile-icon pe-2">
                                <i class="fas fa-search"></i>
                            </span>
                            <p class="font-custom m-0">Buscar plan de estudio</p>
                        </div>
                    </a>
                    <a href="/tesis/plan" class="text-dark text-decoration-none">
                        <div class="d-flex justify-content-center justify-content-md-start align-items-center bg-secondary bg-opacity-10 p-2 mb-2 rounded-4">
                            <span class="icon profile-icon pe-2">
                                <i class="fas fa-eye"></i>
                            </span>
                            <p class="font-custom m-0">Ver todos los planes de estudio</p>
                        </div>
                    </a>
                </div>
            </div>
        </div> 
        
    </div>
</main>
<?php require_once __DIR__ . '/../../components/footer.main.php' ?>