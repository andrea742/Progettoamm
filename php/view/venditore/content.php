<?php
switch ($vd->getSottoPagina()) {
    case 'i_miei_dati':
        include 'i_miei_dati.php';
        break;
    
    case 'le_mie_vendite':
        include 'le_mie_vendite.php';
        break;
    
    case 'metti_in_vendita':
        include 'metti_in_vendita.php';
        break;  
          
        ?>
        

    <?php default: ?>
<br>
<br>
        


        <table class="content">
            <tr>               
                     
                <td class="noRighe"><a href="venditore/i_miei_dati" title="i miei dati">
                    <img src="../images/i_miei_dati.png" alt="i_miei_dati"></a></td>   
                    
                    <td class="noRighe">
                    <h4>I miei dati</h4>
                    <p><i>permette di consultare la propria anagrafica</i></p>
                </td>
                    
                    </tr>
                     <tr>
                                             
                <td class="noRighe"><a href="venditore/le_mie_vendite" title="le mie vendite">
                    <img src="../images/oggetti_in_vendita.png" alt="le_mie_vendite"></a>
                </td>
                
                <td class="noRighe">
                    <h4>Oggetti in vendita</h4>
                    <p><i>visualizza tutti i tuoi oggetti in vendita</i></p>
                    
                </td>
                </td>               
            </tr>
            
            <tr>
                  
 
               <td class="noRighe"><a href="venditore/metti_in_vendita" title="metti in vendita">
                   <img src="../images/carrello.png" alt="metti_in_vendita"></a>
                   
                   <td class="noRighe">
                    <h4>Inizia a vendere</h4>
                    <p><i>Crea la tua inserzione e inizia subito a vendere</i></p>
               </td>
            </tr>
        </table>
        
<?php break; } ?>