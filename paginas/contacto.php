<?php 
	if (isset($_POST['enviar'])){
		echo 'dsdsa';
	}

?>
<div class="col-md-3 col-lg-3 col-xs-3 col-sm-3">
	
</div>
<div class="col-md-6 col-lg-6 col-xs-6 col-sm-6">
	<h4 class="">Contacto</h4>
	<form action="admin/usuarios.php?accion=contactando" method="POST">
		<div class="form-group">
			<div class="row">
				<label>Nombre: </label>
				<input type="text" class="form-control" placeholder="Nombre" name="nombrecontac" id="nombrecontac">
			</div>
			<br>
			<div class="row">
				<label>Email: </label>
				<input type="text" class="form-control" placeholder="E-Mail" name="emailcontac" id="emailcontac">
			</div>
			<br>
			<div class="row">
				<label>Mensaje: </label>	
				<textarea class="form-control" rows="3" name="mensaje" id="mensaje"></textarea>
			</div>
			<br>
			<div class="row text-center">
				<button class="btn btn-primary" type="submit" name="enviar" id="enviar">Enviar</button> 
			</div>
		</div>
	</form>
</div>
<div class="col-md-3 col-lg-3 col-xs-3 col-sm-3">
	
</div>