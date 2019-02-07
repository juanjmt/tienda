<?php 
		VerificarSession();
		global $conexion;
		if (isset($_GET['accion']) && !empty($_GET['accion'])){
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
				case 'editar':
					$nombre=$_POST['nombre'];
					$categoria=$_POST['categoria'];
					$marca=$_POST['marca'];
					$precio=$_POST['precio'];
					$presentacion=$_POST['presentacion'];
					$stock=$_POST['stock'];
					$imgprod=$_FILES['imgprod'];
					$idProducto=$_POST['idProducto'];

					editarProductos($idProducto,$nombre,$categoria,$marca,$precio,$presentacion,$stock,$imgprod);
				break;
				case 'delete':
					$idProducto=$_GET['idpro'];
					eliminarProducto($idProducto);
				break;
			}
		}
		if (isset($_GET['metodo']) && !empty($_GET['metodo'])){
			switch ($_GET['metodo']) {
				case 'edit':
					$res=ConsultaProducto($_GET['idpro']);
					$accion='editar';
					$res=explode('||',$res);
					$idProducto=$res[0];
					$nombre=$res[1];
					$categoria=$res[4];
					$mar=$res[3];
					$precio=$res[2];
					$presentacion=$res[5];
					$stock=$res[6];
					$imgprod=$res[7];
				break;
				case 'new':
					$accion='guardar';
					$idProducto='';
					$nombre='';
					$categoria='';
					$mar='';
					$precio='';
					$presentacion='';
					$stock='';
					$imgprod='';
					
				break;
			}
		}
?>
<div class="row">
	<div class="col-md-3 col-lg-3 col-xs-3 col-sm-3">
	
</div>
<div class="col-md-6 col-lg-6 col-xs-6 col-sm-6">
	<h4 class="">Registro de Producto</h4>
	<form action="?p=productos&accion=<?php echo $accion; ?>" method="POST" enctype="multipart/form-data">
		<div class="form-group">
			<div class="row">
				<label>Nombre: </label>
				<input type="text" class="form-control" placeholder="Nombre" name="nombre" id="nombre" value="<?php echo $nombre; ?>">
			</div>
			<input type="hidden" name="idProducto" id="idProducto" value="<?php echo $idProducto;  ?>">
			<br>
			<div class="row">
				<label>Categoria: </label>
				<select class="form-control" name="categoria" id="categoria">
					<option>Elija una categoria...</option>
					<?php
						$categorias = $conexion->prepare("SELECT * FROM categorias");
						$categorias->execute();
						while ($cate=$categorias->fetch()) {
							if ($categoria==$cate['idCategoria']){
								echo '<option selected value='.$cate['idCategoria'].'>'.$cate['Nombre'].'</option>';
							}else{
								echo '<option value='.$cate['idCategoria'].'>'.$cate['Nombre'].'</option>';
							}
							
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
								if ($mar==$marca['idMarca']){
									echo '<option selected value='.$marca["idMarca"].'>'.$marca["Nombre"].'</option>'; 
								}else{
									echo '<option value='.$marca["idMarca"].'>'.$marca["Nombre"].'</option>'; 
								}
							} 
						?>
			</select>
			</div>
			<br>
			<div class="row">
				<label>Precio: </label>	
				<input type="text" class="form-control" placeholder="Precio" name="precio" id="precio" value="<?php echo $precio; ?>">
			</div>
			<br>
			<div class="row">
				<label>Presentacion: </label>	
				<input type="text" class="form-control" placeholder="Presentación" name="presentacion" id="presentacion" value="<?php echo $presentacion; ?>">
			</div>
			<br>
			<div class="row">
				<label>Stock: </label>	
				<input type="text" class="form-control" placeholder="Stock" name="stock" id="stock" value="<?php echo $stock; ?>">
			</div>
			<br>
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<label>Imagen: </label>	
					<input type="file" name="imgprod" id="imgprod">
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<?php 
					if ($imgprod!=''){
						echo '<img src="imagenes/productos/'.$imgprod.'" alt="" class="img-rounded" height="50px" widht="50px">';
					}
					?>
				</div>
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