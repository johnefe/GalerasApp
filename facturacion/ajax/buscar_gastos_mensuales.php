<?php

	
	include('is_logged.php');
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");
	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$id_gastos=intval($_GET['id']);
		$del1="delete from gastos where id_gastos='".$id_gastos."'";
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

         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
         $q=strtolower($q);
		  $sTable = "gastos";
		 $sWhere = "";
		 $sWhere.=" ";
		if ( $_GET['q'] != "" )
			$q = $_GET['q'];
		 $q=strtolower($q);
		{
		if($q== "enero"){
			 $sWhere.=" WHERE gastos.id_gastos= falta poner  and (SELECT DATE_FORMAT(gastos.fecha,'%M'))= 'January'";

		}else if($q== "febrero"){
			 $sWhere.=" WHERE facturas.id_cliente=clientes.id_cliente and facturas.id_vendedor=users.user_id and (SELECT DATE_FORMAT(facturas.fecha_factura,'%M'))= 'February'";
		}else if($q== "marzo"){
			 $sWhere.=" WHERE facturas.id_cliente=clientes.id_cliente and facturas.id_vendedor=users.user_id and (SELECT DATE_FORMAT(facturas.fecha_factura,'%M'))= 'march'";
		}else if($q== "abril"){
			 $sWhere.=" WHERE facturas.id_cliente=clientes.id_cliente and facturas.id_vendedor=users.user_id and (SELECT DATE_FORMAT(facturas.fecha_factura,'%M'))= 'april'";
		}if($q== "mayo"){
			 $sWhere.=" WHERE facturas.id_cliente=clientes.id_cliente and facturas.id_vendedor=users.user_id and (SELECT DATE_FORMAT(facturas.fecha_factura,'%M'))= 'may'";

		}else if($q== "junio"){
			 $sWhere.=" WHERE facturas.id_cliente=clientes.id_cliente and facturas.id_vendedor=users.user_id and (SELECT DATE_FORMAT(facturas.fecha_factura,'%M'))= 'june'";
		}else if($q== "julio"){
			 $sWhere.=" WHERE facturas.id_cliente=clientes.id_cliente and facturas.id_vendedor=users.user_id and (SELECT DATE_FORMAT(facturas.fecha_factura,'%M'))= 'july'";
		}else if($q== "agosto"){
			 $sWhere.=" WHERE facturas.id_cliente=clientes.id_cliente and facturas.id_vendedor=users.user_id and (SELECT DATE_FORMAT(facturas.fecha_factura,'%M'))= 'August'";
		}if($q== "septiembre"){
			 $sWhere.=" WHERE facturas.id_cliente=clientes.id_cliente and facturas.id_vendedor=users.user_id and (SELECT DATE_FORMAT(facturas.fecha_factura,'%M'))= 'september'";

		}else if($q== "octubre"){
			 $sWhere.=" WHERE facturas.id_cliente=clientes.id_cliente and facturas.id_vendedor=users.user_id and (SELECT DATE_FORMAT(facturas.fecha_factura,'%M'))= 'october'";
		}else if($q== "noviembre"){
			 $sWhere.=" WHERE facturas.id_cliente=clientes.id_cliente and facturas.id_vendedor=users.user_id and (SELECT DATE_FORMAT(facturas.fecha_factura,'%M'))= 'november'";
		}else if($q== "diciembre"){
			 $sWhere.=" WHERE facturas.id_cliente=clientes.id_cliente and facturas.id_vendedor=users.user_id and (SELECT DATE_FORMAT(facturas.fecha_factura,'%M'))= 'december'";
		}
	
		}
		
		$sWhere.=" order by facturas.id_factura desc";


		include 'pagination.php'; 
		
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; 
		$adjacents  = 4;
		$offset = ($page - 1) * $per_page;
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './facturas.php';
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		$sumaMensual=0;
		$compraMensual =0;
		$ganaciasMesuales=0;
		$sql_delete="DELETE FROM tmp ";
		$query_delete = mysqli_query($con, $sql_delete);
		if($q == "enero" || $q == "marzo" || $q == "febrero" || $q == "abril" || $q == "mayo" || $q == "junio"  || $q == "julio"  || $q == "agosto"  || $q == "septiembre"  || $q == "octubre"  || $q == "noviembre"  || $q == "diciembre"){   

		if ($numrows>0){
			echo mysqli_error($con);
			?>
			<div class="table-responsive ">
			  <table class="table table-striped table-facturas datos">
				<tr  class="info header-table">
					<th class="">#</th>
					<th>Fecha</th>
					<th>Cliente</th>
					<th>Vendido por</th>
					<th>Estado</th>
					<th class='text-center'>Total</th>
					<th class='text-center'>Acciones</th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id_factura=$row['id_factura'];
						$numero_factura=$row['numero_factura'];
						$fecha=date("d/m/Y", strtotime($row['fecha_factura']));
						$nombre_cliente=$row['nombre_cliente'];
						$telefono_cliente=$row['telefono_cliente'];
						$email_cliente=$row['email_cliente'];
						$nombre_vendedor=$row['firstname']." ".$row['lastname'];
						$estado_factura=$row['estado_factura'];
						if ($estado_factura==1){$text_estado="Pagada";$label_class='label-success';}
						else{$text_estado="Pendiente";$label_class='label-warning';}
						$total_venta=$row['total_venta'];
						$sumaMensual= $sumaMensual + $row['total_venta'];
						$compraMensual=$compraMensual + $row['total_compra'];
					?>
					<tr>
						<td><?php echo $numero_factura; ?></td>
						<td><?php echo $fecha; ?></td>
						<td><?php echo $nombre_cliente;?></td>
						<td><?php echo $nombre_vendedor; ?></td>
						<td><span class="label <?php echo $label_class;?>"><?php echo $text_estado; ?></span></td>
						<td class='text-center'><?php echo number_format ($total_venta,0); ?></td>					
					<td class="text-center">
						<a href="editar_factura.php?id_factura=<?php echo $id_factura;?>" class='btn btn-default' title='Editar factura' ><span class=""><img src="img/iconos/edit.png"></span></a> 
						<a href="#" class='btn btn-default' title='Descargar factura' onclick="imprimir_factura('<?php echo $id_factura;?>');"><span class=""><img src="img/iconos/printer.png"></span></a> 
						
						<a href="#" class='btn btn-default' title='Borrar factura' onclick="eliminar('<?php echo $numero_factura; ?>')"><span class=""><img src="img/iconos/garbage.png"></span> </a>
						
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
			<div class="col-lg-12 text-center">
				<h4>Ventas del mes de <?php echo $q; ?> : $ <?php echo $sumaMensual;?> -- Ganancias mensuales: $ <?php $ganaciasMesuales = $sumaMensual - $compraMensual; echo $ganaciasMesuales; ?></h4>
			</div>
			<?php
			

		}
		}
	}
?>		
		
		
	