	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="nuevoProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<div class="col-lg-12 col-md-12 col-sm-12">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="" id="myModalLabel">Agregar nuevo producto</h4>
			</div>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="guardar_producto" name="guardar_producto">
			<div id="resultados_ajax_productos"></div>
			  <div class="form-group">
				<label for="codigo" class="col-sm-4 control-label">Código</label>
				<div class="col-sm-12">
				  <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Código del producto" required>
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="nombre" class="col-sm-4 control-label">Nombre</label>
				<div class="col-sm-12">
					<textarea class="form-control" id="nombre" name="nombre" placeholder="Nombre del producto" required maxlength="255" ></textarea>
				  
				</div>
			  </div>
			  <div class="form-group">
				<label for="stock" class="col-sm-4 control-label">Stock</label>
				<div class="col-sm-12">
				  <input type="text" class="form-control" id="stock" name="stock" placeholder="Cantidad de existencias del producto" value="0" readonly="">
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="estado" class="col-sm-4 control-label">Estado</label>
				<div class="col-sm-12">
				 <select class="form-control" id="estado" name="estado" required>
					<option value="">-- Selecciona estado --</option>
					<option value="1" selected>Activo</option>
					<option value="0">Inactivo</option>
				  </select>
				</div>
			  </div>
			  <div class="form-group">
				<label for="precio" class="col-sm-4 control-label">Precio compra</label>
				<div class="col-sm-12">
				  <input type="text" class="form-control" id="precio_compra" name="precio_compra" placeholder="Precio de compra del proveedor" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
				</div>
			  </div>
			  <div class="form-group">
				<label for="precio" class="col-sm-4 control-label">Precio venta</label>
				<div class="col-sm-12">
				  <input type="text" class="form-control" id="precio" name="precio" placeholder="Precio de venta al público" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
				</div>
			  </div>
			 
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn" data-dismiss="modal" title="Cancelar"><span class=""><img src="img/iconos/cancel.png"></span></button>
			<button type="submit" class="btn btn-lg btn-new" id="guardar_datos"title="Guardar"><span class=""><img src="img/iconos/save.png"></span></button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>