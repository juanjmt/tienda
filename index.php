<?php 
	require 'paginas/headers.php';
	require 'paginas/funciones.php';
	
	if (isset($_GET['p'])){
		$pagina=$_GET['p'];
	}else{
		$pagina='inicio';
	}
	

?>
<section>
	<?php 
		CambioContenido($pagina);
	?>

</section>
		
<?php 
	require 'paginas/footer.php';

?>