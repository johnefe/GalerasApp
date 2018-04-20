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
	$active_clientes="";
	$active_usuarios="active";	
	$title="Usuarios | Sys-Galeras";

	$usuario=$_SESSION['user_id']; 
	
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<?php include("head.php");?>
  </head>
  <body>
 	<?php
	include("navbar.php");
	include("modal/registro_usuarios.php");
	include("modal/editar_usuarios.php");
	include("modal/cambiar_password.php");
	if($usuario==1){ 
?>

	<section class="container bg-gris section-1">
		<div class="row my-5   mx-0">
			<div class="col-lg-12 my-3 ">
					<div class="pt-md-3 pb-md-4">
					    <h1 class="bd-title mt-0">Módulo Usuarios</h1>
					    <p class="bd-lead">Aqui puedes registrar o actualizar información usuarios del sistema.</p>
					    <a data-toggle="modal" data-target="#myModal" class="btn btn-lg btn-new">Registrar nuevo Usuario</a>
					  </div>
				
			</div>

		</div>
		
	</section>
	<section class="container">
		<div class="">
            <form class="form-horizontal" role="form" id="datos_cotizacion">
            
                <div class="form-group row">
                  
                  <div class="col-lg-11 col-md-11 col-sm-11">
                    <input type="text" class="form-control" id="q" placeholder="Escribir nombre de Usuario" onkeyup='load(1);'>
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
	</section>
	<hr>
		
	<?php
	 }else{
	 	?>

	 	<section class="container">
		<div class="msj text-center">
 

            <h2 style="color: black;">Sitio no autorizado</h2>
    
          </div>
	</section>

	 	<?php
	  	
	  }
	include("footer.php");

	?>
	<script type="text/javascript" src="js/usuarios.js"></script>

	
	


  </body>
</html>
<script>
$( "#guardar_usuario" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/nuevo_usuario.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax").html(datos);
			$('#guardar_datos').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})

$( "#editar_usuario" ).submit(function( event ) {
  $('#actualizar_datos2').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/editar_usuario.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax2").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax2").html(datos);
			$('#actualizar_datos2').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})

$( "#editar_password" ).submit(function( event ) {
  $('#actualizar_datos3').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/editar_password.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax3").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax3").html(datos);
			$('#actualizar_datos3').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})
	function get_user_id(id){
		$("#user_id_mod").val(id);
	}

	function obtener_datos(id){
			var nombres = $("#nombres"+id).val();
			var apellidos = $("#apellidos"+id).val();
			var usuario = $("#usuario"+id).val();
			var email = $("#email"+id).val();
			
			$("#mod_id").val(id);
			$("#firstname2").val(nombres);
			$("#lastname2").val(apellidos);
			$("#user_name2").val(usuario);
			$("#user_email2").val(email);
			
		}
</script>