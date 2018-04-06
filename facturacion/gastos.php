<?php
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }

	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	

	$active_gastos="active";	
	$title="Productos | Sys-Galeras";
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
					    <h1 class="bd-title mt-0">Módulo Gastos</h1>
					    <p class="bd-lead">Aqui puedes registrar o actualizar de los gastos realizados en el establecimiento.</p>
					    <a data-toggle="modal" data-target="#nuevoGasto" class="btn btn-lg btn-new">Registrar nuevo gasto</a>
					  </div>
				
			</div>
			 <?php
                                  
                     $select_tmp=mysqli_query($con,"SELECT * FROM products");
                                 // $row= mysqli_fetch_array($select_tmp);
                                  $productos_compra=0;
                                  $productos_venta=0;
                                  $ganancias_diarias=0;
                                  while ($row=mysqli_fetch_array($select_tmp)){ 
                                    
                                   	$cantidad_producto=$row['stock']*$row['precio_producto']; 
                                   	$cantidad_venta=$row['stock']*$row['precio_compra'];
                                     $productos_compra= $productos_compra + $cantidad_producto;
                                     $productos_venta = $productos_venta + 	$cantidad_venta;
                                    
                                    }
                                    
              
					
					$row_cnt = mysqli_num_rows($select_tmp);
                ?> 
			<div class="col-lg-12">
				<div class="row text-center"> 
					<div class="col-lg-3 col-sm-6">
						
					</div>				
				</div>
			</div>

		</div>
		
		
	</section>
    <div class="container">
	<div class="panel panel-info">
		
		<div class="panel-body">
		
			<?php
			include("modal/registro_productos.php");
			include("modal/editar_productos.php");
			?>
			<form class="form-horizontal" role="form" id="datos_cotizacion">
				
						<div class="form-group row">
							
							<div class="col-lg-11 col-md-11 col-sm-11">
								<input type="text" class="form-control" id="q" placeholder="Nombre del gasto" onkeyup='load(1);'>
							</div>
							<div class="col-lg-1 col-md-1 col-sm-1 text-left">
								<button type="button" class="btn btn-default" onclick='load(1);'>
									<span class="fa fa-search fa-1x" ></span></button>
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
	<script type="text/javascript" src="js/gastos.js"></script>
  </body>
</html>
<script>
$( "#guardar_gasto" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/nuevo_gasto.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax_productos").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax_productos").html(datos);
			$('#guardar_datos').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})

$( "#editar_gasto" ).submit(function( event ) {
  $('#actualizar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/editar_gasto.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax2").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax2").html(datos);
			$('#actualizar_datos').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})

	function obtener_datos(id){
			var descripcion = $("#descripcion"+id).val();
			var valor_gasto= $("#valor_gasto"+id).val();
			
			$("#mod_id").val(id);
			$("#mod_decripcion").val(descripcion);
			$("#mod_valor_gasto").val(valor_gasto);
		}
</script>