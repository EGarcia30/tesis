<?php
    if(isset($_SESSION['color']) && isset($_SESSION['message'])) :
?>
    <div id="alerta" class="alert alert-<?= $this->d['color']?> alert-dismissible fade show" role="alert">
        <?= $this->d['message'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
    unset($_SESSION['color']);
    unset($_SESSION['message']);
    endif;
?>