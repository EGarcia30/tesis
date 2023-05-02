<?php

$pages = $this->d['rows']/$this->d['itemShow'];
$pages = ceil($pages);

?>
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-end">
        <li class="page-item">
            <a class="page-link bg-dark <?= $_GET['pagina']<=1? 'disabled': ''?>" href="/tesis/<?= $_GET['nombrePagina'] ?>/<?= $_GET['pagina']-1?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>

        <?php for($i=0;$i<$pages;$i++) : ?>
            <li class="page-item <?= $_GET['pagina']==$i+1 ? 'active' : '' ?>">
                <a class="page-link bg-dark" href="/tesis/<?= $_GET['nombrePagina'] ?>/<?= $i+1?>"><?= $i+1?></a>
            </li>
        <?php endfor; ?>

        <li class="page-item">
            <a class="page-link <?= $_GET['pagina']>=$pages ? 'disabled':'' ?> bg-dark" href="/tesis/<?= $_GET['nombrePagina'] ?>/<?= $_GET['pagina']+1?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>