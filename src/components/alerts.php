<?php if(isset($_SESSION['color']) && isset($_SESSION['message'])) : ?>

<style>
    .alert-modern {
        border: none;
        border-radius: 16px;
        padding: 1.25rem 1.5rem;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        backdrop-filter: blur(10px);
        animation: slideInDown 0.4s ease;
        display: flex;
        align-items: center;
        gap: 1rem;
        font-weight: 500;
        position: relative;
        overflow: hidden;
    }
    
    .alert-modern::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 5px;
    }
    
    .alert-modern-success {
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        color: #155724;
        border-left: 5px solid #28a745;
    }
    
    .alert-modern-success::before {
        background: linear-gradient(135deg, #28a745 0%, #218838 100%);
    }
    
    .alert-modern-danger {
        background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
        color: #721c24;
        border-left: 5px solid #dc3545;
    }
    
    .alert-modern-danger::before {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    }
    
    .alert-modern-warning {
        background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
        color: #856404;
        border-left: 5px solid #ffc107;
    }
    
    .alert-modern-warning::before {
        background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
    }
    
    .alert-modern-info {
        background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
        color: #0c5460;
        border-left: 5px solid #17a2b8;
    }
    
    .alert-modern-info::before {
        background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
    }
    
    .alert-modern-primary {
        background: linear-gradient(135deg, #fef5f8 0%, #f5e6ed 100%);
        color: #6d1d3c;
        border-left: 5px solid #6d1d3c;
    }
    
    .alert-modern-primary::before {
        background: linear-gradient(135deg, #6d1d3c 0%, #8a2449 100%);
    }
    
    .alert-icon {
        width: 40px;
        height: 40px;
        min-width: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }
    
    .alert-modern-success .alert-icon {
        background: linear-gradient(135deg, #28a745 0%, #218838 100%);
        color: white;
    }
    
    .alert-modern-danger .alert-icon {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
    }
    
    .alert-modern-warning .alert-icon {
        background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
        color: white;
    }
    
    .alert-modern-info .alert-icon {
        background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
        color: white;
    }
    
    .alert-modern-primary .alert-icon {
        background: linear-gradient(135deg, #6d1d3c 0%, #8a2449 100%);
        color: white;
    }
    
    .alert-content {
        flex: 1;
    }
    
    .btn-close-modern {
        background: none;
        border: none;
        width: 32px;
        height: 32px;
        min-width: 32px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        opacity: 0.6;
    }
    
    .btn-close-modern:hover {
        opacity: 1;
        background: rgba(0, 0, 0, 0.1);
        transform: rotate(90deg);
    }
    
    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @media (max-width: 768px) {
        .alert-modern {
            padding: 1rem;
            font-size: 0.9rem;
        }
        
        .alert-icon {
            width: 35px;
            height: 35px;
            min-width: 35px;
            font-size: 1rem;
        }
    }
</style>

<?php
    $iconMap = [
        'success' => 'fa-check-circle',
        'danger' => 'fa-exclamation-circle',
        'warning' => 'fa-exclamation-triangle',
        'info' => 'fa-info-circle',
        'primary' => 'fa-bell'
    ];
    $color = $this->d['color'];
    $icon = $iconMap[$color] ?? 'fa-info-circle';
?>

<div id="alerta" class="alert alert-modern alert-modern-<?= $color ?> alert-dismissible fade show" role="alert">
    <div class="alert-icon">
        <i class="fas <?= $icon ?>"></i>
    </div>
    <div class="alert-content">
        <?= $this->d['message'] ?>
    </div>
    <button type="button" class="btn-close btn-close-modern" data-bs-dismiss="alert" aria-label="Close">
        <i class="fas fa-times"></i>
    </button>
</div>

<?php
    unset($_SESSION['color']);
    unset($_SESSION['message']);
endif;
?>