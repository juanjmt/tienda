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
				guardarUsuario($nombre,$apellido,$email,$pass);
			}else{
				$resp='camposvacios';
				header("Location: ../index.php?p=registro&men=$resp");
			}
		break;
		case 'login':
			$email=$_POST['email'];
			$clave=$_POST['clave'];
			Login($email,$clave);
			
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