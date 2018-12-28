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
			if ($nombre!='' && $apellido!='' && $email!='' && $pass!=''){
				$resp=guardarUsuario($nombre,$apellido,$email,$pass);
			}else{
				$resp='camposvacios';
				header("Location: ../index.php?p=registro&men=$resp");
			}
			echo $resp;
		break;
		case 'login':
			$email=$_POST['email'];
			$clave=$_POST['clave'];
			$resp=Login($email,$clave);
			echo $resp;
		break;
		case 'cerrarsession':

			CerrarSession();
		break;
		default:
			# code...
		break;
	}
}


?>