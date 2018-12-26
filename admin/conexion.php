<?php
	$host = "localhost";
	$user = "root";
	$pass = "12345678";
	$db = "comercioit";
	
	$conexion = new PDO("mysql:host=" . $host . ";dbname=" . $db, $user, $pass);
	$conexion->exec("SET CHARACTER SET utf8");
?>