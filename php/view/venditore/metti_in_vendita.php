

            

                            <?
                            if(isset($_GET["campi"]) && ($_GET["campi"]=="ok"))
                            {
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

                                

                                $query = "INSERT INTO prodotti (marca,modello,condizioni,prezzo,categoria,venditore)
                                VALUES (\"".$_POST["marca"]."\",\"".$_POST["modello"]."\",\"".$_POST["condizioni"]."\",\"".$_POST["prezzo"]."\",\"".$_POST["categoria"]."\",\"".$_POST["venditore"]."\",\"".$_POST["chilometri"]."\")";

                                $result = mysql_query($query);

                                if(!$result)
                                {
                                    die("Errore nella query: ".mysql_error());

                                    $pagina_login = "metti_in_vendita.php?agg=err";

                                    header("Location:".$pagina_login);
                                }

                                else
                                {
                                    $pagina_login = "metti_in_vendita.php?agg=ok";

                                    header("Location:".$pagina_login);
                                }
                            }

                            

                            
                                ?>

                            <p>Inserisci le caretteristiche del prodotto che vuoi vendere:</p>

                            <form action="metti_in_vendita.php?campi=ok" method="post" id="form-login">
                                <table id="table-form">
                                    <tr>
                                        <td>Marca:</td>

                                        <td><input type="text" name="marca" placeholder="Samsung" required/></td>
                                    </tr>

                                    <tr>
                                        <td>Modello:</td>

                                        <td><input type="text" name="modello" placeholder="galaxy S3" required/></td>
                                    </tr>

                                    

                                    <tr>
                                        <td>Condizioni:</td>

                                        <td>
                                            <input type="radio" name="condizioni" value="nuovo" checked/>Nuovo
                                            <input type="radio" name="condizioni" value="usato"/>Usato
                                           
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Prezzo:</td>

                                        <td><input type="number" name="prezzo" min="0" placeholder="49" required/></td>
                                    </tr>

                                    <tr>
                                        <td>Categoria:</td>

                                        <td>
                                            <input type="radio" name="categoria" value="elettronica" checked/>Elettronica
                                            <input type="radio" name="categoria" value="abbigliamento" checked/>Abbigliamento
                                            <input type="radio" name="categoria" value="veicoli" checked/>Veicoli
                                            <input type="radio" name="categoria" value="informatica" checked/>Informatica
                                            <input type="radio" name="categoria" value="altro" checked/>Altro
                                            
                                        
                                        </td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td><input type="submit" value="Aggiungi"/><td>
                                    </tr>
                                </table>
                            </form>
                        </td>

                        




