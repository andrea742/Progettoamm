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
        <title>Compro e Vendo 2</title>
        <link rel="shortcut icon" type="image/x-icon" href="../immagini/favicon.ico"/>
        <link rel="Stylesheet" type="text/css" href="../css/style.css" media="screen"/>
     </head>
     
     
     <body>
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