<?php
	include('is_logged.php');
	if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['mod_descripcion'])) {
        	$errors[] = "No hay descripcion";
        } else if (empty($_POST['mod_valor'])){
			$errors[] = "Valor activo vacio";
		} else if (
			!empty($_POST['mod_id']) &&
			!empty($_POST['mod_descripcion']) &&
			!empty($_POST['mod_valor']) 
		){

		require_once ("../config/db.php");
		require_once ("../config/conexion.php");
		$descripcion=mysqli_real_escape_string($con,(strip_tags($_POST["mod_descripcion"],ENT_QUOTES)));
		$valor_activo=floatval($_POST['mod_valor']);
		$id_activo=$_POST['mod_id'];
		$date_added=date("Y-m-d H:i:s");
		$sql="UPDATE activos SET descripcion='".$descripcion."', valor='".$valor."', fecha='".$date_added."'  WHERE id_activo='".$id_activo."'";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "Activo ha sido actualizado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>