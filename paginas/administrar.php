<?php
	VerificarSession();
	if(isset($_GET['pag'])){
		$pag=$_GET['pag'];
	}else{
		$pag=1;
	}
?>

<div class="row">
	<div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
		<a href="?p=productos&metodo=new"><button class="btn btn-primary">Agregar Productos</button></a>
	</div>
	<div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
		<a href="?p=productos&accion=descarga"><button class="btn btn-primary">Descarga Inventario</button></a>
	</div>
</div>
<br>
<br>
<div class="row">
	<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
		<?php echo ListadoProductos($pag,5,'administrar');?>
	</div>
</div>