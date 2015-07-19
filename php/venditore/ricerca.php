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
                        <li><a href="aggiungiauto.php" id="aggiungiauto">Aggiungi Auto</a></li>
                        <li class="current_page"><a href="#" id="ricerca">Ricerca</a></li>
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
            	$query = mysql_query("SELECT * FROM cars WHERE stato='Auto usata'") or die("query non riuscita".mysql_error());
            	$vis = mysql_fetch_object($query);
                if(isset($_GET["ricercaauto"]))
		{
                                $_SESSION["marca"] = $_POST["marca"];
                                $_SESSION["modello"] = $_POST["modello"];
                                $_SESSION["anno"] = $_POST["anno"];
                                $_SESSION["alimentazione"] = $_POST["alimentazione"];
                                $_SESSION["prezzo"] = $_POST["prezzo"];
                                $_SESSION["chilometri"] = $_POST["chilometri"];
                                $aux = "WHERE stato ='Auto usata'";
                                if($_SESSION["marca"] !="")
                                    $aux .= " AND marca ='".$_SESSION["marca"]."'";
                                if($_SESSION["modello"] !="")
                                    $aux .= " AND modello ='".$_SESSION["modello"]."'";
                                if($_SESSION["anno"] !="")
                                    $aux .= " AND anno >='".$_SESSION["anno"]."'";
                                if($_SESSION["alimentazione"] !="")
                                    $aux .= " AND alimentazione ='".$_SESSION["alimentazione"]."'";
                                if($_SESSION["prezzo"] !="")
                                    $aux .= " AND prezzo <='".$_SESSION["prezzo"]."'";
                                if($_SESSION["chilometri"] !="")
                                    $aux .= " AND chilometri <='".$_SESSION["chilometri"]."'";
                                $queryvis = mysql_query("SELECT * FROM cars $aux") or die("query non riuscita".mysql_error());
                                
                                if(mysql_num_rows($query)==0)
                                {
                                ?>
                                	<div style="text-align: center">
                                		<h3><font color="#FF0000">Attenzione : Nessun risultato trovato.</font></h3>
                                	</div>
                                <?
                                }
                                else if(mysql_num_rows($query)!=0)
                                {
                                	?>
                                	<div style="text-align: center">
                                		<h3><font color="#4CC417">Auto trovata! Clicca su <a href="parcoauto.php">Parco Auto</a></font></h3>
                                	</div>
                                	<?
                                }
                                }
                                
                                ?>

		<div style="text-align: center">
		
		<h3>Ricerca la tua auto:</h3>
		
		<form action="ricerca.php?ricercaauto" method="post" id="form-login">
                	<br>Marca: <input type="text" name="marca"><br>
                	<br>Modello:<input type="text" name="modello"><br>
                	<br>Anno:<input type="number" name="anno" min="1930" max="2015"><br>
                	<br>Alimentazione:
                	                            <input type="radio" name="alimentazione" value="Benzina" checked>Benzina
                	                            <input type="radio" name="alimentazione" value="Diesel">Diesel
                	                            <input type="radio" name="alimentazione" value="Gas">Gas
                	                            <input type="radio" name="alimentazione" value="Elettrica">Elettrica
	
                	<br><br>Prezzo:<input type="number" name="prezzo" min="0"><br>
                	<br>Chilometri:<input type="number" name="chilometri" min="0"><br>
                	<br><input type="submit" value="Cerca" id="button"><br>
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
