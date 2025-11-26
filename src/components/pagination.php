<?php
$pages = $this->d['rows']/$this->d['itemShow'];
$pages = ceil($pages);
?>

<style>
    .modern-pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
        padding: 1.5rem 0;
    }
    
    .pagination-modern {
        display: flex;
        gap: 0.5rem;
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .page-item-modern {
        margin: 0;
    }
    
    .page-link-modern {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 45px;
        height: 45px;
        padding: 0.5rem 1rem;
        background: white;
        color: #6d1d3c;
        border: 2px solid rgba(109, 29, 60, 0.15);
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .page-link-modern:hover:not(.disabled) {
        background: linear-gradient(135deg, #6d1d3c 0%, #8a2449 100%);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(109, 29, 60, 0.25);
        border-color: transparent;
    }
    
    .page-link-modern.active {
        background: linear-gradient(135deg, #6d1d3c 0%, #8a2449 100%);
        color: white;
        border-color: transparent;
        box-shadow: 0 4px 12px rgba(109, 29, 60, 0.3);
        cursor: default;
    }
    
    .page-link-modern.disabled {
        opacity: 0.4;
        cursor: not-allowed;
        pointer-events: none;
    }
    
    .page-counter {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 80px;
        height: 45px;
        padding: 0.5rem 1.25rem;
        background: linear-gradient(135deg, #6d1d3c 0%, #8a2449 100%);
        color: white;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.95rem;
        box-shadow: 0 4px 12px rgba(109, 29, 60, 0.2);
    }
    
    @media (max-width: 768px) {
        .modern-pagination {
            gap: 0.4rem;
        }
        
        .pagination-modern {
            gap: 0.4rem;
        }
        
        .page-link-modern {
            min-width: 40px;
            height: 40px;
            padding: 0.4rem 0.8rem;
            font-size: 0.9rem;
        }
        
        .page-counter {
            min-width: 70px;
            height: 40px;
            padding: 0.4rem 1rem;
            font-size: 0.85rem;
        }
    }
    
    @media (max-width: 480px) {
        .page-link-modern {
            min-width: 36px;
            height: 36px;
            padding: 0.3rem 0.6rem;
            font-size: 0.85rem;
        }
        
        .page-counter {
            min-width: 65px;
            height: 36px;
            font-size: 0.8rem;
        }
    }
</style>

<nav aria-label="Navegación de páginas" class="modern-pagination">
    <ul class="pagination-modern">
        <li class="page-item-modern">
            <a class="page-link-modern <?= $_GET['pagina']==1 ? 'disabled' : '' ?>" 
                href="/tesis/<?= $_GET['nombrePagina'] ?>/<?=1?>"
                aria-label="Primera página">
                <i class="fas fa-angle-double-left"></i>
            </a>
        </li>

        <li class="page-item-modern">
            <a class="page-link-modern <?= $_GET['pagina']<=1? 'disabled': ''?>" 
                href="/tesis/<?= $_GET['nombrePagina'] ?>/<?= $_GET['pagina']-1?>" 
                aria-label="Página anterior">
                <i class="fas fa-angle-left"></i>
            </a>
        </li>
        
        <li class="page-item-modern">
            <span class="page-counter">
                <?=$_GET['pagina']?> / <?=$pages?>
            </span>
        </li>

        <li class="page-item-modern">
            <a class="page-link-modern <?= $_GET['pagina']>=$pages ? 'disabled':'' ?>" 
                href="/tesis/<?= $_GET['nombrePagina'] ?>/<?= $_GET['pagina']+1?>" 
                aria-label="Página siguiente">
                <i class="fas fa-angle-right"></i>
            </a>
        </li>

        <li class="page-item-modern">
            <a class="page-link-modern <?= $_GET['pagina']>=$pages ? 'disabled' : '' ?>" 
                href="/tesis/<?= $_GET['nombrePagina'] ?>/<?= $pages?>"
                aria-label="Última página">
                <i class="fas fa-angle-double-right"></i>
            </a>
        </li>
    </ul>
</nav>