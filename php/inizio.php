<!DOCTYPE html>

<?php

setcookie("redirect", null);
if(!isset($_COOKIE["identificazione"]))
{
?>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <meta name="author" content="Sabiu Andrea 47736"/>
        <meta name="description" content="Sito eCommerce"/>
        <title>Purchase.it - Home</title>
        <link rel="shortcut icon" type="image/x-icon" href="../immagini/favicon.png"/>
        <link rel="Stylesheet" type="text/css" href="../css/style.css" media="screen"/>
     </head>
     
     
     <body>
     
     <div id="logo">
     </div>
     <div id="forma">
    
     
     
    
     <form method='post' name='ricerca' action='cerca.php'>
	<table border="0">

	
	<td><input type="text" name="testo" onkeyup='Cerca()'
	style="width:400px; height:40px; "/></td>
	<td><input type="submit" value="Cerca" /></td></tr>

	<tr><td></td><td><div id='box'
	style="width:300px"><td></td></tr>

	</table>
</form>
     
     
     </body>
     </html>
     
     
<?
}

else
{
    $login = "logout.php";
    $redirect = "inizio.php";

    setcookie("redirect", $redirect, time()+300);

	header("Location:".$login);
}
?>