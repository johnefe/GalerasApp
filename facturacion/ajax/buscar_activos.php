<?php

	include('is_logged.php');
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");
	include("../funciones.php");
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$id_activo=intval($_GET['id']);
		$query=mysqli_query($con, "select * from activos where id_activo='".$id_activo."'");
		$count=mysqli_num_rows($query);
		if ($count >0){
			if ($delete1=mysqli_query($con,"DELETE FROM activos WHERE id_activo='".$id_activo."'")){
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos eliminados exitosamente.
			</div>
			<?php 
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
			</div>
			<?php
			
		}
			
		}	
	}
	if($action == 'ajax'){
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('descripcion', 'valor_gasto');
		 $sTable = "activos";
		 $sWhere = "";
		if ( $_GET['q'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		$sWhere.=" order by id_activo desc";
		include 'pagination.php'; 
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 4; 
		$adjacents  = 4;
		$offset = ($page - 1) * $per_page;
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './activos.php';

		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);

		if ($numrows>0){

			?>
			<div class="table-responsive">
			  <table class="table table-striped table-facturas datos">
				<tr  class="info header-table">
					
					<th>descripcion</th>
					<th>Agregado</th>
					<th class='text-right'>Valor activo</th>
					<th class='text-right'>Acciones</th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id_activo=$row['id_activo'];
						$descripcion=$row['descripcion'];
						$date_added= date('d/m/Y', strtotime($row['fecha']));
						$valor=$row['valor'];
					?>
					

					<input type="hidden" value="<?php echo $descripcion;?>" id="descripcion<?php echo $id_activo;?>">


					<input type="hidden" value="<?php echo number_format($valor,0,'.','');?>" id="valor<?php echo $id_activo;?>">
					<tr>
						
						<td ><?php echo $descripcion; ?></td>
						<td><?php echo $date_added;?></td>
						<td><span class='pull-right'><?php echo number_format($valor,0);?></span></td>
					<td ><span class="pull-right">
					<a href="#" class='btn btn-default' title='Editar Activo' onclick="obtener_datos('<?php echo $id_activo;?>');" data-toggle="modal" data-target="#myModal2"><span class=""><img src="img/iconos/edit.png"></span></a> 
					<a href="#" class='btn btn-default' title='Borrar Activo' onclick="eliminar('<?php echo $id_activo; ?>')"><span class=""><img src="img/iconos/garbage.png"></span> </a></span></td>
						
					</tr>
					<?php
				}
				?>
				<tr class="header-table">
					<td colspan=8><span class="pull-right">
					<?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>
			<?php
		}
	}
?>