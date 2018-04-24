<?php
include('is_logged.php');
$id_compra= $_SESSION['id_compra'];
$numero_compra= $_SESSION['numero_compra'];
if (isset($_POST['id'])){
	$id=intval($_POST['id']);
}
if (isset($_POST['cantidad'])){
	$cantidad=intval($_POST['cantidad']);
}
if (isset($_POST['precio_compra'])){
	$precio_compra=floatval($_POST['precio_compra']);
}

	require_once ("../config/db.php");
	require_once ("../config/conexion.php");

	include("../funciones.php");


if (!empty($id) and !empty($cantidad) and !empty($precio_compra))
{

	$select_tmp_detalle_compra=mysqli_query($con,"SELECT* FROM detalle_compra where id_producto='".$id."' and numero_compra='".$numero_compra."' ");
	$row= mysqli_fetch_array($select_tmp_detalle_compra);

	if($row == ""){

		$insert_tmp=mysqli_query($con, "INSERT INTO detalle_compra (numero_compra, id_producto,cantidad,precio_compra) VALUES ('$numero_compra','$id','$cantidad','$precio_compra')");

	}else{
		$cantidad_old=$row['cantidad'];
		$cantidad_new = $cantidad + $cantidad_old;
		$update_tmp=mysqli_query($con, "UPDATE detalle_compra SET cantidad='".$cantidad_new."' where id_producto='".$id."' and numero_compra='".$numero_compra."' ");
	}


}
if (isset($_GET['id']))
$id_detalle=intval($_GET['id']);	
$delete=mysqli_query($con, "DELETE FROM detalle_compra WHERE id_detalle='".$id_detalle."'");
}
$simbolo_moneda=get_row('perfil','moneda', 'id_perfil', 1);
?>
<table class="table table-striped table-facturas datos">
<tr class="info header-table">
	<th class='text-center'>CODIGO</th>
	<th class='text-center'>CANT.</th>
	<th>DESCRIPCION</th>
	<th class='text-right'>PRECIO UNIT.</th>
	<th class='text-right'>PRECIO TOTAL</th>
	<th></th>
</tr>
<?php
	$sumador_total=0;
	$sql=mysqli_query($con, "select * from products, compras, detalle_compra where compras.numero_compra=detalle_compra.numero_compra and  compras.id_compra='$id_compra' and products.id_producto=detalle_compra.id_producto");
	while ($row=mysqli_fetch_array($sql))
	{
	$id_detalle=$row["id_detalle"];
	$codigo_producto=$row['codigo_producto'];
	$cantidad=$row['cantidad'];
	$nombre_producto=$row['nombre_producto'];
	
	
	$precio_compra=$row['precio_compra'];
	$precio_compra_f=number_format($precio_compra,0);
	$precio_compra_r=str_replace(",","",$precio_compra_f);
	$precio_total=$precio_compra_r*$cantidad;
	$precio_total_f=number_format($precio_total,0);
	$precio_total_r=str_replace(",","",$precio_total_f);
	$sumador_total+=$precio_total_r;
	
		?>
		<tr>
			<td class='text-center'><?php echo $codigo_producto;?></td>
			<td class='text-center'><?php echo $cantidad;?></td>
			<td><?php echo $nombre_producto;?></td>
			<td class='text-right'><?php echo $precio_compra_f;?></td>
			<td class='text-right'><?php echo $precio_total_f;?></td>
			<td class='text-center'><a href="#" onclick="eliminar('<?php echo $id_detalle ?>')"><i class="glyphicon glyphicon-trash"></i></a></td>
		</tr>		
		<?php
	}

	$subtotal=number_format($sumador_total,0,'.','');
	$total_compra=$subtotal;
	$update=mysqli_query($con,"update compras set total_compra='$total_compra' where id_compra='$id_compra'");
	
?>

<tr class="header-table">
	<td class='text-right' colspan=4>TOTAL <?php echo $simbolo_moneda;?></td>
	<td class='text-right'><?php echo number_format($total_compra,0);?></td>
	<td></td>
</tr>

</table>
