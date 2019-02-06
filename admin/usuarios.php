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
		case 'contactando':
			$nombrecontac=$_POST['nombrecontac'];
			$emailcontac=$_POST['emailcontac'];
			$mensaje=$_POST['mensaje'];
			if($nombrecontac!='' && $emailcontac!='' && $mensaje!=''){
				$men=EnviarMail($nombrecontac,$emailcontac,$mensaje);
				?>
					<script type="text/javascript">
						var mensaje='<?php echo $men; ?>';
						window.location='../index.php?p=contacto&men='+mensaje;
					</script>
				<?php 
				//header("Location: ../index.php?p=contacto&men=$men");
			}else{
				$men='camposvacios';
				header("Location: ../index.php?p=contacto&men=$men");
			}
		break;
		default:
			# code...
		break;
	}
}


?>