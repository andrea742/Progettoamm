<!DOCTYPE html>

<html>

        <head>
            	<script language="JavaScript">
			if(history.length>0)history.forward()
		</script>
        
                <title>Purchase.it - Cerca</title>
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
                        
                        <li class="current_page"><a href="#" id="ricerca">Ricerca</a></li>
                        <li><a href="carrello.php" id="ricerca">Carrello</a></li>
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
            	$query = mysql_query("SELECT * FROM oggetti WHERE condizioni='usato'") or die("query non riuscita".mysql_error());
            	$vis = mysql_fetch_object($query);
                if(isset($_GET["ricercaoggetto"]))
		{
                                $_SESSION["marca"] = $_POST["marca"];
                                $_SESSION["modello"] = $_POST["modello"];
                                $_SESSION["condizioni"] = $_POST["condizioni"];
                                $_SESSION["prezzo"] = $_POST["prezzo"];
                                $_SESSION["categoria"] = $_POST["categoria"];
                                $aux = "WHERE condizioni ='usato'";
                                if($_SESSION["marca"] !="")
                                    $aux .= " AND marca ='".$_SESSION["marca"]."'";
                                if($_SESSION["modello"] !="")
                                    $aux .= " AND modello ='".$_SESSION["modello"]."'";
                                if($_SESSION["condizioni"] !="")
                                    $aux .= " AND condizioni >='".$_SESSION["condizioni"]."'";
                                if($_SESSION["prezzo"] !="")
                                    $aux .= " AND prezzo <='".$_SESSION["prezzo"]."'";
                                if($_SESSION["categoria"] !="")
                                    $aux .= " AND categoria ='".$_SESSION["categoria"]."'";
                                
                                
                                $queryvis = mysql_query("SELECT * FROM oggetti $aux") or die("query non riuscita".mysql_error());
                                
                                if(mysql_num_rows($queryvis)==0)
                                {
                                ?>
                                	<div style="text-align: center">
                                		<h3><font color="#FF0000">Nessun oggetto trovato.</font></h3>
                                	</div>
                                <?
                                }
                                else if(mysql_num_rows($queryvis)!=0)
                                {
                                	?>
                                	<div style="text-align: center">
                                            <h3><font color="#4CC417">Oggetto trovato! Clicca su <a href="oggettiinvendita.php">Oggetti in vendita</a></font></h3>
                                	</div>
                                	<?
                                }
                                }
                                
                                ?>

		<div style="text-align: center">
		
		<h3>Ricerca oggetti:</h3>
		
		<form action="ricerca.php?ricercaoggetto" method="post" id="form-login">
                	<br>Marca: <input type="text" name="marca"><br>
                	<br>Modello:<input type="text" name="modello"><br>
                        <br>Condizioni:
                	                            <input type="radio" name="condizioni" value="nuovo" checked>Nuovo
                	                            <input type="radio" name="condizioni" value="usato">Usato
                                           
                       <br><br>Prezzo:<input type="number" name="prezzo" min="0"><br>
                	                         
                	<br>Categoria:
                	                            <input type="radio" name="categoria" value="elettronica" checked>Elettronica
                	                            <input type="radio" name="categoria" value="abbigliamento" checked>Abbigliamento
                                                    <input type="radio" name="categoria" value="veicoli" checked>Veicoli
                                                    <input type="radio" name="categoria" value="informatica" checked>Informatica
                                                    <input type="radio" name="categoria" value="altro" checked>Altro
	
                	
                	
                	<br><input type="submit" value="Cerca" id="button"><br>
                </form>

		</div>

	<br>
	<br>
	<br>
                
        
        </div>

</body>

</html>
