<!-- Grazie a questa pagina il venditore pu� mettere in vendita i suoi oggetti, gestione che avviene attraverso il database -->

<!DOCTYPE html>

<html>

        <head>
            	<script language="JavaScript">
			if(history.length>0)history.forward()
		</script>
        
                <title>Purchase.it - Vendi</title>
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
                        <li class="current_page"><a href="#" id="vendioggetto">Vendi un oggetto</a></li>
                        
                        <li><a href="../../php/logout.php" id="logout">Logout</a></li>
                    </ul>
                </div>
		</div>
		    
                </header>

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

                if(isset($_GET["aggiungi"]))
		{
                                $_SESSION["marca"] = $_POST["marca"];
                                $_SESSION["modello"] = $_POST["modello"];
                                $_SESSION["condizioni"] = $_POST["condizioni"];
                                $_SESSION["prezzo"] = $_POST["prezzo"];
                                $_SESSION["categoria"] = $_POST["categoria"];
                                    
                                $query = "INSERT INTO oggetti (marca,modello,condizioni,prezzo,categoria) VALUES (\"".$_POST["marca"]."\",\"".$_POST["modello"]."\",\"".$_POST["condizioni"]."\",\"".$_POST["prezzo"]."\",\"".$_POST["categoria"]."\")";
           		  	
                                if(!mysql_query($query))
                                {
                                ?>
                                	<div style="text-align: center">
                                		<h3><font color="#FF0000">ERRORE : Oggetto non messo in vendita.</font></h3>
                                	</div>
                                <?
                                }
                                else
                                {
                                	?>
                                	<div style="text-align: center">
                                		<h3><font color="#4CC417">Oggetto messo in vendita!</font></h3>
                                	</div>
                                	<?
                                }
                }
                ?>
                                
                <div style="text-align: center">
		
		<h3>Vendi il tuo oggetto:</h3>
		
                <form action="vendioggetto.php?aggiungi" method="post" id="form-login">
                	<br>Marca: <input type="text" name="marca"><br>
                	<br>Modello:<input type="text" name="modello"><br>
                        <br>Condizioni:
                	                            <input type="radio" name="condizioni" value="nuovo" checked>Nuovo
                	                            <input type="radio" name="condizioni" value="usato">Usato
                                           
                       <br><br>Prezzo:<input type="number" name="prezzo" min="0"><br>
                	                         
                	<br>Categoria:
                	                            <input type="radio" name="categoria" value="elettronica" >Elettronica
                	                            <input type="radio" name="categoria" value="abbigliamento" >Abbigliamento
                                                    <input type="radio" name="categoria" value="veicoli" >Veicoli
                                                    <input type="radio" name="categoria" value="informatica" >Informatica
                                                    <input type="radio" name="categoria" value="altro" checked>Altro            
	
                	<br><input type="submit" value="Aggiungi" id="button"><br>
                </form>
		</div>
	<br>
	<br>
	<br>
                
        
        </div>

</body>

</html>
