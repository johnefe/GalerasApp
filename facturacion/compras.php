<?php
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	
	$active_compras="active";
	$active_facturas="";
	$active_productos="";
	$active_ventas="";
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
    <div class="container">
		<div class="panel panel-info">
		<div class="panel-heading">
		    <div class="btn-group pull-right">
				<a  href="nueva_compra.php" class="btn btn-info"><span class="glyphicon glyphicon-plus" ></span> Nueva compra</a>
			</div>
			<h4><i class='glyphicon glyphicon-th'></i> MODULO DE COMPRAS</h4>
		</div>
			<div class="panel-body">
				<form class="form-horizontal" role="form" id="datos_cotizacion">
				
						<div class="form-group row">
							
							<div class="col-md-10">
								<input type="text" class="form-control" id="q" placeholder="Escribir nombre del proveedor o número de Factura de Compra" onkeyup='load(1);'>
							</div>
							
							
							
							<div class="col-md-2">
								<button type="button" class="btn btn-default" onclick='load(1);'>
									<span class="glyphicon glyphicon-search" ></span> Buscar</button>
								<span id="loader"></span>
							</div>
							
						</div>
				
				
				
			</form>
				<div id="resultados"></div><!-- Carga los datos ajax -->
				<div class='outer_div'></div><!-- Carga los datos ajax -->
			</div>
		</div>	
		
	</div>
	<hr>
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script type="text/javascript" src="js/compras.js"></script>
  </body>
</html>