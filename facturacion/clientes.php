<?php
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	
	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$active_ventas="";
	$active_compras="";
	$active_productos="";
	$active_proveedores="";
	$active_clientes="active";
	$active_usuarios="";	
	$title="Clientes | Sys-Galeras";	
	
?>	
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("head.php");?>
  </head>
  <body>
  	
<?php
	include("navbar.php");
	include("modal/registro_clientes.php");
	include("modal/editar_clientes.php");
?>
			

	<section class="container bg-gris section-1">
		<div class="row my-5   mx-0">
			<div class="col-lg-12 my-3 ">
					<div class="pt-md-3 pb-md-4">
					    <h1 class="bd-title mt-0">Módulo Clientes</h1>
					    <p class="bd-lead">Aqui puedes registrar o actualizar información de tus clientes.</p>
					    <a data-toggle="modal" data-target="#nuevoCliente" class="btn btn-lg btn-new">Registrar nuevo Cliente</a>
					  </div>
				
			</div>

		</div>
		
	</section>
	<section class="container">
		<div class="">
            <form class="form-horizontal" role="form" id="datos_cotizacion">
            
                <div class="form-group row">
                  
                  <div class="col-lg-11 col-md-11 col-sm-11">
                    <input type="text" class="form-control" id="q" placeholder="Escribir nombre de Cliente" onkeyup='load(1);'>
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
	</section>
	<hr>
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/clientes.js"></script>
  </body>
</html>
