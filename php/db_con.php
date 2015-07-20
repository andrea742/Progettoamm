<!-- Connessione al database -->

<?php

$connessione_al_server=mysql_connect("localhost","sabiuAndrea","talpa816");

if(!$connessione_al_server)
{
	die ('Non riesco a connettermi: errore '.mysql_error());
}

$db_selected=mysql_select_db("amm14_sabiuAndrea",$connessione_al_server);

if(!$db_selected)
{
	die ('Errore nella selezione del database: errore '.mysql_error()); 
}

?>
