<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; }
.midnight-blue{
	background:#2c3e50;
	padding: 4px 4px 4px;
	color:white;
	font-weight:bold;
	font-size:12px;
}
.silver{
	background:white;
	padding: 3px 4px 3px;
}
.clouds{
	background:#ecf0f1;
	padding: 3px 4px 3px;
}
.border-top{
	border-top: solid 1px #bdc3c7;
	
}
.border-left{
	border-left: solid 1px #bdc3c7;
}
.border-right{
	border-right: solid 1px #bdc3c7;
}
.border-bottom{
	border-bottom: solid 1px #bdc3c7;
}
table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
}
-->
</style>
<page backtop="15mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 12pt; font-family: arial" >
        <page_footer>
        <table class="page_footer">
            <tr>

                <td style="width: 50%; text-align: left">
                    P&aacute;gina [[page_cu]]/[[page_nb]]
                </td>
                <td style="width: 50%; text-align: right">
                    &copy; <?php echo "sys-galeras"; echo  $anio=date('Y'); ?>
                </td>
            </tr>
        </table>
    </page_footer>
    <?php include("encabezado_compra.php");?>
    <br>
    

	
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
           <td style="width:50%;" class='midnight-blue'>FACTURAR A</td>
        </tr>
		<tr>
           <td style="width:50%;" >
			<?php 
				$sql_proveedor=mysqli_query($con,"select * from proveedores where id_proveedor='$id_proveedor'");
				$rw_proveedor=mysqli_fetch_array($sql_proveedor);
				echo $rw_proveedor['nombre_proveedor'];
				echo "<br>";
				echo $rw_proveedor['direccion_proveedor'];
				echo "<br> Teléfono: ";
				echo $rw_proveedor['telefono_proveedor'];
				echo "<br> Email: ";
				echo $rw_proveedor['email_proveedor'];
			?>
			
		   </td>
        </tr>
        
   
    </table>
    
       <br>
		<table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
           <td style="width:35%;" class='midnight-blue'>VENDEDOR</td>
		  <td style="width:25%;" class='midnight-blue'>FECHA</td>
		   <td style="width:40%;" class='midnight-blue'>FORMA DE PAGO</td>
        </tr>
		<tr>
           <td style="width:35%;">
			<?php 
				$sql_user=mysqli_query($con,"select * from users where user_id='$id_vendedor'");
				$rw_user=mysqli_fetch_array($sql_user);
				echo $rw_user['firstname']." ".$rw_user['lastname'];
			?>
		   </td>
		  <td style="width:25%;"><?php echo date("d/m/Y");?></td>
		   <td style="width:40%;" >
				<?php 
				if ($condiciones==1){echo "Efectivo";}
				elseif ($condiciones==2){echo "Cheque";}
				elseif ($condiciones==3){echo "Transferencia bancaria";}
				elseif ($condiciones==4){echo "Crédito";}
				?>
		   </td>
        </tr>
		
        
   
    </table>
	<br>
  
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
        <tr>
            <th style="width: 10%;text-align:center" class='midnight-blue'>CANT.</th>
            <th style="width: 60%" class='midnight-blue'>DESCRIPCION</th>
            <th style="width: 15%;text-align: right" class='midnight-blue'>PRECIO UNIT.</th>
            <th style="width: 15%;text-align: right" class='midnight-blue'>PRECIO TOTAL</th>
            
        </tr>

<?php
$nums=1;
$sumador_total=0;
$sql=mysqli_query($con, "select * from products, tmp_compras where products.id_producto=tmp_compras.id_producto and tmp_compras.session_id='".$session_id."'");
while ($row=mysqli_fetch_array($sql))
	{
	$id_tmp=$row["id_tmp"];
	$id_producto=$row["id_producto"];
	$codigo_producto=$row['codigo_producto'];
	$cantidad=$row['cant_tmp'];
	$nombre_producto=$row['nombre_producto'];
	
	$precio_compra=$row['precio_tmp'];
	$precio_compra_f=number_format($precio_compra,2);//Formateo variables
	$precio_compra_r=str_replace(",","",$precio_compra_f);//Reemplazo las comas
	$precio_total=$precio_compra_r*$cantidad;
	$precio_total_f=number_format($precio_total,2);//Precio total formateado
	$precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comas
	$sumador_total+=$precio_total_r;//Sumador
	if ($nums%2==0){
		$clase="clouds";
	} else {
		$clase="silver";
	}
	?>

        <tr>
            <td class='<?php echo $clase;?>' style="width: 10%; text-align: center"><?php echo $cantidad; ?></td>
            <td class='<?php echo $clase;?>' style="width: 60%; text-align: left"><?php echo $nombre_producto;?></td>
            <td class='<?php echo $clase;?>' style="width: 15%; text-align: right"><?php echo $precio_compra_f;?></td>
            <td class='<?php echo $clase;?>' style="width: 15%; text-align: right"><?php echo $precio_total_f;?></td>
            
        </tr>

	<?php 
	//Insert en la tabla detalle_cotizacion
	$select_stock=mysqli_query($con, "SELECT stock from products where id_producto='".$id_producto."'");
	$row= mysqli_fetch_array($select_stock);

	$stock_old=$row['stock'];
	$stock_new = $stock_old+$cantidad;
	$insert_detail=mysqli_query($con, "INSERT INTO detalle_compra VALUES ('','$numero_compra','$id_producto','$cantidad','$precio_compra_r')");
	$update_products=mysqli_query($con, "UPDATE products SET stock='".$stock_new."' where id_producto='".$id_producto."'");
	
	$nums++;
	}
	//$impuesto=get_row('perfil','impuesto', 'id_perfil', 1);
	$subtotal=number_format($sumador_total,2,'.','');
	//$total_iva=($subtotal * $impuesto )/100;
	//$total_iva=number_format($total_iva,2,'.','');
	//$total_compra=$subtotal+$total_iva;
	$total_compra=$subtotal;
?>
	  
      <!--  <tr>
            <td colspan="3" style="widtd: 85%; text-align: right;">SUBTOTAL <?php //echo $simbolo_moneda;?> </td>
            <td style="widtd: 15%; text-align: right;"> <?php// echo number_format($subtotal,2);?></td>
        </tr>-->
		<!--<tr>
            <td colspan="3" style="widtd: 85%; text-align: right;">IVA (<?php //echo $impuesto; ?>)% <?php// echo $simbolo_moneda;?> </td>
            <td style="widtd: 15%; text-align: right;"> <?php// echo number_format($total_iva,2);?></td>
        </tr>-->
        <tr>
            <td colspan="3" style="widtd: 85%; text-align: right;">TOTAL <?php echo $simbolo_moneda;?> </td>
            <td style="widtd: 15%; text-align: right;"> <?php echo number_format($total_compra,2);?></td>
        </tr>
    </table>
	
	
	
	<br>
	<div style="font-size:11pt;text-align:center;font-weight:bold">Sys-Galeras</div>
	
	
	  

</page>

<?php
$date=date("Y-m-d H:i:s");
$insert=mysqli_query($con,"INSERT INTO compras VALUES (NULL,'$numero_compra','$date','$id_proveedor','$id_vendedor','$condiciones','$total_compra','1')");
$delete=mysqli_query($con,"DELETE FROM tmp_compras WHERE session_id='".$session_id."'");
?>