	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<div class="col-lg-12 col-md-12 col-sm-12">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="" id="myModalLabel">Actualizar producto</h4>
			</div>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="editar_producto" name="editar_producto">
			<div id="resultados_ajax2"></div>
			  <div class="form-group">
				<label for="mod_codigo" class="col-sm-4 control-label">Código</label>
				<div class="col-sm-12">
				  <input type="text" class="form-control" id="mod_codigo" name="mod_codigo" placeholder="Código del producto" required>
					<input type="hidden" name="mod_id" id="mod_id">
				</div>
			  </div>
			   <div class="form-group">
				<label for="mod_nombre" class="col-sm-4 control-label">Nombre</label>
				<div class="col-sm-12">
				  <textarea class="form-control" id="mod_nombre" name="mod_nombre" placeholder="Nombre del producto" required></textarea>
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="mod_estado" class="col-sm-4 control-label">Estado</label>
				<div class="col-sm-12">
				 <select class="form-control" id="mod_estado" name="mod_estado" required>
					<option value="">-- Selecciona estado --</option>
					<option value="1" selected>Activo</option>
					<option value="0">Inactivo</option>
				  </select>
				</div>
			  </div>
			  <div class="form-group">
				<label for="mod_precio_compra" class="col-sm-4 control-label">Precio venta</label>
				<div class="col-sm-12">
				  <input type="text" class="form-control" id="mod_precio_compra" name="mod_precio_compra" placeholder="Precio venta al publico" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
				</div>
			  </div>
			  <div class="form-group">
				<label for="mod_precio" class="col-sm-4 control-label">Precio compra</label>
				<div class="col-sm-12">
				  <input type="text" class="form-control" id="mod_precio" name="mod_precio" placeholder="Precio compra al proveedor" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
				</div>
			  </div>
			 
			 
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn " data-dismiss="modal" title="Cancelar"><span class=""><img src="img/iconos/cancel.png"></span></button>
			<button type="submit" class="btn " id="guardar_datos"title="Guardar"><span class=""><img src="img/iconos/save.png"></span></button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>