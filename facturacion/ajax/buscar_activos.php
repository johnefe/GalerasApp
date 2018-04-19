<?php

	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	//Archivo de funciones PHP
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
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('descripcion', 'valor_gasto');//Columnas de busqueda
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
		$reload = './activos.php';
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
					<th>id</th>
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
						
						<td><?php echo $id_activo; ?></td>
						<td ><?php echo $descripcion; ?></td>
						<td><?php echo $date_added;?></td>
						<td><span class='pull-right'><?php echo number_format($valor,0);?></span></td>
					<td ><span class="pull-right">
					<a href="#" class='btn btn-default' title='Editar Activo' onclick="obtener_datos('<?php echo $id_activo;?>');" data-toggle="modal" data-target="#myModal2"><span class="fa fa-pencil-square-o fa-1x icono-table"></span></a> 
					<a href="#" class='btn btn-default' title='Borrar Activo' onclick="eliminar('<?php echo $id_activo; ?>')"><span class="fa fa-trash fa-1x icono-table"></span> </a></span></td>
						
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