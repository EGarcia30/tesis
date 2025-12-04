<?php if(isset($_SESSION['color']) && isset($_SESSION['message'])) : ?>

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