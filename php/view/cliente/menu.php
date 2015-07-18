<ul id="menuTop">
    <li class="<?= strpos($vd->getSottoPagina(),'home') !== false || $vd->getSottoPagina() == null ? 'current_page_item' : ''?>"><a href="cliente/home">Home</a></li>
    <li class="<?= strpos($vd->getSottoPagina(),'i_miei_dati') !== false ? 'current_page_item' : '' ?>"><a href="cliente/i_miei_dati">I miei dati</a></li>
    <li class="<?= strpos($vd->getSottoPagina(),'carrello') !== false ? 'current_page_item' : '' ?>"><a href="cliente/carrello">Il mio carrello</a></li>
</ul>