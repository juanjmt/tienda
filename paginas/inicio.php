<div class="row">
	<?php 
		if(isset($_GET['pag'])){
			$pag=$_GET['pag'];
		}else{
			$pag=1;
		}

		echo ListadoProductos($pag,8,'frontend');?>
	
</div>