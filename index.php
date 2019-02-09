<?php 
	error_reporting(E_ALL);
	ini_set("display_errors", 1);

	require 'paginas/headers.php';
	require 'admin/funciones.php';
	require 'admin/conexion.php';
	
	if (isset($_GET['p'])){
		$pagina=$_GET['p'];
	}else{
		$pagina='inicio';
	}
	if (isset($_COOKIE['VISITAS'])){
		$visitas=$_COOKIE['VISITAS']+1;
		setcookie("VISITAS",$visitas,time() + 365 * 24 * 60 * 60);
		echo $_COOKIE['VISITAS'];
	}else{
		$visitas=1;
		setcookie("VISITAS",$visitas,time() + 365 * 24 * 60 * 60);
		echo $_COOKIE['VISITAS'];
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