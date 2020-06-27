<?php 
	
	session_start();

	session_destroy();

	echo "Nunca será adeus :'(";	

	header("location: entrar.php");

	
 ?>