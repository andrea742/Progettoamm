<!DOCTYPE html>

<html>

        <head>
            	<script language="JavaScript">
			if(history.length>0)history.forward()
		</script>
        
                <title>AMMacchina</title>
        	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        	<link rel="stylesheet" type="text/css" href="../../css/style.css">
        	<link rel="shortcut icon" href="../../img/icona.ico">
        </head>
        
	<body>
	
        <div id="page">
                
                <header>
                
                    <div style="text-align: center" id="header">
                        <img src="../../img/1500.png" alt="" width="600" height="250"/>
                    </div>
                    
                <div style="text-align: center" id="top">

		<div style="text-align: center" id="menu">
                    <ul>
                        <li><a href="home.php" id="home">Home</a></li>
                        <li><a href="parcoauto.php" id="parcoauto">Parco Auto</a></li>
                        <li class="current_page"><a href="#" id="aggiungiauto">Aggiungi Auto</a></li>
                        <li><a href="ricerca.php" id="ricerca">Ricerca</a></li>
                        <li><a href="../../php/logout.php" id="logout">Logout</a></li>
                    </ul>
                </div>
		</div>
		    
                </header>

		<?php
                $connessione_al_server = mysql_connect("localhost","mameliSimone","macaco861");
                
                if(!$connessione_al_server)
                {
                	die("Errore: connessione non riuscita".mysql_error());
            	}
            	$db_selected = mysql_select_db("amm14_mameliSimone", $connessione_al_server);
            	if(!$db_selected)
            	{
                	die("Errore: selezione del database errata ".mysql_error());
            	}

                if(isset($_GET["aggiungi"]))
		{
                                $_SESSION["marca"] = $_POST["marca"];
                                $_SESSION["modello"] = $_POST["modello"];
                                $_SESSION["colore"] = $_POST["colore"];
                                $_SESSION["anno"] = $_POST["anno"];
                                $_SESSION["alimentazione"] = $_POST["alimentazione"];
                                $_SESSION["prezzo"] = $_POST["prezzo"];
                                $_SESSION["chilometri"] = $_POST["chilometri"];
                                $_SESSION["stato"] = $_POST["stato"];
                                    
                                $query = "INSERT INTO cars (marca,modello,colore,anno,alimentazione,prezzo,chilometri,stato) VALUES (\"".$_POST["marca"]."\",\"".$_POST["modello"]."\",\"".$_POST["colore"]."\",\"".$_POST["anno"]."\",\"".$_POST["alimentazione"]."\",\"".$_POST["prezzo"]."\",\"".$_POST["chilometri"]."\",\"".$_POST["stato"]."\")";
           		  	
                                if(!mysql_query($query))
                                {
                                ?>
                                	<div style="text-align: center">
                                		<h3><font color="#FF0000">ERRORE : AUTO NON INSERITA.</font></h3>
                                	</div>
                                <?
                                }
                                else
                                {
                                	?>
                                	<div style="text-align: center">
                                		<h3><font color="#4CC417">AUTO INSERITA CORRETTAMENTE!</font></h3>
                                	</div>
                                	<?
                                }
                }
                ?>
                                
                <div style="text-align: center">
		
		<h3>Aggiungi la tua auto:</h3>
		
		<form action="aggiungiauto.php?aggiungi" method="post" id="form-login">
                	<br>Marca: <input type="text" name="marca"><br>
                	<br>Modello:<input type="text" name="modello"><br>
                	<br>Colore: <input type="text" name="colore"><br>
                	<br>Anno:<input type="number" name="anno" min="1950" max="2015"><br>
                	<br>Alimentazione:
                	                            <input type="radio" name="alimentazione" value="Benzina" checked>Benzina
                	                            <input type="radio" name="alimentazione" value="Diesel">Diesel
                	                            <input type="radio" name="alimentazione" value="Gas">Gas
                	                            <input type="radio" name="alimentazione" value="Elettrica">Elettrica
	
                	<br><br>Prezzo:<input type="number" name="prezzo" min="0"><br>
                	<br>Chilometri:<input type="number" name="chilometri" min="0"><br>
                	<br>Stato veicolo:
                	                            <input type="radio" name="stato" value="Auto usata" checked>Auto usata
                	                            <input type="radio" name="stato" value="Auto nuova">Auto nuova             
	
                	<br><input type="submit" value="Aggiungi" id="button"><br>
                </form>
		</div>
	<br>
	<br>
	<br>
                
        <div id="footer">
        
                <div style="text-align: center">
                        <b><i>Simone Mameli</i></b>
                </div>
                
                <br>
                <br>
                
                <div style="text-align: center">
                        <a id="htmlval" href="http://validator.w3.org/check?uri=referer" target="_blank">HTML Valid</a>

                        <a id="cssval" href="http://jigsaw.w3.org/css-validator/check/refer" target="_blank">CSS Valid</a>
                </div>
        </div>
        </div>

</body>

</html>
