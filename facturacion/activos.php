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
	$title="Activos | Sys-Galeras";
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
					    <h1 class="bd-title mt-0">Módulo Activos</h1>
					    <p class="bd-lead">Aqui puedes registrar o actualizar de los activos que esten dentro o hagan parte del negocio</p>
					    <a data-toggle="modal" data-target="#nuevoGasto" class="btn btn-lg btn-new">Registrar nuevo activo</a>
					  </div>
				
			</div>
			 <?php
                                  
                     $select_tmp=mysqli_query($con,"SELECT * FROM activos");
                                 // $row= mysqli_fetch_array($select_tmp);
                                  $total_activos=0;
                                  while ($row=mysqli_fetch_array($select_tmp)){ 
                                    
                                   	$total_activos=$total_activos+$row['valor'];
                                      
                                }
                ?> 
			<div class="col-lg-12">
				<div class="row text-center"> 
					<div class="col-lg-3 col-sm-6">
						<h4 class="bd-title mt-0 titulo-1">Total activos: <?php echo number_format ($total_activos,0); ?></h4>
					</div>				
				</div>
			</div>

		</div>
		
		
	</section>
    <div class="container">
	<div class="panel panel-info">
		
		<div class="panel-body">
		
			<?php
			include("modal/registro_activos.php");
			include("modal/editar_activos.php");
			?>
			<form class="form-horizontal" role="form" id="datos_cotizacion">
				
						<div class="form-group row">
							
							<div class="col-lg-11 col-md-11 col-sm-11">
								<input type="text" class="form-control" id="q" placeholder="Nombre del activo" onkeyup='load(1);'>
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
	<script type="text/javascript" src="js/activos.js"></script>
  </body>
</html>
<script>


$( "#guardar_activo" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/nuevo_activo.php",
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


$( "#editar_activo" ).submit(function( event ) {
  $('#actualizar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/editar_activos.php",
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
			var valor= $("#valor"+id).val();
			
			$("#mod_id").val(id);
			$("#mod_descripcion").val(descripcion);
			$("#mod_valor").val(valor);
		}
</script>