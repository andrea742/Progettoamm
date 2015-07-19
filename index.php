<!DOCTYPE html>

<html>
    	<head>
        	<title>Purchase.it</title>
        	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        	<link rel="stylesheet" type="text/css" href="css/style.css">
        	<link rel="shortcut icon" href="img/icona.ico">
	</head>
	
	<body bgcolor="#88e7ea">  
	
	<br>
	
	<header>
        	<div style="text-align: center">
            		<img src="img/logo.PNG" alt="" width="750" height="135"/>
        	</div>
	</header>
	
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	
	<div style="text-align: center">
	
		<form method="post" action="php/login.php">
		
			<input type="hidden" name="cmd" value="login"/>
			<label for="username"> Username </label>
			<input type="text" name="username" id="username"/>
			<br>
			<br>
			<label for="password"> Password </label>
			<input type="password" name="password" id="password"/> 
			<br>
			<br>
			<button id="button" type="submit" name="cmd"  value="Login">Login</button>
		
		</form>
	</div>
	
	<br>
	
	<div style="text-align: center">
		<a href="README.md">Clicca qui per accedere alle info</a>
	</div>
	
	</body>
	
</html>
