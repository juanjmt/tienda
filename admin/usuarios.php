<?php 
if( isset( $_GET["accion"] ) ){
	require 'funciones.php';

	$accion=$_GET['accion'];

	switch ($accion) {
		case 'AddUser':
			$nombre=$_POST['nombre'];
			$apellido=$_POST['apellido'];
			$email=$_POST['email'];
			$pass=$_POST['pass'];
			$resp=guardarUsuario($nombre,$apellido,$email,$pass);
			echo $resp;
		break;
		
		default:
			# code...
		break;
	}
}


?>