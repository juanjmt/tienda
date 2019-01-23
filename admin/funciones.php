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
			case 'noimagen':
				$men='<div class="alert alert-danger alert-dismissible" role="alert">
  					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  						Error, Debe Cargar una imagen
				</div>';
			break;
			case 'eliminado':
				$men='<div class="alert alert-success alert-dismissible" role="alert">
  						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  						Registro eliminado con exito
				</div>';
			break;
			case 'erroreliminar':
				$men='<div class="alert alert-danger alert-dismissible" role="alert">
  					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  						Error, No se puede eliminar
				</div>';
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
	function guardarProductos($nombre,$categoria,$marca,$precio,$presentacion,$stock,$imgprod){
		global $conexion;
		$directorio = "imagenes/productos/".$imgprod["name"];
		if( move_uploaded_file($imgprod["tmp_name"], $directorio ) == true ){
			$prod = $conexion->prepare("SELECT * FROM productos WHERE Nombre = :Nombre");
			$prod->bindParam(":Nombre", $nombre, PDO::PARAM_STR);
			if($prod->execute() && $prod->rowCount()==0){
				$producto = $conexion->prepare("INSERT INTO productos (Nombre, Precio, Marca, Categoria, Presentacion, Stock, Imagen) VALUES (:Nombre, :Precio, :Marca, :Categoria, :Presentacion, :Stock, :Imagen)");
				$producto->bindParam(":Nombre", $nombre, PDO::PARAM_STR);
				$producto->bindParam(":Precio", $precio, PDO::PARAM_STR);
				$producto->bindParam(":Marca", $marca, PDO::PARAM_INT);
				$producto->bindParam(":Categoria", $categoria, PDO::PARAM_INT);
				$producto->bindParam(":Presentacion", $presentacion, PDO::PARAM_STR);
				$producto->bindParam(":Stock", $stock, PDO::PARAM_INT);
				$producto->bindParam(":Imagen", $imgprod["name"], PDO::PARAM_STR);
				if ($producto->execute()){
					$mensaje='guardado';
					header("Location: index.php?p=productos&men=$mensaje");
				}else{
					$mensaje='errorguardar';
					header("Location: index.php?p=productos&men=$mensaje");
				}


			}else{
				$mensaje='duplicado';
				header("Location:index.php?p=productos&men=$mensaje");
			}

		}else{
			$mensaje='noimagen';
			header("Location:index.php?p=productos&men=$mensaje");
		}

	}
	function ListadoProductos($pag,$limite){
		global $conexion;
		$posicion = ($pag - 1) * $limite;
		$productos = $conexion->prepare("SELECT p.Nombre as nompro, p.idProducto, p.precio, p.presentacion,p.Imagen, m.Nombre as nommarca, c.Nombre as nomcate FROM productos as p, marcas as m, categorias as c where m.idMarca=p.Marca and c.idCategoria=p.Categoria LIMIT :posicion, :limite");
		$productos->bindParam(":posicion", $posicion, PDO::PARAM_INT);
		$productos->bindParam(":limite", $limite, PDO::PARAM_INT);
		$productos->execute();
		$info='<table class="table table-striped"><tr><th>#</th><th>Nombre</th><th>Presentación</th><th>Precio</th><th>Marca</th><th>Categoria</th><th>Imagen</th><th colspan="2">Acción</th></tr>';
		$i=1;
		while ($pro=$productos->fetch()) {
			$info.='<tr><td>'.$i.'</td><td>'.$pro['nompro'].'</td><td>'.$pro['presentacion'].'</td><td>'.$pro['precio'].'</td> <td>'.$pro['nommarca'].'</td><td>'.$pro['nomcate'].'</td><td><img src="imagenes/productos/'.$pro['Imagen'].'" alt="" class="img-rounded" height="50px" widht="50px"></td>
			<td><a href="?p=productos&metodo=edit&idpro='.$pro['idProducto'].'" ><i style="font-size:20px; cursor:pointer;" class="glyphicon glyphicon-pencil"></i></a></td>
			<td><a href="?p=productos&accion=delete&idpro='.$pro['idProducto'].'"><i style="font-size:20px; cursor:pointer;" class="glyphicon glyphicon-remove"></i></a></td></tr>';
			$i++;
		}
		$info.='</table>';
		// solo para sacar la cantidad de registros
		$productosn = $conexion->prepare("SELECT count(*) FROM productos");
		$productosn->execute();
		$total_filas = $productosn->fetchColumn();

		$cantpag=ceil($total_filas/$limite);
		//para pagina anterior
		if ($pag>1){
			$anterior=$pag-1;
		}else{
			$anterior=$pag;
		}

		//para pagina siguiente
		if ($pag<$cantpag){
			$siguiente=$pag+1;
		}else{
			$siguiente=$pag;
		}



		$info.='<nav style="float:right;" aria-label="Page navigation">
		  <ul class="pagination">
		    <li>
		      <a href="?p=administrar&pag='.$anterior.'" aria-label="Previous">
		        <span aria-hidden="true">&laquo;</span>
		      </a>
		    </li>';
		    $pagi=1;
		    for ($i=1; $i <= $cantpag ; $i++) { 
		    	
		    	$info.='<li><a href="?p=administrar&pag='.$i.'">'.$i.'</a></li>';
		    }

		    $info.='<li>
		      <a href="?p=administrar&pag='.$siguiente.'" aria-label="Next">
		        <span aria-hidden="true">&raquo;</span>
		      </a>
		    </li>
		  </ul>
		</nav>';

		return $info;

	}

	function ConsultaProducto($id){
		global $conexion;
		$productos = $conexion->prepare("SELECT * FROM productos WHERE idProducto=:idProducto");
		$productos->bindParam(":idProducto", $id, PDO::PARAM_INT);
		$productos->execute();
		$pro=$productos->fetch();
		$info=$pro['idProducto'].'||'.$pro['Nombre'].'||'.$pro['Precio'].'||'.$pro['Marca'].'||'.$pro['Categoria'].'||'.$pro['Presentacion'].'||'.$pro['Stock'].'||'.$pro['Imagen'];

		return $info;
	}

	function editarProductos($idProducto,$nombre,$categoria,$marca,$precio,$presentacion,$stock,$imgprod){
		global $conexion;
		$directorio = "imagenes/productos/".$imgprod["name"];
		if( move_uploaded_file($imgprod["tmp_name"], $directorio ) == true ){
			$imagen=$imgprod["name"];
			//$producto = $conexion->prepare("UPDATE productos SET Nombre = :Nombre, Precio = :Precio, Marca = :Marca, Categoria = :Catagoria, Presentacion = :Presentacion, Stock = :Stock, Imagen = :Imagen WHERE idProducto = :idProducto");
			$producto = "UPDATE productos SET Nombre = '$nombre', Precio = '$precio', Marca = '$marca', Categoria = '$categoria', Presentacion = '$presentacion', Stock = '$stock', Imagen = '$imagen' WHERE idProducto ='$idProducto'";
			$producto = $conexion->prepare($producto);


			if ($producto->execute()){
				$mensaje='guardado';
				header("Location: index.php?p=administrar&men=$mensaje");
			}else{
				$mensaje='errorguardar';
				header("Location: index.php?p=productos&men=$mensaje");
			}

		}else{
			$mensaje='noimagen';
			header("Location:index.php?p=productos&men=$mensaje");
		}

		return $producto;
	}
	function eliminarProducto($idProducto){
		global $conexion;
		$sql = "DELETE FROM productos  WHERE idProducto ='$idProducto'";
		if ($conexion->exec($sql)){
			$mensaje='eliminado';
			header("Location: index.php?p=administrar&men=$mensaje");
		}else{
			$mensaje='erroreliminar';
			header("Location: index.php?p=administrar&men=$mensaje");
		}
		
	}
	
?>