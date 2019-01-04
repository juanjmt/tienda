<?php 
	require 'paginas/headers.php';
	require 'admin/funciones.php';
	require 'admin/conexion.php';
	
	if (isset($_GET['p'])){
		$pagina=$_GET['p'];
	}else{
		$pagina='inicio';
	}
	

?>
<section id="cargaConetendio">

	<?php 
		if (isset($_GET['men'])){
			$mensaje=Mensajes($_GET['men']);
			echo $mensaje;
		}

		CambioContenido($pagina);
	?>

</section>
		
<?php 
	require 'paginas/footer.php';

?>