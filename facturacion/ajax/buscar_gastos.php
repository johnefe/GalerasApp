<?php

	include('is_logged.php');
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");
	include("../funciones.php");
	$usuario=$_SESSION['user_id']; 
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$id_gastos=intval($_GET['id']);
		$query=mysqli_query($con, "select * from gastos where id_gastos='".$id_gastos."'");
		$count=mysqli_num_rows($query);
		if ($count >0){
			if ($delete1=mysqli_query($con,"DELETE FROM gastos WHERE id_gastos='".$id_gastos."'")){
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
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('descripcion', 'valor_gasto');//Columnas de busqueda
		 $sTable = "gastos";
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
		$sWhere.=" order by id_gastos desc";
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './gastos.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			//$simbolo_moneda=get_row('perfil','moneda', 'id_perfil', 1);
			?>
			<div class="table-responsive">
			  <table class="table table-striped table-facturas datos">
				<tr  class="info header-table">
				
					<th>descripcion</th>
					<th>Agregado</th>
					<th class='text-right'>Valor gasto</th>
					<th class='text-right'>Acciones</th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id_gasto=$row['id_gastos'];
						$descripcion=$row['descripcion'];
						$date_added= date('d/m/Y', strtotime($row['fecha']));
						$valor_gasto=$row['valor_gasto'];
					?>
					

					<input type="hidden" value="<?php echo $descripcion;?>" id="descripcion<?php echo $id_gasto;?>">


					<input type="hidden" value="<?php echo number_format($valor_gasto,0,'.','');?>" id="valor_gasto<?php echo $id_gasto;?>">
					<tr>
						
			
						<td ><?php echo $descripcion; ?></td>
						<td><?php echo $date_added;?></td>
						<td><span class='pull-right'><?php echo number_format($valor_gasto,0);?></span></td>
					<td ><span class="pull-right">
					<a href="#" class='btn btn-default' title='Editar gasto' onclick="obtener_datos('<?php echo $id_gasto;?>');" data-toggle="modal" data-target="#myModal2"><span class=""><img src="img/iconos/edit.png"></span></a> 
					<?php if($usuario==1){ ?>
					<a href="#" class='btn btn-default' title='Borrar gasto' onclick="eliminar('<?php echo $id_gasto; ?>')"><span class=""><img src="img/iconos/garbage.png"></span> </a></span> <?php  } ?>
				</td>
						
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