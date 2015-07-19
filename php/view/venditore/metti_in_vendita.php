<!DOCTYPE html>

<html>

        
        
	<body>
	
        <div id="page">
                
                <header>
                
                    <div style="text-align: center" id="header">
                        
                    </div>
                    
                
                   
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
                                $_SESSION["stato"] = $_POST["stato"];
                                    
                                $query = "INSERT INTO prodotti (marca,modello,condizioni,prezzo,categoria,stato) VALUES (\"".$_POST["marca"]."\",\"".$_POST["modello"]."\",\"".$_POST["condizioni"]."\",\"".$_POST["prezzo"]."\",\"".$_POST["categoria"]."\")";
           		  	
                                if(!mysql_query($query))
                                {
                                ?>
                                	<div style="text-align: center">
                                		<h3><font color="#FF0000">ERRORE : PRODOTTO NON INSERITO.</font></h3>
                                	</div>
                                <?
                                }
                                else
                                {
                                	?>
                                	<div style="text-align: center">
                                		<h3><font color="#4CC417">PRODOTTO INSERITO CORRETTAMENTE!</font></h3>
                                	</div>
                                	<?
                                }
                }
                ?>
                                
                <div style="text-align: center">
		
		<h3>Aggiungi la tua auto:</h3>
		
                <form action="metti_in_vendita.php?aggiungi" method="post" id="form-login">
                	<br>Marca: <input type="text" name="marca"><br>
                	<br>Modello:<input type="text" name="modello"><br>
                	<br>Condizioni:
                	                            <input type="radio" name="condizioni" value="nuovo" checked>nuovo
                	                            <input type="radio" name="condizioni" value="usato">usato
                	                            
	
                	<br><br>Prezzo:<input type="number" name="prezzo" min="0"><br>
                        
                        <br>Categoria:
                	                            <input type="radio" name="categoria" value="elettronica" checked>elettronica
                                                    <input type="radio" name="categoria" value="abbigliamento" checked>abbigliamento
                                                    <input type="radio" name="categoria" value="veicoli" checked>veicoli
                                                    <input type="radio" name="categoria" value="informatica" checked>informatica
                                                    <input type="radio" name="categoria" value="altro" checked>altro
                                                    
                	                            
                	            
	
                	<br><input type="submit" value="Aggiungi" id="button"><br>
                </form>
		</div>
	<br>
	<br>
	<br>
                
        

</body>

</html>
