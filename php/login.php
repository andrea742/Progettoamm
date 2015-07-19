<?php

session_start();

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

$_SESSION["username"]=$_POST["username"]; 

$_SESSION["password"]=$_POST["password"]; 

$queryven = mysql_query("SELECT * FROM utenti WHERE username='".$_POST["username"]."' AND password ='".$_POST["password"]."' AND ruolo='venditore'") or DIE('query non riuscita'.mysql_error());

$querycli = mysql_query("SELECT * FROM utenti WHERE username='".$_POST["username"]."' AND password ='".$_POST["password"]."' AND ruolo='cliente'") or DIE('query non riuscita'.mysql_error());

if(mysql_num_rows($queryven))
{   
	$row = mysql_fetch_assoc($queryven); 
	$_SESSION["logged"] =true;  
	header("location:venditore.php"); 
	
}
else if(mysql_num_rows($querycli))
{   
	$row = mysql_fetch_assoc($querycli); 
	$_SESSION["logged"] =true;  
	header("location:cliente.php"); 
}
else
{
?>
	<!DOCTYPE html>
	<html>
    	<head>
        	<title>AMMacchina</title>
        	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        	<link rel="stylesheet" type="text/css" href="../css/style.css">
        	<link rel="shortcut icon" href="../img/icona.ico">
	</head>
	
	<br>
	
    	<body>
	
	<header>
        	<div style="text-align: center">
            		<img src="../img/1500.png" width="600" height="250"/>
        	</div>
        	<body bgcolor="#C0C0C0">
	</header>
	
	<br>
	<br>
	<div style="text-align: center">
		<h4><font color="#FF0000">L'username o la password sono errati.</font></h4>
	</div>
	<br>
	<br>
	
	<div style="text-align: center">
	
		<form method="post" action="../php/login.php">
		
			<input type="hidden" name="cmd" value="login"/>
			<label for="user">Username</label>
			<input type="text" name="username" id="username"/>
			<br>
			<br>
			<label for="password">Password </label>
			<input type="password" name="password" id="password"/> 
			<br>
			<br>
			<button id="button" type="submit" name="cmd"  value="Login">Login</button>
		
		</form>
	</div>
	
	<br>
	
	<div style="text-align: center">
		<a href="../README.md">Accesso al progetto.</a>
	</div>
	
	</body>
	
	</html>

	<?php
} 
?>
