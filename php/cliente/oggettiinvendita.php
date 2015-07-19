<!DOCTYPE html>

<html>

        <head>
        
            	<script language="javascript">
			if(history.length>0)history.forward()
		</script>
        
                <title>Purchase.it - oggetti in vendita</title>
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
                        <li class="current_page"><a href="#" id="oggettiinvendita">Oggetti in vendita</a></li>
                        <li><a href="carrello.php" id="ricerca">Carrello</a></li>
                        <li><a href="ricerca.php" id="ricerca">Ricerca</a></li>
                        <li><a href="../../php/logout.php" id="logout">Logout</a></li>
                    </ul>
                </div>
		</div>

                </header>
                
                <div style="text-align: center">
                
                       <h3>Parco Auto:</h3>
                       
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
            	$query = mysql_query("SELECT * FROM oggetti WHERE condizioni='usato' OR condizioni='nuovo'") or die("query non riuscita".mysql_error());
            	$vis = mysql_fetch_object($query);
                ?>

            	<?php
            	while($vis = mysql_fetch_object($query))
            	{
            	?>

             	<br>

                   
                <div style="text-align: center">
                   
                    <img src="../../img/oggetti_in_vendita.png" width="100" height="70" alt="">
                   
                <?echo"$vis->marca";?>
                <?echo"$vis->modello";?>,
                <?echo"$vis->condizioni";?>,
                <b>PREZZO : </b><?echo"$vis->prezzo";?>
                <?echo"$vis->categoria";?>, 
                
                
                <a href="oggettiinvendita.php?rimuovi=<?echo $vis->id?>" id="button">Elimina oggetto</a>

        </div> 
                
              	<?php
                }
                            
                if(isset($_GET["rimuovi"]))
                {
                $idauto = $_GET["rimuovi"];
		$querypres = mysql_query("DELETE FROM oggetti WHERE id='$idoggetto'") or die('Query non riuscita'.mysql_error());
                }
		?>
 
	<br>
	<br>
                
        
        </div>

</body>

</html>
