<!DOCTYPE html>

<html>

        <head>
        
                <title>Purchase.it - Carrello</title>
        	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        	<link rel="stylesheet" type="text/css" href="../../css/style.css">
        	<link rel="shortcut icon" href="../../img/icona.ico">
        </head>
        
	<body>
	
        <div id="page">
                
                <header>
                
                    <div style="text-align: center" id="header">
                        <img src="../../img/logo.PNG" alt="" width="750" height="135"/>
                    </div>
                    
                <div style="text-align: center" id="top">

		<div style="text-align: center" id="menu">
                    <ul>
                        <li><a href="home.php" id="home">Home</a></li>
                        <li><a href="oggettiinvendita.php" id="oggettiinvendita">Oggetti in vendita</a></li>
                        <li><a href="ricerca.php" id="ricerca">Ricerca</a></li>
                        <li class="current_page"><a href="#" id="carrello">Carrello</a></li>
                        
                        <li><a href="../../php/logout.php" id="logout">Logout</a></li>
                    </ul>
                </div>
		</div>
 
                </header>
                
                <div style="text-align: center">
                
                       <h3>Il tuo carrello:</h3>
                       
                </div>
                
                <?php
                $connessione_al_server = mysql_connect("localhost","sabiuAndrea","talpa816");
                
                if(!$connessione_al_server)
                {
                	die("Errore: connessione non riuscita".mysql_error());
            	}
            	$db_selected = mysql_select_db("amm14_sabiuAndrea", $connessione_al_server);
            	if(!$db_selected)
            	{
                	die("Errore: selezione del database errata ".mysql_error());
            	}
            	$query = mysql_query("SELECT * FROM carrello JOIN oggetti ON carrello.idoggetto = oggetti.id WHERE 1") or die("query non riuscita".mysql_error());
            	
               
            	while($ctr = mysql_fetch_object($query))
            	{
            	?>
            
        	<br>

                   
                <div style="text-align: center">
                  
                   
                    <img src="../../img/oggetti_in_vendita.png" width="100" height="70" alt="">
                   
                        Marca : <?echo"$ctr->marca";?> ||
                	Modello: <?echo"$ctr->modello";?> ||
                	Condizioni:<?echo"$ctr->condizioni";?> ||
                	Prezzo: <?echo"$ctr->prezzo";?>
                	
                	Euro ||  Categoria: <?echo"$ctr->categoria";?> || 

                        
                        
                        <a href="oggettiinvendita.php?rimuovi=<?echo $ctr->id?>" id="button">Rimuovi dal carrello</a>

			

                        </div> 

              		<?php
                        }
                        ?>
 
                   	
			
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
                
        
        </div>

</body>

</html>
