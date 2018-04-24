<?php

	include('is_logged.php');
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");
	$usuario=$_SESSION['user_id']; 

	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$numero_compra=intval($_GET['id']);
		$del1="delete from compras where numero_compra='".$numero_compra."'";
		$del2="delete from detalle_compra where numero_compra='".$numero_compra."'";
		if ($delete1=mysqli_query($con,$del1) and $delete2=mysqli_query($con,$del2)){
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
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		  $sTable = "compras, proveedores, users";
		 $sWhere = "";
		 $sWhere.=" WHERE compras.id_proveedor=proveedores.id_proveedor and compras.id_vendedor=users.user_id";
		if ( $_GET['q'] != "" )
		{
		$sWhere.= " and  (proveedores.nombre_proveedor like '%$q%' or compras.numero_compra like '%$q%')";
			
		}
		$sWhere.=" order by compras.id_compra desc";
		include 'pagination.php'; 
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 4; 
		$adjacents  = 4; 
		$offset = ($page - 1) * $per_page;
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './compras.php';
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);

		$sql_delete="DELETE FROM tmp_compras ";
		$query_delete = mysqli_query($con, $sql_delete);
		if ($numrows>0){
			echo mysqli_error($con);
			?>
			<div class="table-responsive">
			  <table class="table table-striped table-facturas datos">
				<tr  class="info header-table">
					<th>#</th>
					<th>Fecha</th>
					<th>proveedor</th>
					<th>Vendedor</th>
					<th>Estado</th>
					<th class='text-center'>Total</th>
					<th class='text-center'>Acciones</th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id_compra=$row['id_compra'];
						$numero_compra=$row['numero_compra'];
						$fecha=date("d/m/Y", strtotime($row['fecha_compra']));
						$nombre_proveedor=$row['nombre_proveedor'];
						$telefono_proveedor=$row['telefono_proveedor'];
						$email_proveedor=$row['email_proveedor'];
						$nombre_vendedor=$row['firstname']." ".$row['lastname'];
						$estado_compra=$row['estado_compra'];
						if ($estado_compra==1){$text_estado="Pagada";$label_class='label-success';}
						else{$text_estado="Pendiente";$label_class='label-warning';}
						$total_compra=$row['total_compra'];
					?>
					<tr>
						<td><?php echo $numero_compra; ?></td>
						<td><?php echo $fecha; ?></td>
						<td><?php echo $nombre_proveedor;?></td>
						<td><?php echo $nombre_vendedor;?></td>
						<td><span class="label <?php echo $label_class;?>"><?php echo $text_estado; ?></span></td>
						<td class='text-right'><?php echo number_format ($total_compra,0); ?></td>					
					<td class="text-right">
						<a href="editar_compra.php?id_compra=<?php echo $id_compra;?>" class='btn btn-default' title='Editar compra' ><span class=""><img src="img/iconos/edit.png"></a> 
						<a href="#" class='btn btn-default' title='Descargar facctura de compra' onclick="imprimir_compra('<?php echo $id_compra;?>');"><span class=""><img src="img/iconos/printer.png"></span></a> 
						<?php if($usuario==1){ ?>
						<a href="#" class='btn btn-default' title='Borrar compra' onclick="eliminar('<?php echo $numero_compra; ?>')"><span class=""><img src="img/iconos/garbage.png"></span> </a>
						<?php   } ?>
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