<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Bootstrap y css-->
    <link rel="stylesheet" href="<?= URL_PATH ?>/css/styles.css">
    <!--ICONS-->
    <script src="https://kit.fontawesome.com/be9e926d45.js" crossorigin="anonymous"></script>
    <link rel="icon" href="<?= URL_PATH ?>/img/utec_favicon.png">
    <!--Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <title>Iniciar Sesión - <?= institution ?></title>
    
    <style>
        :root {
            --primary-color: #6d1d3c;
            --primary-dark: #541730;
            --primary-light: #8a2449;
            --primary-gradient: linear-gradient(135deg, #6d1d3c 0%, #8a2449 100%);
            --card-shadow: 0 15px 50px rgba(109, 29, 60, 0.2);
            --hover-shadow: 0 20px 60px rgba(109, 29, 60, 0.3);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
            overflow: hidden;
        }
        
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;           
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }
        
        .login-container::before {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(109, 29, 60, 0.1) 0%, transparent 70%);
            top: -200px;
            right: -200px;
            border-radius: 50%;
        }
        
        .login-container::after {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(138, 36, 73, 0.08) 0%, transparent 70%);
            bottom: -150px;
            left: -150px;
            border-radius: 50%;
        }
        
        .login-card {
            background: white;
            border-radius: 24px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            max-width: 1000px;
            width: 100%;
            position: relative;
            z-index: 1;
            backdrop-filter: blur(10px);
        }
        
        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: var(--primary-gradient);
        }
        
        .logo-section {
            background: var(--primary-gradient);
            padding: 3rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        
        .logo-section::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            top: -100px;
            right: -100px;
            border-radius: 50%;
        }
        
        .logo-wrapper {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            animation: float 3s ease-in-out infinite;
            position: relative;
            z-index: 1;
        }
        
        .logo-wrapper img {
            width: 100%;
            max-width: 250px;
            height: auto;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }
        
        .welcome-text {
            color: white;
            margin-top: 2rem;
            text-align: center;
            font-size: 1.2rem;
            font-weight: 500;
            position: relative;
            z-index: 1;
        }
        
        .form-section {
            padding: 3rem 2.5rem;
        }
        
        .login-title {
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 800;
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            text-align: center;
        }
        
        .login-subtitle {
            color: #6c757d;
            text-align: center;
            margin-bottom: 2rem;
            font-weight: 500;
        }
        
        .form-group-modern {
            margin-bottom: 1.75rem;
            position: relative;
        }
        
        .form-label-modern {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.95rem;
        }
        
        .input-wrapper {
            position: relative;
        }
        
        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-color);
            font-size: 1.1rem;
            z-index: 1;
        }
        
        .form-control-modern {
            border: 2px solid rgba(109, 29, 60, 0.15);
            border-radius: 14px;
            padding: 0.9rem 1rem 0.9rem 3rem;
            transition: all 0.3s ease;
            font-size: 1rem;
            width: 100%;
        }
        
        .form-control-modern:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(109, 29, 60, 0.15);
            outline: none;
            transform: translateY(-2px);
        }
        
        .btn-login {
            background: var(--primary-gradient);
            color: white;
            border: none;
            border-radius: 14px;
            padding: 1rem;
            font-weight: 700;
            font-size: 1.1rem;
            width: 100%;
            transition: all 0.3s ease;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 2rem;
        }
        
        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(109, 29, 60, 0.4);
        }
        
        .btn-login:active {
            transform: translateY(-1px);
        }
        
        .alert-container {
            margin-top: 1.5rem;
        }
        
        @media (max-width: 768px) {
            .login-container {
                padding: 1rem;
            }
            
            .logo-section {
                padding: 2rem 1.5rem;
            }
            
            .logo-wrapper {
                padding: 1.5rem;
            }
            
            .logo-wrapper img {
                max-width: 180px;
            }
            
            .welcome-text {
                font-size: 1rem;
                margin-top: 1.5rem;
            }
            
            .form-section {
                padding: 2rem 1.5rem;
            }
            
            .login-title {
                font-size: 2rem;
            }
            
            .form-control-modern {
                padding: 0.8rem 1rem 0.8rem 2.75rem;
            }
            
            .btn-login {
                padding: 0.9rem;
                font-size: 1rem;
            }
        }
        
        @media (max-width: 576px) {
            .login-card {
                border-radius: 20px;
            }
            
            .form-section {
                padding: 1.75rem 1.25rem;
            }
            
            .login-title {
                font-size: 1.75rem;
            }
            
            .logo-wrapper img {
                max-width: 150px;
            }
        }
    </style>
</head>
<body class="">
    <main class="w-100 bg-image login-container">
        <div class="login-card">
            <div class="row g-0">
                <!-- Logo Section -->
                <div class="col-md-5">
                    <div class="logo-section h-100">
                        <div class="logo-wrapper">
                            <img src="<?= URL_PATH ?>/img/utec_logo.png" alt="UTEC Logo">
                        </div>
                        <p class="welcome-text">
                            Sistema de Gestión de<br>Planes de Estudio
                        </p>
                    </div>
                </div>
                
                <!-- Form Section -->
                <div class="col-md-7">
                    <div class="form-section">
                        <h1 class="login-title">Bienvenido</h1>
                        <p class="login-subtitle">Ingresa tus credenciales para continuar</p>
                        
                        <form action="/tesis/auth" method="post">
                            <div class="form-group-modern">
                                <label class="form-label-modern">
                                    <i class="fas fa-user"></i>
                                    Usuario
                                </label>
                                <div class="input-wrapper">
                                    <i class="fas fa-user input-icon"></i>
                                    <input type="text" name="usuario" class="form-control-modern" placeholder="Ingresa tu usuario" required>
                                </div>
                            </div>
                            
                            <div class="form-group-modern">
                                <label class="form-label-modern">
                                    <i class="fas fa-lock"></i>
                                    Contraseña
                                </label>
                                <div class="input-wrapper">
                                    <i class="fas fa-lock input-icon"></i>
                                    <input type="password" name="clave" class="form-control-modern" placeholder="Ingresa tu contraseña" required>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn-login">
                                <i class="fas fa-sign-in-alt"></i>
                                Iniciar Sesión
                            </button>
                            
                            <div class="alert-container">
                                <?php require __DIR__ . '/../../components/alerts.php'; ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <script src="<?= URL_PATH ?>/../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>