<?php
	require 'conexion.php';
	function CambioContenido($pagina){
		require 'paginas/'.$pagina.'.php';
		
	}
	
	function guardarUsuario($nombre,$apellido,$email,$pass){
		global $conexion;
		$usuario = $conexion->prepare("SELECT * FROM usuarios WHERE email = :email");
		$usuario->bindParam(":email", $email, PDO::PARAM_STR);
		$usuario->execute();
		if ( $usuario->rowCount() == 0 ) {
			$clave = md5( $clave );
			$estado='1';
			$usuario = $conexion->prepare("INSERT INTO usuarios (nombre, apellido, email, pass, estado) VALUES (:nombre, :apellido, :email, :pass, :estado)");
			$usuario->bindParam(":nombre", $nombre, PDO::PARAM_STR);
			$usuario->bindParam(":apellido", $apellido, PDO::PARAM_STR);
			$usuario->bindParam(":email", $email, PDO::PARAM_STR);
			$usuario->bindParam(":pass", $clave, PDO::PARAM_STR);
			$usuario->bindParam(":estado", $estado, PDO::PARAM_STR);
			if ($usuario->execute()){
				$mensaje='guardado';
				header("Location: ../index.php?p=login&men=$mensaje");
			}else{
				$mensaje='errorguardar';
				header("Location: ../index.php?p=registro&men=$mensaje");

			}
		}else{
			$mensaje='duplicado';
			header("Location: ../index.php?p=registro&men=$mensaje");
		}
		
		return $mensaje;

	}

	function Mensajes($tipo){
		switch ($tipo) {
			case 'guardado':
				$men='Registro guardado con exito';
			break;
			case 'duplicado':
				$men='Registro ya existe';
			break;
			case 'errorguardar':
				$men='Error al guardar';
			break;
			case 'editado':
				# code...
			break;
			case 'eliminado':
				# code...
			break;
			
			default:
				# code...
			break;
		}
		return $men;

	}
	
?>