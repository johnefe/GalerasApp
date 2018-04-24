<?php
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	$active_facturas="";
	$active_productos="";
	$active_clientes="";
	$active_usuarios="";
	$active_proveedores="";
	$active_compras="active";	
	$title="Editar Compra | Sys-Galeras";

	require_once ("config/db.php");
	require_once ("config/conexion.php");
	
	if (isset($_GET['id_compra']))
	{
		$id_compra=intval($_GET['id_compra']);
		$campos="proveedores.id_proveedor, proveedores.nombre_proveedor, proveedores.telefono_proveedor, proveedores.email_proveedor, compras.id_vendedor, compras.fecha_compra, compras.condiciones, compras.estado_compra, compras.numero_compra";
		$sql_compra=mysqli_query($con,"select $campos from compras, proveedores where compras.id_proveedor=proveedores.id_proveedor and id_compra='".$id_compra."'");
		$count=mysqli_num_rows($sql_compra);
		if ($count==1)
		{
				$rw_compra=mysqli_fetch_array($sql_compra);
				$id_proveedor=$rw_compra['id_proveedor'];
				$nombre_proveedor=$rw_compra['nombre_proveedor'];
				$telefono_proveedor=$rw_compra['telefono_proveedor'];
				$email_proveedor=$rw_compra['email_proveedor'];
				$id_vendedor_db=$rw_compra['id_vendedor'];
				$fecha_compra=date("d/m/Y", strtotime($rw_compra['fecha_compra']));
				$condiciones=$rw_compra['condiciones'];
				$estado_compra=$rw_compra['estado_compra'];
				$numero_compra=$rw_compra['numero_compra'];
				$_SESSION['id_compra']=$id_compra;
				$_SESSION['numero_compra']=$numero_compra;
		}	
		else
		{
			header("location: compras.php");
			exit;	
		}
	} 
	else 
	{
		header("location: compras.php");
		exit;
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("head.php");?>
  </head>
  <body>
	<?php
	include("navbar.php");
	include("modal/buscar_productos.php");
	include("modal/registro_proveedores.php");
	include("modal/registro_productos.php");
	?> 
	<section class="container bg-gris section-1">
		<div class="row my-5   mx-0">
			<div class="col-lg-12 my-3 ">
				<div class="pt-md-3 pb-md-4">
					<a href="compras.php" class="btn btn-lg btn-new"><span class="fa fa-arrow-left fa-1x"></span></a>				   					    
				 </div>		
			</div>
		</div>	
	</section> 
    <div class="container">
	<div class="panel panel-info">
		
		<div class="panel-body">
		<?php 
			
		?>
			<form class="form-horizontal" role="form" id="datos_factura">
				<div class="form-group row">
				  <label for="nombre_cliente" class="col-md-1 control-label">Proveedor</label>
				  <div class="col-md-3">
					  <input type="text" class="form-control input-sm" id="nombre_proveedor" placeholder="Selecciona un proveedor" required value="<?php echo $nombre_proveedor;?>">
					  <input id="id_proveedor" name="id_proveedor" type='hidden' value="<?php echo $id_proveedor;?>">	
				  </div>
				  <label for="tel1" class="col-md-1 control-label">Teléfono</label>
							<div class="col-md-2">
								<input type="text" class="form-control input-sm" id="tel1" placeholder="Teléfono" value="<?php echo $telefono_proveedor;?>" readonly>
							</div>
					<label for="mail" class="col-md-1 control-label">Email</label>
							<div class="col-md-4">
								<input type="text" class="form-control input-sm" id="mail" placeholder="Email" readonly value="<?php echo $email_proveedor;?>">
							</div>
				 </div>
						<div class="form-group row">
							<label for="empresa" class="col-md-1 control-label">Vendedor</label>
							<div class="col-md-3">
								<select class="form-control input-sm" id="id_vendedor" name="id_vendedor">
									<?php
										$sql_vendedor=mysqli_query($con,"select * from users order by lastname");
										while ($rw=mysqli_fetch_array($sql_vendedor)){
											$id_vendedor=$rw["user_id"];
											$nombre_vendedor=$rw["firstname"]." ".$rw["lastname"];
											if ($id_vendedor==$id_vendedor_db){
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
							<label for="tel2" class="col-md-1 control-label">Fecha</label>
							<div class="col-md-2">
								<input type="text" class="form-control input-sm" id="fecha" value="<?php echo $fecha_compra;?>" readonly>
							</div>
							<label for="email" class="col-md-1 control-label">Pago</label>
							<div class="col-md-2">
								<select class='form-control input-sm ' id="condiciones" name="condiciones">
									<option value="1" <?php if ($condiciones==1){echo "selected";}?>>Efectivo</option>
									<option value="2" <?php if ($condiciones==2){echo "selected";}?>>Cheque</option>
									<option value="3" <?php if ($condiciones==3){echo "selected";}?>>Transferencia bancaria</option>
									<option value="4" <?php if ($condiciones==4){echo "selected";}?>>Crédito</option>
								</select>
							</div>
							<div class="col-md-2">
								<select class='form-control input-sm ' id="estado_compra" name="estado_compra">
									<option value="1" <?php if ($estado_compra==1){echo "selected";}?>>Pagado</option>
									<option value="2" <?php if ($estado_compra==2){echo "selected";}?>>Pendiente</option>
								</select>
							</div>
						</div>
				
				
				<div class="col-md-12">
					<div class="pull-right">
						<button type="submit" class="btn btn-default">
						  <span class="glyphicon glyphicon-refresh"></span> Actualizar datos
						</button>
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
						 <span class="glyphicon glyphicon-search"></span> Agregar productos
						</button>
						<button type="button" class="btn btn-default" onclick="imprimir_compra('<?php echo $id_compra;?>')">
						  <span class="glyphicon glyphicon-print"></span> Imprimir
						</button>
					</div>	
				</div>
			</form>	
			<div class="clearfix"></div>
				<div class="editar_compra" class='col-md-12' style="margin-top:10px"></div><!-- Carga los datos ajax -->	
			
		<div id="resultados" class='col-md-12' style="margin-top:10px"></div><!-- Carga los datos ajax -->			
			
		</div>
	</div>		
		 
	</div>
	<hr>
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script type="text/javascript" src="js/editar_compra.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script>
		$(function() {
						$("#nombre_proveedor").autocomplete({
							source: "./ajax/autocomplete/proveedores.php",
							minLength: 2,
							select: function(event, ui) {
								event.preventDefault();
								$('#id_proveedor').val(ui.item.id_proveedor);
								$('#nombre_proveedor').val(ui.item.nombre_proveedor);
								$('#tel1').val(ui.item.telefono_proveedor);
								$('#mail').val(ui.item.email_proveedor);
																
								
							 }
						});
						 
						
					});
					
	$("#nombre_proveedor" ).on( "keydown", function( event ) {
						if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
						{
							$("#id_proveedor" ).val("");
							$("#tel1" ).val("");
							$("#mail" ).val("");
											
						}
						if (event.keyCode==$.ui.keyCode.DELETE){
							$("#nombre_proveedor" ).val("");
							$("#id_proveedor" ).val("");
							$("#tel1" ).val("");
							$("#mail" ).val("");
						}
			});	
	</script>

  </body>
</html>