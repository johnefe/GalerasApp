<?php
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	require_once ("config/db.php");
	require_once ("config/conexion.php");
	$active_facturas="";
	$active_productos="";
	$active_clientes="";
	$active_usuarios="";	
	$active_perfil="active";	
	$title="Configuración | Sys- Galeras";
	
	$query_empresa=mysqli_query($con,"select * from perfil where id_perfil=1");
	$row=mysqli_fetch_array($query_empresa);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<?php include("head.php");?>
  </head>
  <body>
 	<?php
	include("navbar.php");
		if($usuario==1){ 

	?> 
	 <section class="container bg-gris section-1">
		<div class="row my-5   mx-0">
			<div class="col-lg-12 my-3 ">
					<div class="pt-md-3 pb-md-4">
					    <h1 class="bd-title mt-0">Mi Perfil</h1>
					    <p class="bd-lead">Información de mi empresa</p>
					   
					  </div>
				
			</div>

		</div>
		
	</section>
	<div class="container">
      <div class="row">
      <form method="post" id="perfil">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 toppad" >
   
   
          <div class="panel panel-info">

            <div class="panel-body">
              <div class="row">
			  
                <div class="col-md-3 col-lg-3 img-perfil "> 
					<div>
						<img class="img-responsive" src="<?php echo $row['logo_url'];?>" alt="Logo">	
					</div>
					<br>				
					<div class="row">
  						<div class="col-md-12">
							<div class="form-group">
								<input class='filestyle' data-buttonText="Click aqui" type="file" name="imagefile" id="imagefile" onchange="upload_image();">
							</div>
						</div>
						
					</div>
				</div>
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-striped table-facturas datos">
                    <tbody>
                      <tr >
                        <td>Nombre de la empresa:</td>
                        <td><input type="text" class="form-control" name="nombre_empresa" value="<?php echo $row['nombre_empresa']?>" required></td>
                      </tr>
                      <tr>
                        <td>Teléfono:</td>
                        <td><input type="text" class="form-control input-sm" name="telefono" value="<?php echo $row['telefono']?>" required></td>
                      </tr>
                      <tr>
                        <td>Correo electrónico:</td>
                        <td><input type="email" class="form-control input-sm" name="email" value="<?php echo $row['email']?>" ></td>
                      </tr>
					  
					  <tr>
                        <td>Simbolo de moneda:</td>
                        <td>
							<select class='form-control input-sm' name="moneda" required>
										<?php 
											$sql="select name, symbol from  currencies group by symbol order by name ";
											$query=mysqli_query($con,$sql);
											while($rw=mysqli_fetch_array($query)){
												$simbolo=$rw['symbol'];
												$moneda=$rw['name'];
												if ($row['moneda']==$simbolo){
													$selected="selected";
												} else {
													$selected="";
												}
												?>
												<option value="<?php echo $simbolo;?>" <?php echo $selected;?>><?php echo ($simbolo);?></option>
												<?php
											}
										?>
							</select>
						</td>
                      </tr>
					  <tr>
                        <td>Dirección:</td>
                        <td><input type="text" class="form-control input-sm" name="direccion" value="<?php echo $row["direccion"];?>" required></td>
                      </tr>
					  <tr>
                        <td>Ciudad:</td>
                        <td><input type="text" class="form-control input-sm" name="ciudad" value="<?php echo $row["ciudad"];?>" required></td>
                      </tr>
					  <tr>
                        <td>Región/Provincia:</td>
                        <td><input type="text" class="form-control input-sm" name="estado" value="<?php echo $row["estado"];?>"></td>
                      </tr>
					  <tr>
                        <td>Código postal:</td>
                        <td><input type="text" class="form-control input-sm" name="codigo_postal" value="<?php echo $row["codigo_postal"];?>"></td>
                      </tr>
                   
                        
                     
                    </tbody>
                  </table>
                  
                  
                </div>
				<div class='col-md-12' id="resultados_ajax"></div><!-- Carga los datos ajax -->
              </div>
            </div>
            <div class="col-md-4 offset-4 panel-footer text-center">
                    
                 <button type="submit" class="form-control btn btn-sm btn-success"><i class="fa fa-refresh fa-1x"></i> ACTUALIZAR DATOS</button>          
            </div>
            
          </div>
        </div>
		</form>
      </div>

	</div>
	<br>
	<hr>
	<?php
	 }else{
	 	?>

	 	<section class="container">
		<div class="msj text-center">
 

            <h2 style="color: black;">Sitio no autorizado</h2><br>
            <img src="img/iconos/sad.png">
    
    
          </div>
	</section>

	 	<?php
	  	
	  }
	  include("footer.php");
	?>
  </body>
</html>
<script type="text/javascript" src="js/bootstrap-filestyle.js"> </script>
<script>
$( "#perfil" ).submit(function( event ) {
  $('.guardar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/editar_perfil.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax").html(datos);
			$('.guardar_datos').attr("disabled", false);

		  }
	});
  event.preventDefault();
})





		
</script>

<script>
		function upload_image(){
				
				var inputFileImage = document.getElementById("imagefile");
				var file = inputFileImage.files[0];
				if( (typeof file === "object") && (file !== null) )
				{
					$("#load_img").text('Cargando...');	
					var data = new FormData();
					data.append('imagefile',file);
					
					
					$.ajax({
						url: "ajax/imagen_ajax.php",        // Url to which the request is send
						type: "POST",             // Type of request to be send, called as method
						data: data, 			  // Data sent to server, a set of key/value pairs (i.e. form fields and values)
						contentType: false,       // The content type used when sending data to the server.
						cache: false,             // To unable request pages to be cached
						processData:false,        // To send DOMDocument or non processed data file it is set to false
						success: function(data)   // A function to be called if request succeeds
						{
							$("#load_img").html(data);
							
						}
					});	
				}
				
				
			}
    </script>

