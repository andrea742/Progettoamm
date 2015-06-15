<ul id="menuTop">
    <li class="<?= strpos($vd->getSottoPagina(),'home') !== false || $vd->getSottoPagina() == null ? 'current_page_item' : ''?>"><a href="cliente/home">Home</a></li>
    <li class="<?= strpos($vd->getSottoPagina(),'i_miei_dati') !== false ? 'current_page_item' : '' ?>"><a href="cliente/i_miei_dati">I miei dati</a></li>  
    <li class="<?= strpos($vd->getSottoPagina(),'le_mie_vendite') !== false ? 'current_page_item' : '' ?>"><a href="cliente/le_mie_vendite">Le mie vendite</a></li>
    <li class="<?= strpos($vd->getSottoPagina(),'metti_in_vendita') !== false ? 'current_page_item' : '' ?>"><a href="cliente/metti_in_vendita">Metti in vendita</a></li>   
    <li class="<?= strpos($vd->getSottoPagina(),'contatti') !== false ? 'current_page_item' : '' ?>"><a href="cliente/contatti">Contatti</a></li>
</ul>