<?php

$pages = $this->d['rows']/$this->d['itemShow'];
$pages = ceil($pages);

?>
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-end">

        <li class="page-item <?= $_GET['pagina']==1 ? 'disabled' : '' ?>">
            <a class="page-link bg-dark" href="/tesis/<?= $_GET['nombrePagina'] ?>/<?=1?>">
                <i class="fas fa-angle-double-left"></i>
            </a>
        </li>

        <li class="page-item">
            <a class="page-link bg-dark <?= $_GET['pagina']<=1? 'disabled': ''?>" href="/tesis/<?= $_GET['nombrePagina'] ?>/<?= $_GET['pagina']-1?>" aria-label="Previous">
                <i class="fas fa-angle-left"></i>
            </a>
        </li>
        <li class="page-item">
            <button type="button" class="page-link bg-dark"><?=$_GET['pagina']?>/<?=$pages?></button>
        </li>

        <li class="page-item">
            <a class="page-link <?= $_GET['pagina']>=$pages ? 'disabled':'' ?> bg-dark" href="/tesis/<?= $_GET['nombrePagina'] ?>/<?= $_GET['pagina']+1?>" aria-label="Next">
                <i class="fas fa-angle-right"></i>
            </a>
        </li>

        <li class="page-item <?= $_GET['pagina']>=$pages ? 'disabled' : '' ?>">
            <a class="page-link bg-dark" href="/tesis/<?= $_GET['nombrePagina'] ?>/<?= $pages?>"><i class="fas fa-angle-double-right"></i></a>
        </li>
    </ul>
</nav>