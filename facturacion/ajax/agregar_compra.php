<?php
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
$session_id= session_id();
if (isset($_POST['id'])){
	$id=$_POST['id'];
}
if (isset($_POST['cantidad'])){
	$cantidad=$_POST['cantidad'];
}
if (isset($_POST['precio_compra'])){
	$precio_compra=$_POST['precio_compra'];
}

	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	//Archivo de funciones PHP
	include("../funciones.php");

if (!empty($id) and !empty($cantidad) and !empty($precio_compra))
{
	$select_tmp=mysqli_query($con,"SELECT* FROM tmp_compras where id_producto='".$id."'");
	$row= mysqli_fetch_array($select_tmp);
	if($row == ""){
		$insert_tmp=mysqli_query($con, "INSERT INTO tmp_compras (id_producto,cant_tmp,precio_tmp,session_id) VALUES ('$id','$cantidad','$precio_compra','$session_id')");

	}else{

		$cantidad_old=$row['cant_tmp'];
		$cantidad_new = $cantidad + $cantidad_old;
		$update_tmp=mysqli_query($con, "UPDATE tmp_compras SET cant_tmp='".$cantidad_new."' where id_producto='".$id."'");
	}
//

}
if (isset($_GET['id']))//codigo elimina un elemento del array
{
$id_tmp=intval($_GET['id']);	
$delete=mysqli_query($con, "DELETE FROM tmp_compras WHERE id_tmp='".$id_tmp."'");
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
	$sql=mysqli_query($con, "select * from products, tmp_compras where products.id_producto=tmp_compras.id_producto and tmp_compras.session_id='".$session_id."'");
	while ($row=mysqli_fetch_array($sql))
	{
	$id_tmp=$row["id_tmp"];
	$codigo_producto=$row['codigo_producto'];
	$cantidad=$row['cant_tmp'];
	$nombre_producto=$row['nombre_producto'];
	
	
	$precio_compra=$row['precio_tmp'];
	$precio_compra_f=number_format($precio_compra,0);//Formateo variables
	$precio_compra_r=str_replace(",","",$precio_compra_f);//Reemplazo las comas
	$precio_total=$precio_compra_r*$cantidad;
	$precio_total_f=number_format($precio_total,0);//Precio total formateado
	$precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comas
	$sumador_total+=$precio_total_r;//Sumador
	
		?>
		<tr>
			<td class='text-center'><?php echo $codigo_producto;?></td>
			<td class='text-center'><?php echo $cantidad;?></td>
			<td><?php echo $nombre_producto;?></td>
			<td class='text-right'><?php echo $precio_compra_f;?></td>
			<td class='text-right'><?php echo $precio_total_f;?></td>
			<td class='text-center'><a href="#" onclick="eliminar('<?php echo $id_tmp ?>')"><i class="glyphicon glyphicon-trash"></i></a></td>
		</tr>		
		<?php
	}
	$subtotal=number_format($sumador_total,0,'.','');
	$total_compra=$subtotal;

?>

<tr class="header-table">
	<td class='text-right' colspan=4>TOTAL <?php echo $simbolo_moneda;?></td>
	<td class='text-right'><?php echo number_format($total_compra,0);?></td>
	<td></td>
</tr>

</table>