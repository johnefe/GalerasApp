<?php

	
	include('is_logged.php');
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");
		$usuario=$_SESSION['user_id']; 
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$id_factura=intval($_GET['id']);
		$del1="delete from gastos where id_gastos='".$id_factura."'";
		//$del2="delete from detalle_factura where numero_factura='".$numero_factura."'";
		if ($delete1=mysqli_query($con,$del1)){
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos eliminados exitosamente
			</div>
			<?php 
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se puedo eliminar los datos
			</div>
			<?php
			
		}
	}
	if($action == 'ajax'){
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['z'], ENT_QUOTES)));
		  $sTable = "gastos";
		 $sWhere = "";
		 $sWhere.=" WHERE LEFT(gastos.fecha,10)=CURDATE()";
		
		$sWhere.=" order by gastos.id_gastos desc";


		include 'pagination.php'; 

		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; 
		$adjacents  = 4;
		$offset = ($page - 1) * $per_page;
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './gastos_diarios.php';
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);

		if ($numrows>0){
			echo mysqli_error($con);
			?>
			<div class="table-responsive ">
			  <table class="table table-striped table-facturas datos">
				<tr  class="info header-table">
				
					<th>Fecha</th>
					<th>descripción</th>
					<th class='text-center'>valor</th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id_gasto=$row['id_gastos'];
						$fecha=date("d/m/Y", strtotime($row['fecha']));
						$total_gasto=$row['valor_gasto'];
						$descripcion=$row['descripcion'];
					?>
					<tr>
						
						<td><?php echo $fecha; ?></td>
						<td><?php echo $descripcion; ?></td>
						
						<td class='text-center'><?php echo number_format ($total_gasto,0); ?></td>					
						
					</tr>
					<?php
				}
				?>
				<tr class="header-table">
					<td colspan=7><span class="pull-right"><?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>
			<?php
		}
	}
?>

