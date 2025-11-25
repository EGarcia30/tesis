<?php require_once __DIR__ . '/../../components/layoutPrincipal/header.main.php' ?>

<main id="main-content" class="main-gradient">
    <div class="container mx-auto p-3">
        <!-- Welcome Section -->
        <div class="welcome-card mx-auto p-4 p-md-5 text-center mb-4 mb-md-5" style="max-width: 900px;">
            <h1 class="gradient-text" style="font-size: 2.5rem; margin-bottom: 0.5rem;">
                ¡Bienvenido!
            </h1>
            <h2 class="text-dark fw-bold mb-3" style="font-size: 1.75rem;">
                <?= $this->d['user']->getName() ?>
            </h2>
            <p class="text-muted" style="font-size: 1.1rem; line-height: 1.6; max-width: 700px; margin: 0 auto;">
                Gestiona los planes de estudio de forma eficiente. Consulta, crea, modifica y elimina planes académicos con una interfaz moderna e intuitiva.
            </p>
        </div>

        <!-- Main Content Grid -->
        <div class="row g-3 g-md-4">
            <!-- Actions Section -->
            <div class="col-12 col-lg-4 order-1 order-lg-1 mb-4 mb-lg-0">
                <h3 class="section-title">Acciones Rápidas</h3>
                <div class="d-flex flex-column action-card gap-3">
                    <a href="/tesis/planes/1" class="text-decoration-none">
                        <div class="action-item">
                            <div class="d-flex align-items-center">
                                <div class="icon-wrapper icon-view me-3">
                                    <i class="fas fa-eye"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="text-dark fw-semibold m-0" style="font-size: 1rem;">
                                        Ver todos los planes
                                    </p>
                                    <small class="text-muted d-block">Explora el catálogo completo</small>
                                </div>
                            </div>
                        </div>
                    </a>
                    
                    <a href="/tesis/planes/1" class="text-decoration-none">
                        <div class="action-item">
                            <div class="d-flex align-items-center">
                                <div class="icon-wrapper icon-search me-3">
                                    <i class="fas fa-search"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="text-dark fw-semibold m-0" style="font-size: 1rem;">
                                        Buscar plan específico
                                    </p>
                                    <small class="text-muted d-block">Encuentra rápidamente</small>
                                </div>
                            </div>
                        </div>
                    </a>
                    
                    <a href="/tesis/planes/1" class="text-decoration-none">
                        <div class="action-item">
                            <div class="d-flex align-items-center">
                                <div class="icon-wrapper icon-plus me-3">
                                    <i class="fas fa-plus"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="text-dark fw-semibold m-0" style="font-size: 1rem;">
                                        Crear nuevo plan
                                    </p>
                                    <small class="text-muted d-block">Diseña un plan de estudio</small>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Logo Section -->
            <div class="col-12 col-lg-4 order-3 order-lg-2 d-flex align-items-center justify-content-center mb-4 mb-lg-0">
                <div class="logo-container">
                    <img src="<?= URL_PATH ?>/img/logo_res_utec.png" class="img-fluid" alt="UTEC Logo">
                </div>
            </div>

            <!-- Recent Plans Section -->
            <div class="col-12 col-lg-4 order-2 order-lg-3 mb-4 mb-lg-0">
                <h3 class="section-title">Planes Recientes</h3>
                <div class="recent-card">
                    <div class="recent-item">
                        <div class="d-flex align-items-center">
                            <div class="doc-icon me-3">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div class="flex-grow-1">
                                <p class="text-dark fw-semibold m-0" style="font-size: 0.95rem;">
                                    Técnico en Software
                                </p>
                                <small class="text-muted d-block">Plan 2018</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="recent-item">
                        <div class="d-flex align-items-center">
                            <div class="doc-icon me-3">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div class="flex-grow-1">
                                <p class="text-dark fw-semibold m-0" style="font-size: 0.95rem;">
                                    Técnico en Software
                                </p>
                                <small class="text-muted d-block">Plan 2018</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center mt-3 pt-2">
                        <a href="/tesis/planes/1" class="view-all-link text-decoration-none">
                            Ver todos los planes <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../../components/layoutPrincipal/footer.main.php' ?>