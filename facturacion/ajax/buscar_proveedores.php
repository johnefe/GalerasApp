<?php

	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$id_proveedor=intval($_GET['id']);
		$query=mysqli_query($con, "select * from compras where id_proveedor='".$id_proveedor."'");
		
		$count=mysqli_num_rows($query);
		if ($count==0){
			if ($delete1=mysqli_query($con,"DELETE FROM proveedores WHERE id_proveedor='".$id_proveedor."'")){
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
			
		} else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se pudo eliminar éste  proveedor. Existen facturas de compras vinculadas a éste. 
			</div>
			<?php
		}
		
		
		
	}
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('nombre_proveedor');//Columnas de busqueda
		 $sTable = "proveedores";
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
		$sWhere.=" order by nombre_proveedor";
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
		$reload = './proveedores.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			
			?>
			<div class="table-responsive">
			  <table class="table table-striped table-facturas datos">
				<tr  class="info header-table">
					<th>Nombre</th>
					<th>Teléfono</th>
					<th>Email</th>
					<th>Dirección</th>
					<th>Estado</th>
					<th>Agregado</th>
					<th class='text-right'>Acciones</th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id_proveedor=$row['id_proveedor'];
						$nombre_proveedor=$row['nombre_proveedor'];
						$telefono_proveedor=$row['telefono_proveedor'];
						$email_proveedor=$row['email_proveedor'];
						$direccion_proveedor=$row['direccion_proveedor'];
						$status_proveedor=$row['status_proveedor'];
						if ($status_proveedor==1){$estado="Activo";}
						else {$estado="Inactivo";}
						$date_added= date('d/m/Y', strtotime($row['date_added']));
						
					?>
					
					<input type="hidden" value="<?php echo $nombre_proveedor;?>" id="nombre_proveedor<?php echo $id_proveedor;?>">
					<input type="hidden" value="<?php echo $telefono_proveedor;?>" id="telefono_proveedor<?php echo $id_proveedor;?>">
					<input type="hidden" value="<?php echo $email_proveedor;?>" id="email_proveedor<?php echo $id_proveedor;?>">
					<input type="hidden" value="<?php echo $direccion_proveedor;?>" id="direccion_proveedor<?php echo $id_proveedor;?>">
					<input type="hidden" value="<?php echo $status_proveedor;?>" id="status_proveedor<?php echo $id_proveedor;?>">
					
					<tr>
						
						<td><?php echo $nombre_proveedor; ?></td>
						<td ><?php echo $telefono_proveedor; ?></td>
						<td><?php echo $email_proveedor;?></td>
						<td><?php echo $direccion_proveedor;?></td>
						<td><?php echo $estado;?></td>
						<td><?php echo $date_added;?></td>
						
					<td ><span class="pull-right">
					<a href="#" class='btn btn-default' title='Editar proveedor' onclick="obtener_datos('<?php echo $id_proveedor;?>');" data-toggle="modal" data-target="#myModal2"><span class="fa fa-pencil-square-o fa-1x icono-table"></span></a> 
					<a href="#" class='btn btn-default' title='Borrar proveedor' onclick="eliminar('<?php echo $id_proveedor; ?>')"><span class="fa fa-trash fa-1x icono-table"></span> </a></span></td>
						
					</tr>
					<?php
				}
				?>
				<tr class="header-table">
					<td colspan=7><span class="pull-right">
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