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
	function Login($email,$clave){
		global $conexion;
		$clave=md5($clave);
		$usuario = $conexion->prepare("SELECT * FROM usuarios WHERE email = :email and pass = :pass ");
		$usuario->bindParam(":email", $email, PDO::PARAM_STR);
		$usuario->bindParam(":pass", $clave, PDO::PARAM_STR);
		if ($usuario->execute() && $usuario->rowCount()>0) {
			$usuario=$usuario->fetch();
			session_start();
			$_SESSION["usuario"] = array("nombre" => $usuario["nombre"],"apellido" => $usuario["apellido"], "email" => $usuario["email"]);
			header("Location: ../index.php");
		}else{
			$mensaje='novalida';
			header("Location: ../index.php?p=login&men=$mensaje");
		}

	}

	function Mensajes($tipo){
		switch ($tipo) {
			case 'guardado':
				$men='<div class="alert alert-success alert-dismissible" role="alert">
  						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  						Registro guardado con exito
				</div>';
			break;
			case 'duplicado':
				$men='<div class="alert alert-danger alert-dismissible" role="alert">
	  						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  						Error, Registro ya existe
					</div>';
			break;
			case 'errorguardar':
				$men='<div class="alert alert-danger alert-dismissible" role="alert">
	  						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  						Error, no se pudo guardar
					</div>';
			break;
			case 'novalida':
				$men='<div class="alert alert-danger alert-dismissible" role="alert">
  						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  						Error, credenciales no validas
				</div>';
			break;
			case 'camposvacios':
				$men='<div class="alert alert-danger alert-dismissible" role="alert">
  					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  						Error, Campos Vacios
				</div>';
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

	function CerrarSession(){
		session_start();
		unset( $_SESSION );
		session_destroy();
		header("location: ../index.php");

	}
	
?>