<?php
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	$active_facturas="active";
	$active_productos="";
	$active_clientes="";
	$active_usuarios="";	
	$title="Nueva Factura | Simple Invoice";
	
	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
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
	<!-- -->
	 <section class="container bg-gris section-1">
		<div class="row my-5   mx-0">
			<div class="col-lg-12 my-3 ">
				<div class="pt-md-3 pb-md-4">
					<a href="facturas.php" class="btn btn-lg btn-new"><span class="fa fa-arrow-left fa-1x"></span></a>				   					    
				 </div>		
			</div>
		</div>	
	</section>
	<section class="container bg-gris">
		<div class="col-md-12 order-md-1">
          <h4 class="mb-3">Datos del cliente</h4>
          <?php 
			include("modal/buscar_productos.php");
			include("modal/registro_clientes.php");
			include("modal/registro_productos.php");
		?>
          <form class="needs-validation" ole="form" id="datos_factura">
            <div class="row">
              <div class="col-lg-4 col-md-4 mb-3">
                <label for="firstName">Cliente</label>
                <input type="text" class="form-control" id="nombre_cliente" placeholder="Selecciona un cliente" required>
                 <input id="id_cliente"  type='hidden'>
                <div class="invalid-feedback">
                  Se requiere un cliente, si no tiene ingrese anonimo
                </div>
              </div>

              <div class="col-lg-4 col-md-4 mb-3">
                <label for="tel1">Teléfono</label>
                <input type="text" class="form-control" id="tel1" placeholder="Teléfono" readonly>
              </div>
              <div class="col-lg-4 col-md-4 mb-3">
                <label for="mail">Correo</label>
                <input type="text" class="form-control" id="mail" placeholder="Email" readonly>
              </div>
              <div class="col-lg-4 col-md-4 mb-3">
                <label for="empresa">Vendedor</label>
                <select class="form-control " id="id_vendedor">
					<?php

						$sql_vendedor=mysqli_query($con,"select * from users order by lastname");
							while ($rw=mysqli_fetch_array($sql_vendedor)){
								$id_vendedor=$rw["user_id"];
								$nombre_vendedor=$rw["firstname"]." ".$rw["lastname"];
									if ($id_vendedor==$_SESSION['user_id']){
											$selected="selected";
									} else {
											$selected="";
										}
					?>
					<option value="<?php echo $id_vendedor?>" <?php echo $selected;?>><?php echo $nombre_vendedor?></option>
					<?php
							}
					?>
					</select>
              </div>

				<div class="col-lg-4 col-md-4 mb-3">
					 <label for="fecha">Fecha</label>
						   <input type="text" class="form-control" id="fecha" value="<?php echo date("Y/m/d");?>" readonly>		   
				</div>

				<div class="col-lg-4 col-md-4 mb-3">
					<label for="firstName">Pago</label>
						    <select class='form-control input-sm' id="condiciones">
								<option value="1">Efectivo</option>
								<option value="2">Cheque</option>
								<option value="3">Transferencia bancaria</option>
								<option value="4">Crédito</option>
							</select>
				</div>
          	</div>
          	<div class="row">
          		<div class="col-md-12 order-md-1">
			<div class="pull-right">
					
						<button type="button" class="btn btn-lg btn-new" data-toggle="modal" data-target="#nuevoCliente">
						 <span class="fa fa-user fa-1x"></span> Nuevo cliente
						</button>
						<button type="button" class="btn btn-lg btn-new" data-toggle="modal" data-target="#myModal">
						 <span class="fa fa-search fa-1x"></span> Agregar productos
						</button>
						<button type="submit" class="btn btn-lg btn-new" title="Guardar e imprimir">Guardar e Imprimir </button>
					</div>	
		</div>
          	</div>
          </form>
    	</div>	
	</section>
	

	<!-- -->

    <div class="container">
	<div class="panel panel-info">
		<div class="panel-body">
		
		<div id="resultados" class='col-md-12' style="margin-top:10px"></div><!-- Carga los datos ajax -->			
		</div>
	</div>		
		  
	</div>
	<hr>
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script type="text/javascript" src="js/nueva_factura.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script>
		$(function() {
						$("#nombre_cliente").autocomplete({
							source: "./ajax/autocomplete/clientes.php",
							minLength: 2,
							select: function(event, ui) {
								event.preventDefault();
								$('#id_cliente').val(ui.item.id_cliente);
								$('#nombre_cliente').val(ui.item.nombre_cliente);
								$('#tel1').val(ui.item.telefono_cliente);
								$('#mail').val(ui.item.email_cliente);
																
								
							 }
						});
						 
						
					});
					
	$("#nombre_cliente" ).on( "keydown", function( event ) {
						if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
						{
							$("#id_cliente" ).val("");
							$("#tel1" ).val("");
							$("#mail" ).val("");
											
						}
						if (event.keyCode==$.ui.keyCode.DELETE){
							$("#nombre_cliente" ).val("");
							$("#id_cliente" ).val("");
							$("#tel1" ).val("");
							$("#mail" ).val("");
						}
			});	
	</script>

  </body>
</html>