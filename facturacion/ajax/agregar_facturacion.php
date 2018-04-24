<?php
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
$session_id= session_id();
if (isset($_POST['id'])){
	$id=$_POST['id'];
}
if (isset($_POST['cantidad'])){
	$cantidad=$_POST['cantidad'];
}
if (isset($_POST['precio_venta'])){
	$precio_venta=$_POST['precio_venta'];
}
if (isset($_POST['precio_compra'])){
	$precio_compra=$_POST['precio_compra'];
}

	
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");
	include("../funciones.php");

	
if (!empty($id) and !empty($cantidad) and !empty($precio_venta))
{
	$select_tmp=mysqli_query($con,"SELECT* FROM tmp where id_producto='".$id."'");
	$row= mysqli_fetch_array($select_tmp);
	
	if($row == ""){
		$insert_tmp=mysqli_query($con, "INSERT INTO tmp (id_producto,cantidad_tmp,precio_tmp,precio_compra_tmp,session_id) VALUES ('$id','$cantidad','$precio_venta','$precio_compra','$session_id')");
	}else{

		$cantidad_old=$row['cantidad_tmp'];
		$cantidad_new = $cantidad + $cantidad_old;
		$update_tmp=mysqli_query($con, "UPDATE tmp SET cantidad_tmp='".$cantidad_new."' where id_producto='".$id."'");
	}

}
if (isset($_GET['id']))
{
$id_tmp=intval($_GET['id']);	
$delete=mysqli_query($con, "DELETE FROM tmp WHERE id_tmp='".$id_tmp."'");
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
	$sumador_total_compra=0;
	$sql=mysqli_query($con, "select * from products, tmp where products.id_producto=tmp.id_producto and tmp.session_id='".$session_id."'");
	while ($row=mysqli_fetch_array($sql))
	{
	$id_tmp=$row["id_tmp"];
	$codigo_producto=$row['codigo_producto'];
	$cantidad=$row['cantidad_tmp'];
	$nombre_producto=$row['nombre_producto'];
	
	
	$precio_venta=$row['precio_tmp'];
	$precio_venta_f=number_format($precio_venta,0);
	$precio_venta_r=str_replace(",","",$precio_venta_f);
	$precio_total=$precio_venta_r*$cantidad;
	$precio_total_f=number_format($precio_total,0);
	$precio_total_r=str_replace(",","",$precio_total_f);
	$sumador_total+=$precio_total_r;
	
	$precio_compra=$row['precio_compra_tmp'];
	$precio_compra_f=number_format($precio_compra,0);
	$precio_compra_r=str_replace(",","",$precio_compra_f);
	$precio_total_compra=$precio_compra_r*$cantidad;
	$precio_total_compra_f=number_format($precio_total_compra,0);
	$precio_total_compra_r=str_replace(",","",$precio_total_compra_f);
	$sumador_total_compra+=$precio_total_compra_r;
		?>
		<tr>
			<td class='text-center'><?php echo $codigo_producto;?></td>
			<td class='text-center'><?php echo $cantidad;?></td>
			<td><?php echo $nombre_producto;?></td>
			<td class='text-right'><?php echo $precio_venta_f;?></td>
			<td class='text-right'><?php echo $precio_total_f;?></td>
			<td class='text-center'><a href="#" onclick="eliminar('<?php echo $id_tmp ?>')"><i class="fa fa-trash fa-1x icono-table"></i></a></td>
		</tr>		
		<?php
	}

	$subtotal=number_format($sumador_total,0,'.','');
	$total_factura=$subtotal;

	$subtotal_compra=number_format($sumador_total_compra,0,'.','');
	$total_factura_compra=$subtotal_compra;


?>

<tr class="header-table">
	<td class='text-right' colspan=4>TOTAL <?php echo $simbolo_moneda;?></td>
	<td class='text-right'><?php echo number_format($total_factura,0);?></td>
	<td></td>
</tr>

</table>