<!DOCTYPE html>

<html>
    	<head>
        	<title>AMMacchina</title>
        	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        	<link rel="stylesheet" type="text/css" href="css/style.css">
        	<link rel="shortcut icon" href="img/icona.ico">
	</head>
	
	<body bgcolor="#C0C0C0">
	
	<br>
	
	<header>
        	<div style="text-align: center">
            		<img src="img/1500.png" alt="" width="600" height="250"/>
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
		<a href="README.md">Accesso al progetto</a>
	</div>
	
	</body>
	
</html>
