

<div class="col-md-3 col-lg-3 col-xs-3 col-sm-3">
	
</div>
<div class="col-md-6 col-lg-6 col-xs-6 col-sm-6">
	<h4>Ingreso de Usuario</h4>
	<form action="admin/usuarios.php?accion=login" method="post">
		<div class="form-group">
			<div class="row">
				<label>E-Mail:</label>
				<input type="text" name="email" name="email" class="form-control" placeholder="Mail"> 
			</div>
			<br>
			<div class="row">
				<label>Contraseña:</label>
				<input type="password" class="form-control" name="pass" id="pass">
			</div>
			<br>
			<div class="row text-center">
				<button class="btn btn-primary" type="submit" name="ingresar" id="ingresar"> Ingresar </button> 
			</div>
			<br>
			<div class="row">
				<a class="help-block" href="#">¿Olvidaste tu contraseña?</a>
			</div>
		</div>
	</form>
	<div class="row">
		<h5>NUEVO USUARIO</h5>
		<a href="?p=registro">Crear una cuenta</a>
	</div>
</div>
<div class="col-md-3 col-lg-3 col-xs-3 col-sm-3">
	
</div>
