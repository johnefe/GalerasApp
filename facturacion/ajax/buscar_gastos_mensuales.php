<?php

	
	include('is_logged.php');
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");
	include("../funciones.php");
	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$id_gastos=intval($_GET['id']);
		$del1="delete from gastos where id_gastos='".$id_gastos."'";
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
			 $sWhere.=" WHERE (SELECT DATE_FORMAT(gastos.fecha,'%M'))= 'January'";

		}else if($q== "febrero"){
			 $sWhere.=" WHERE (SELECT DATE_FORMAT(gastos.fecha,'%M'))= 'February'";
		}else if($q== "marzo"){
			 $sWhere.=" WHERE (SELECT DATE_FORMAT(gastos.fecha,'%M'))= 'march'";
		}else if($q== "abril"){
			 $sWhere.=" WHERE (SELECT DATE_FORMAT(gastos.fecha,'%M'))= 'april'";
		}if($q== "mayo"){
			 $sWhere.=" WHERE (SELECT DATE_FORMAT(gastos.fecha,'%M'))= 'may'";

		}else if($q== "junio"){
			 $sWhere.=" WHERE (SELECT DATE_FORMAT(gastos.fecha,'%M'))= 'june'";
		}else if($q== "julio"){
			 $sWhere.=" WHERE (SELECT DATE_FORMAT(gastos.fecha,'%M'))= 'july'";
		}else if($q== "agosto"){
			 $sWhere.=" WHERE (SELECT DATE_FORMAT(gastos.fecha,'%M'))= 'August'";
		}if($q== "septiembre"){
			 $sWhere.=" WHERE (SELECT DATE_FORMAT(gastos.fecha,'%M'))= 'september'";

		}else if($q== "octubre"){
			 $sWhere.=" WHERE (SELECT DATE_FORMAT(gastos.fecha,'%M'))= 'october'";
		}else if($q== "noviembre"){
			 $sWhere.=" WHERE (SELECT DATE_FORMAT(gastos.fecha,'%M'))= 'november'";
		}else if($q== "diciembre"){
			 $sWhere.=" WHERE (SELECT DATE_FORMAT(gastos.fecha,'%M'))= 'december'";
		}
	
		}
		
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
		$reload = './gastos_mensuales.php';
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		$sumaGastos=0;
		$sql_delete="DELETE FROM tmp ";
		$query_delete = mysqli_query($con, $sql_delete);
		if($q == "enero" || $q == "marzo" || $q == "febrero" || $q == "abril" || $q == "mayo" || $q == "junio"  || $q == "julio"  || $q == "agosto"  || $q == "septiembre"  || $q == "octubre"  || $q == "noviembre"  || $q == "diciembre"){   

		if ($numrows>0){
			echo mysqli_error($con);
			?>
			<div class="table-responsive ">
			  <table class="table table-striped table-facturas datos">
				<tr  class="info header-table">

					<th>Fecha</th>
					<th>Descripción</th>
					<th class='text-center'>Valor</th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id_gasto=$row['id_gastos'];
						$fecha=date("d/m/Y", strtotime($row['fecha']));
						$descripcion=$row['descripcion'];
						$valor_gasto=$row['valor_gasto'];
						$sumaGastos= $sumaGastos + $row['valor_gasto'];

					?>
					<tr>
						<td><?php echo $fecha; ?></td>
						<td><?php echo $descripcion; ?></td>
						<td class='text-center'><?php echo number_format ($valor_gasto,0); ?></td>
						
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
				<h4>Gastos del mes de <?php echo $q; ?> : $ <?php echo $sumaGastos;?></h4>
			</div>
			<?php
			

		}
		}
	}
?>		
		
		
	