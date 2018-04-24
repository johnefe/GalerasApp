<?php
include('is_logged.php');
$id_factura= $_SESSION['id_factura'];
$numero_factura= $_SESSION['numero_factura'];
if (isset($_POST['id'])){
	$id=intval($_POST['id']);
}
if (isset($_POST['cantidad'])){
	$cantidad=intval($_POST['cantidad']);
}
if (isset($_POST['precio_venta'])){
	$precio_venta=floatval($_POST['precio_venta']);
}

	require_once ("../config/db.php");
	require_once ("../config/conexion.php");

	include("../funciones.php");

	


if (!empty($id) and !empty($cantidad) and !empty($precio_venta))
{

	$select_tmp_detalle_factura=mysqli_query($con,"SELECT* FROM detalle_factura where id_producto='".$id."' and numero_factura='".$numero_factura."' ");
	$row= mysqli_fetch_array($select_tmp_detalle_factura);

	if($row == ""){

		$insert_tmp=mysqli_query($con, "INSERT INTO detalle_factura (numero_factura, id_producto,cantidad,precio_venta) VALUES ('$numero_factura','$id','$cantidad','$precio_venta')");
	}else{
		$cantidad_old=$row['cantidad'];
		$cantidad_new = $cantidad + $cantidad_old;
		$update_tmp=mysqli_query($con, "UPDATE detalle_factura SET cantidad='".$cantidad_new."' where id_producto='".$id."' and numero_factura='".$numero_factura."' ");
	}


}


if (isset($_GET['id']))
{
$id_detalle=intval($_GET['id']);	
$delete=mysqli_query($con, "DELETE FROM detalle_factura WHERE id_detalle='".$id_detalle."'");
}
$simbolo_moneda=get_row('perfil','moneda', 'id_perfil', 1);
?>
<table class="table">
<tr class="header-table">
	<th class='text-center'>CODIGO</th>
	<th class='text-center'>CANT.</th>
	<th>DESCRIPCION</th>
	<th class='text-right'>PRECIO UNIT.</th>
	<th class='text-right'>PRECIO TOTAL</th>
	<th></th>
</tr>
<?php
	$sumador_total=0;
	$sql=mysqli_query($con, "select * from products, facturas, detalle_factura where facturas.numero_factura=detalle_factura.numero_factura and  facturas.id_factura='$id_factura' and products.id_producto=detalle_factura.id_producto");
	while ($row=mysqli_fetch_array($sql))
	{
	$id_detalle=$row["id_detalle"];
	$codigo_producto=$row['codigo_producto'];
	$cantidad=$row['cantidad'];
	$nombre_producto=$row['nombre_producto'];
	
	
	$precio_venta=$row['precio_venta'];
	$precio_venta_f=number_format($precio_venta,0);
	$precio_venta_r=str_replace(",","",$precio_venta_f);
	$precio_total=$precio_venta_r*$cantidad;
	$precio_total_f=number_format($precio_total,0);
	$precio_total_r=str_replace(",","",$precio_total_f);
	$sumador_total+=$precio_total_r;
	
		?>
		<tr>
			<td class='text-center'><?php echo $codigo_producto;?></td>
			<td class='text-center'><?php echo $cantidad;?></td>
			<td><?php echo $nombre_producto;?></td>
			<td class='text-right'><?php echo $precio_venta_f;?></td>
			<td class='text-right'><?php echo $precio_total_f;?></td>
			<td class='text-center'><a href="#" onclick="eliminar('<?php echo $id_detalle ?>')"><i class="glyphicon glyphicon-trash"></i></a></td>
		</tr>		
		<?php
	}
	
	$subtotal=number_format($sumador_total,0,'.','');
	$total_factura=$subtotal;
	$update=mysqli_query($con,"update facturas set total_venta='$total_factura' where id_factura='$id_factura'");
?>
<tr class="header-table">
	<td class='text-right' colspan=4>TOTAL <?php echo $simbolo_moneda;?></td>
	<td class='text-right'><?php echo number_format($total_factura,0);?></td>
	<td></td>
</tr>

</table>
