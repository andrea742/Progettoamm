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
        <title>Purchase.it - Ricerca</title>
        <link rel="shortcut icon" type="image/x-icon" href="../immagini/favicon.png"/>
        <link rel="Stylesheet" type="text/css" href="../css/style.css" media="screen"/>
     </head>
     
     
     <body>
     
     
    <div id="paginazione">
    <div id="logo">
    
    <div id="arrivo">
                        
                            <a href="login.php" target="_self"><img src="../immagini/login.jpg" width="180" height="60" /></a>
                       
                        </div>
                </div>
    
    <div id="main">
                    <ul>
                    
                    	<li><a href="index.php" id="Home">Home</a></li>
                        <li><a href="vendi.php" id="Vendi">Vendi</a></li>
                        <li><a href="imperdibili.php" id="Imperdibili">Imperdibili</a></li>
                        <li><a href="inevidenza.php" id="inevidenza">In evidenza</a></li>
                        <li><a href="contattaci.php" id="Contattaci">Contattaci</a></li>
                        <li><a href="ricerca.php" id="Ricerca">Ricerca</a></li>
                    </ul>
                </div>
                
                
                
                
                
                
                    

      
     
     
     
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