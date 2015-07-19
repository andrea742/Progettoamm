<?php

$connessione_al_server=mysql_connect("localhost","mameliSimone","macaco861");

if(!$connessione_al_server)
{
	die ('Non riesco a connettermi: errore '.mysql_error());
}

$db_selected=mysql_select_db("amm14_mameliSimone",$connessione_al_server);

if(!$db_selected)
{
	die ('Errore nella selezione del database: errore '.mysql_error()); 
}

?>
