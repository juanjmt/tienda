<?php
	require 'conexion.php';
	
	function guardarUsuario($nombre,$apellido,$email,$pass){
		global $conexion;
		$usuario = $conexion->prepare("SELECT * FROM usuarios WHERE email = :email");
		$usuario->bindParam(":email", $email, PDO::PARAM_STR);
		$usuario->execute();

		if ( $usuario->rowCount() == 0 ) {
			$valido='v';
		}else{
			$valido='f';
		}
		
		return $valido;

	}
	
?>