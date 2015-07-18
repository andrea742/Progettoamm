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
        MENU


        <table class="content">
            <tr>               
                <td class="noRighe">
                    <h4>I miei dati</h4>
                    <p><i>permette di consultare e modificare la propria anagrafica</i></p>
                </td>     
                <td class="noRighe"><a href="cliente/i_miei_dati" title="i miei dati">
                    <img src="../images/i_miei_dati.png" alt="i_miei_dati"></a></td>                    
                                             
                <td class="noRighe"><a href="cliente/oggetti_in_vendita" title="oggetti in vendita">
                    <img src="../images/oggetti_in_vendita.png" alt="gestione ordini"></a>
                </td>
                
                <td class="noRighe">
                    <h4>Oggetti in vendita</h4>
                    <p><i>visualizza tutti gli oggetti in vendita</i></p>
                    
                </td>
                </td>               
            
                <td class="noRighe">
                    <h4>Carrello</h4>
                    <p><i>Vai al carrello</i></p>  
 
               <td class="noRighe"><a href="cliente/carrello" title="carrello">
                   <img src="../images/carrello.png" alt="carrello"></a>
               </td>
            </tr>
        </table>
        
<?php break; } ?>