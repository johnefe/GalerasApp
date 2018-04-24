<?php

	
	include('is_logged.php');
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");
	
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
		//$sql_delete="DELETE FROM tmp ";
		//$query_delete = mysqli_query($con, $sql_delete);

		if ($numrows>0){
			echo mysqli_error($con);
			?>
			<div class="table-responsive ">
			  <table class="table table-striped table-facturas datos">
				<tr  class="info header-table">
				
					<th>Fecha</th>
					<th>descripción</th>
					<th class='text-center'>valor</th>
					<th class='text-center'>Acciones</th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id_gastos=$row['id_gastos'];
						//$numero_factura=$row['numero_factura'];
						$fecha=date("d/m/Y", strtotime($row['fecha']));
						//$nombre_cliente=$row['nombre_cliente'];
						//$telefono_cliente=$row['telefono_cliente'];
						//$email_cliente=$row['email_cliente'];
						//$nombre_vendedor=$row['firstname']." ".$row['lastname'];
						//$estado_factura=$row['estado_factura'];
						//if ($estado_factura==1){$text_estado="Pagada";$label_class='label-success';}
						//else{$text_estado="Pendiente";$label_class='label-warning';}
						$total_gasto=$row['valor_gasto'];
						$descripcion=$row['descripcion'];
					?>
					<tr>
						
						<td><?php echo $fecha; ?></td>
						<td><?php echo $descripcion; ?></td>
						
						<td class='text-center'><?php echo number_format ($total_gasto,0); ?></td>					
					<td class="text-center">
						<a href="editar_gasto.php?id_gastos=<?php echo $id_gastos;?>" class='btn btn-default' title='Editar gasto' ><span class=""><img src="img/iconos/edit.png"></span></a> 
						<!--<a href="#" class='btn btn-default' title='Descargar factura' onclick="imprimir_factura('<?php echo $id_factura;?>');"><span class=""><img src="img/iconos/printer.png"></span></a> -->
						
						<a href="#" class='btn btn-default' title='Borrar gasto' onclick="eliminar('<?php echo $numero_factura; ?>')"><span class=""><img src="img/iconos/garbage.png"></span> </a>
						
					</td>
						
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