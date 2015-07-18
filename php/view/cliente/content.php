<?php
switch ($vd->getSottoPagina()) {
    case 'i_miei_dati':
        include 'i_miei_dati.php';
        break;
    
    case 'oggetti_in_vendita':
        include 'oggetti_in_vendita.php';
        break;
    
    case 'carrello':
        include 'carrello.php';
        break;  
    
    case 'ricerca_ordini_json':
        include_once 'ricerca_ordini_json.php';
        break;      
        ?>
        

    <?php default: ?>
        <h2>MENÚ</h2>


        <table class="content">
            <tr>               
                <td class="noRighe">
                    <h4>I miei dati</h4>
                    <p><i>permette di consultare e modificare la propria anagrafic<</i></p>
                </td>     
                <td class="noRighe"><a href="cliente/i_miei_dati" title="i_miei_dati">
                    <img src="../images/i_miei_dati.png" alt="i_miei_dati"></a></td>                    
                                             
                <td class="noRighe"><a href="cliente/oggetti_in_vendita" title="oggetti_in_vendita">
                    <img src="../images/oggetti_in_vendita.png" alt="gestione ordini"></a>
                </td>  
                <td class="noRighe">
                    <h4>Oggetti in vendita</h4>
                    
                </td>
                </td>               
            </tr>
            
            <tr>
                <td class="noRighe">
                    <h4>Ricerca ordini</h4>
                    <p><i>ricerca gli ordini relativi a date passate</i></p>  
 
               <td class="noRighe"><a href="addettoOrdini/ricerca_ordini" title="ricerca_ordini">
                   <img src="../images/ricerca.png" alt="ricerca ordini"></a>
               </td>
            </tr>
        </table>
        
<?php break; } ?>