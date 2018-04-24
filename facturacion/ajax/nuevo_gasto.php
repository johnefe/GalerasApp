<?php
include('is_logged.php');
	if (empty($_POST['descripcion'])) {
           $errors[] = "descripcion vacía";
        } else if (empty($_POST['valor_gasto'])){
			$errors[] = "Valor del gasto vacío";
		} else if (
			!empty($_POST['descripcion']) &&
			!empty($_POST['valor_gasto'])
		){

		require_once ("../config/db.php");
		require_once ("../config/conexion.php");
		$descripcion=mysqli_real_escape_string($con,(strip_tags($_POST["descripcion"],ENT_QUOTES)));
		$valor_gasto=floatval($_POST['valor_gasto']);
		$date_added=date("Y-m-d H:i:s");
		$sql="INSERT INTO gastos (descripcion, fecha, valor_gasto) VALUES ('$descripcion','$date_added','$valor_gasto')";
		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "Gasto ha sido registrado satisfactoriamente.";
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