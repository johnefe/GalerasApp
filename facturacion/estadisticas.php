<?php
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	$usuario=$_SESSION['user_id']; 
	$active_estadisticas="active";	
	$title="Estadisticas | Sys-Galeras";
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
					    <h1 class="bd-title mt-0">Módulo Estadísticas</h1>
					    <p class="bd-lead">Aqui puedes las ventas diarias, semanales y mensuales que se hallan realizado. </p>
					    <a href="ventas_diarias.php" class="btn btn-lg btn-new">Ver ventas diarias</a>
					    <a href="ventas_semanales.php" class="btn btn-lg btn-new">Ver ventas específicas</a>
					  
					  </div>
				
			</div>

		</div>
		
	</section>
	
	<hr>
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script type="text/javascript" src="js/facturas.js"></script>
  </body>
</html>