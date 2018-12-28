<!DOCTYPE html>
<html>
<head>
	<title>Tienda Online</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" >
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>

</head>
<body>
	<nav class="navbar navbar-default" style="background-color: #00a5da;"> 
		<div class="container-fluid">
			<img src="imagenes/logo.png" width="100px" height="50px">
			<ul class="nav navbar-nav navbar-right">
				<?php 
					session_start();
					if (isset($_SESSION["usuario"])){ 
						echo '<li><a style="color: #FFFFFF;"> <i style="font-size:20px;" class="fas fa-user-circle"></i> '.$_SESSION["usuario"]['nombre'].' '.$_SESSION["usuario"]['apellido'].'</a></li>
						<li><a style="color: #FFFFFF;" href="?p=administrar">Administrar</a></li>
						<li><a style="color: #FFFFFF;" href="admin/usuarios.php?accion=cerrarsession">Cerrar Sesión</a></li>';

					}else{ 
						echo '<li><a style="color: #FFFFFF;" href="?p=registro">Registro</a></li>
						<li><a style="color: #FFFFFF;" href="?p=login">Ingresar</a></li>
						<li><a style="color: #FFFFFF;" href="?p=contacto">Contacto</a></li>';
				
					}
				?>
				
			</ul>
		</div>
	</nav>
	<div class="container" style=" min-height:400px;">



