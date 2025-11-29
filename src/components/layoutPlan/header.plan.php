<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Bootstrap y css-->
    <link rel="stylesheet" href="<?= URL_PATH ?>/css/styles.css">
    <link rel="stylesheet" href="<?= URL_PATH ?>/css/main.css">
    <<!--Select2-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.0.0/dist/select2-bootstrap-5-theme.min.css" />
    <!--ICONS-->
    <script src="https://kit.fontawesome.com/be9e926d45.js" crossorigin="anonymous"></script>
    <link rel="icon" href="<?= URL_PATH ?>/img/utec_favicon.png">
    <!--Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    <title><?= $this->d['title']. " - " . institution ?></title>

    <style>
        :root {
            --primary-color: #6d1d3c;
            --primary-dark: #541730;
            --primary-light: #8a2449;
            --gradient-primary: linear-gradient(135deg, #6d1d3c 0%, #8a2449 100%);
            --gradient-dark: linear-gradient(135deg, #541730 0%, #6d1d3c 100%);
            --shadow-sm: 0 2px 10px rgba(109, 29, 60, 0.1);
            --shadow-md: 0 4px 20px rgba(109, 29, 60, 0.15);
            --shadow-lg: 0 8px 30px rgba(109, 29, 60, 0.2);
        }
        
        /* Header Styles */
        .modern-header {
            background: var(--gradient-primary);
            box-shadow: var(--shadow-md);
            position: sticky;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(10px);
        }
        
        .header-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 1rem 1.5rem;
        }
        
        /* Menu Button */
        .menu-toggle {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.15);
            border: 2px solid rgba(255, 255, 255, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }
        
        .menu-toggle:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .menu-toggle i {
            color: white;
            font-size: 1.25rem;
            transition: transform 0.3s ease;
        }
        
        .menu-toggle:hover i {
            transform: scale(1.1);
        }
        
        .menu-toggle.active {
            background: rgba(255, 255, 255, 0.3);
        }
        
        /* Logo */
        .brand-container {
            margin-left: 1.5rem;
            transition: transform 0.3s ease;
        }
        
        .brand-container:hover {
            transform: scale(1.02);
        }
        
        .brand-container img {
            max-height: 45px;
            filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.2));
        }
        
        /* User Dropdown */
        .user-dropdown {
            position: relative;
        }
        
        .user-btn {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.15);
            border: 2px solid rgba(255, 255, 255, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }
        
        .user-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .user-btn i {
            color: white;
            font-size: 1.15rem;
        }
        
        /* Dropdown Menu Mejorado */
        .dropdown-menu {
            border: none;
            border-radius: 16px;
            box-shadow: var(--shadow-lg);
            padding: 0.5rem;
            margin-top: 0.5rem;
            min-width: 220px;
            animation: slideDown 0.3s ease;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .dropdown-item {
            border-radius: 10px;
            padding: 0.75rem 1rem;
            transition: all 0.2s ease;
            font-weight: 500;
            display: flex;
            align-items: center;
        }
        
        .dropdown-item:hover {
            background: var(--gradient-primary);
            color: white !important;
            transform: translateX(5px);
        }
        
        .dropdown-item.role-badge {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            color: var(--primary-color);
            font-weight: 600;
            cursor: default;
            margin-bottom: 0.5rem;
        }
        
        .dropdown-item.role-badge:hover {
            transform: none;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            color: var(--primary-color);
        }
        
        .dropdown-divider {
            margin: 0.5rem 0;
            border-color: rgba(109, 29, 60, 0.1);
        }
        
        /* Vertical Menu Sidebar */
        .vertical-menu {
            position: fixed;
            top: 0;
            left: 0;
            width: 320px;
            height: 100vh;
            background: white;
            box-shadow: var(--shadow-lg);
            transform: translateX(-100%);
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1100;
            overflow-y: auto;
        }
        
        .vertical-menu.active {
            transform: translateX(0);
        }
        
        .menu-header {
            background: var(--gradient-primary);
            padding: 2rem 1.5rem;
            color: white;
        }
        
        .menu-header h3 {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
        }
        
        .menu-close {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .menu-close:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(90deg);
        }
        
        .menu-content {
            padding: 1.5rem;
        }
        
        .menu-item {
            display: flex;
            align-items: center;
            padding: 1rem 1.25rem;
            margin-bottom: 0.5rem;
            border-radius: 12px;
            text-decoration: none;
            color: #2d3748;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .menu-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: var(--gradient-primary);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }
        
        .menu-item:hover {
            background: linear-gradient(135deg, rgba(109, 29, 60, 0.05) 0%, rgba(138, 36, 73, 0.05) 100%);
            color: var(--primary-color);
            transform: translateX(8px);
        }
        
        .menu-item:hover::before {
            transform: scaleY(1);
        }
        
        .menu-item i {
            width: 24px;
            margin-right: 1rem;
            font-size: 1.1rem;
        }
        
        /* Backdrop */
        .menu-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1050;
        }
        
        .menu-backdrop.active {
            opacity: 1;
            visibility: visible;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .header-container {
                padding: 1rem;
            }
            
            .brand-container {
                margin-left: 1rem;
            }
            
            .brand-container img {
                max-height: 35px;
            }
            
            .vertical-menu {
                width: 280px;
            }
        }
        
        @media (max-width: 480px) {
            .vertical-menu {
                width: 100%;
                max-width: 320px;
            }
        }
    </style>
</head>
<body class="vh-100 bg-secondary bg-opacity-10 position-relative">
    <!-- Modern Header -->
    <header class="modern-header">
        <div class="header-container">
            <div class="d-flex justify-content-between align-items-center">
                <!-- Left Section: Menu + Logo -->
                <div class="d-flex align-items-center">
                    <button class="menu-toggle" id="menuToggle" aria-label="Toggle menu">
                        <i class="fas fa-bars"></i>
                    </button>
                    
                    <div class="brand-container">
                        <img src="<?= URL_PATH ?>/img/utec_brand.png" alt="Universidad Tecnológica de El Salvador">
                    </div>
                </div>
                
                <!-- Right Section: User Dropdown -->
                <div class="user-dropdown dropdown">
                    <button class="user-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <span class="dropdown-item role-badge">
                                <i class="fas fa-id-badge me-2"></i>
                                <?= $this->d['user']->getRol() ?>
                            </span>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="/tesis/perfil">
                                <i class="fas fa-user-circle me-2"></i>
                                Mi Perfil
                            </a>
                        </li>
                        <li class="<?= $this->d['user']->getRol() == "Usuario" ? 'd-none' : '' ?>">
                            <a class="dropdown-item" href="/tesis/users/1">
                                <i class="fas fa-users-cog me-2"></i>
                                Administrar Usuarios
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="/tesis/signout">
                                <i class="fas fa-sign-out-alt me-2"></i>
                                Cerrar Sesión
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <!-- Vertical Sidebar Menu -->
    <nav class="vertical-menu" id="verticalMenu">
        <div class="menu-header d-flex justify-content-between align-items-center">
            <h3><i class="fas fa-graduation-cap me-2"></i>Menú</h3>
            <button class="menu-close" id="menuClose" aria-label="Close menu">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="menu-content">
            <a href="/tesis/home" class="menu-item">
                <i class="fas fa-home"></i>
                <span>Regresar</span>
            </a>
            
            <a href="/tesis/planes/1" class="menu-item">
                <i class="fas fa-clipboard-list"></i>
                <span>Plan de Estudio</span>
            </a>
            
            <a href="/tesis/creadores/1" class="menu-item">
                <i class="fas fa-users"></i>
                <span>Especialistas / Creadores</span>
            </a>
        </div>
    </nav>

    <!-- Menu Backdrop -->
    <div class="menu-backdrop" id="menuBackdrop"></div>

    <script>
        // Menu Toggle Functionality (Reutilizable desde main.css)
        const menuToggle = document.getElementById('menuToggle');
        const menuClose = document.getElementById('menuClose');
        const verticalMenu = document.getElementById('verticalMenu');
        const menuBackdrop = document.getElementById('menuBackdrop');
        
        function openMenu() {
            verticalMenu.classList.add('active');
            menuBackdrop.classList.add('active');
            menuToggle.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
        
        function closeMenu() {
            verticalMenu.classList.remove('active');
            menuBackdrop.classList.remove('active');
            menuToggle.classList.remove('active');
            document.body.style.overflow = '';
        }
        
        menuToggle.addEventListener('click', openMenu);
        menuClose.addEventListener('click', closeMenu);
        menuBackdrop.addEventListener('click', closeMenu);
        
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && verticalMenu.classList.contains('active')) {
                closeMenu();
            }
        });
        
        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', closeMenu);
        });
    </script>