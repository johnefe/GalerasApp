<?php
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	
	$active_ventas="";
	$active_compras="active";
	$active_productos="";
	$active_proveedores="";
	$active_clientes="";
	$active_usuarios="";	
	$title="Compras | Sys-Galeras";

?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<?php include("head.php");?>

  </head>
  <body>
	<?php
	include("navbar.php");
	?>  
	<section class="container bg-gris section-1">
		<div class="row my-5   mx-0">
			<div class="col-lg-12 my-3 ">
					<div class="pt-md-3 pb-md-4">
					    <h1 class="bd-title mt-0">Módulo Compras</h1>
					    <p class="bd-lead">Aqui puedes realizar una nueva compra a un proveedor o pueder buscar una compra realizada a un proveedor en especifico</p>
					    <a href="nueva_compra.php" class="btn btn-lg btn-new">Realizar una nueva compra</a>
					  </div>
				
			</div>

		</div>
		
	</section>
    <section class="container">
		<div class="panel panel-info">
		
			<div class="">
				<form class="form-horizontal" role="form" id="datos_cotizacion">
				
						<div class="form-group row">
							
							<div class="col-lg-11 col-md-11 col-sm-11">
								<input type="text" class="form-control" id="q" placeholder="Escribir nombre del proveedor o número de Factura de Compra" onkeyup='load(1);'>
							</div>
							
							
							
							 <div class="col-lg-1 col-md-1 col-sm-1 text-left">
								<button type="button" class="btn btn-default" onclick='load(1);'>
									<span class="" ><img src="img/iconos/search.png" style="width: 90%;height: 90%;"></span></button>
								<span id="loader"></span>
							</div>
							
						</div>
				
				
				
			</form>
				<div id="resultados"></div><!-- Carga los datos ajax -->
				<div class='outer_div'></div><!-- Carga los datos ajax -->
			</div>
		</div>	
		
	</section>
	<hr>
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script type="text/javascript" src="js/compras.js"></script>
  </body>
</html>