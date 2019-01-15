<?php
	global $conexion;

	$productos = $conexion->prepare("SELECT p.Nombre as nompro, p.precio, p.presentacion,p.Imagen, m.Nombre as nommarca, c.Nombre as nomcate FROM productos as p, marcas as m, categorias as c where m.idMarca=p.Marca and c.idCategoria=p.Categoria");
	$productos->execute();
	echo '<table class="table table-striped"><tr><th>#</th><th>Nombre</th><th>Presentación</th><th>Precio</th><th>Marca</th><th>Categoria</th><th>Imagen</th><th>Acción</th></tr>';
	$i=1;
	while ($pro=$productos->fetch()) {
		echo '<tr><td>'.$i.'</td><td>'.$pro['nompro'].'</td><td>'.$pro['presentacion'].'</td><td>'.$pro['precio'].'</td> <td>'.$pro['nommarca'].'</td><td>'.$pro['nomcate'].'</td><td><img src="imagenes/productos/'.$pro['Imagen'].'" alt="" class="img-rounded" height="50px" widht="50px"></td><td></td><td></td></tr>';
		$i++;
	}
	echo '</table>';

					

?>