<?php
include('is_logged.php');
	if (empty($_POST['descripcion'])) {
           $errors[] = "descripcion vacía";
        } else if (empty($_POST['valor'])){
			$errors[] = "Valor del activo vacío";
		} else if (
			!empty($_POST['descripcion']) &&
			!empty($_POST['valor'])
		){
		require_once ("../config/db.php");
		require_once ("../config/conexion.php");
		$descripcion=mysqli_real_escape_string($con,(strip_tags($_POST["descripcion"],ENT_QUOTES)));
		$valor=floatval($_POST['valor']);
		$date_added=date("Y-m-d H:i:s");
		$sql="INSERT INTO activos (descripcion, fecha, valor) VALUES ('$descripcion','$date_added','$valor')";
		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "Activo ha sido registrado satisfactoriamente.";
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