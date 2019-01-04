<?php 
		global $conexion;
		if (isset($_GET['accion'])){
			switch ($_GET['accion']) {
				case 'guardar':
					$nombre=$_POST['nombre'];
					$categoria=$_POST['categoria'];
					$marca=$_POST['marca'];
					$precio=$_POST['precio'];
					$presentacion=$_POST['presentacion'];
					$stock=$_POST['stock'];
					$imgprod=$_FILES['imgprod'];

					guardarProductos($nombre,$categoria,$marca,$precio,$presentacion,$stock,$imgprod);
				break;
				
				
			}
		}
?>
<div class="row">
	<div class="col-md-3 col-lg-3 col-xs-3 col-sm-3">
	
</div>
<div class="col-md-6 col-lg-6 col-xs-6 col-sm-6">
	<h4 class="">Registro de Producto</h4>
	<form action="?p=productos&accion=guardar" method="POST" enctype="multipart/form-data">
		<div class="form-group">
			<div class="row">
				<label>Nombre: </label>
				<input type="text" class="form-control" placeholder="Nombre" name="nombre" id="nombre">
			</div>
			<br>
			<div class="row">
				<label>Categoria: </label>
				<select class="form-control" name="categoria" id="categoria">
					<option>Elija una categoria...</option>
					<?php
						$categorias = $conexion->prepare("SELECT * FROM categorias");
						$categorias->execute();
						while ($cate=$categorias->fetch()) {
							echo '<option value='.$cate['idCategoria'].'>'.$cate['Nombre'].'</option>';
						}

					?>
				</select>

				
			</div>
			<br>
			<div class="row">
				<label>Marca: </label>	
				<select class="form-control" name="marca" id="marca">
						<option>Elija una marca...</option>
						<?php
							
							$marcas = $conexion->prepare("SELECT * FROM marcas");
							$marcas->execute();
							while ($marca = $marcas->fetch()){
									echo '<option value='.$marca["idMarca"].'>'.$marca["Nombre"].'</option>'; 
							} 
						?>
			</select>
			</div>
			<br>
			<div class="row">
				<label>Precio: </label>	
				<input type="text" class="form-control" placeholder="Precio" name="precio" id="precio">
			</div>
			<br>
			<div class="row">
				<label>Presentacion: </label>	
				<input type="text" class="form-control" placeholder="Presentación" name="presentacion" id="presentacion">
			</div>
			<br>
			<div class="row">
				<label>Stock: </label>	
				<input type="text" class="form-control" placeholder="Stock" name="stock" id="stock">
			</div>
			<br>
			<div class="row">
				<label>Imagen: </label>	
				<input type="file" name="imgprod" id="imgprod">
			</div>
			<br>
			<div class="row text-center">
				<button class="btn btn-primary" type="submit" name="guardar" id="guardar">Guardar</button> 
			</div>
		</div>
	</form>
</div>
<div class="col-md-3 col-lg-3 col-xs-3 col-sm-3">
	
</div>
	
</div>