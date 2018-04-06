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
					<h4 class="" id="myModalLabel">Actualizar gasto</h4>
			</div>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="editar_producto" name="editar_producto">
			<div id="resultados_ajax2"></div>
			
			   <div class="form-group">
				<label for="mod_nombre" class="col-sm-4 control-label">Descripción</label>
				<div class="col-sm-12">
				  <textarea class="form-control" id="mod_nombre" name="mod_nombre" placeholder="Nombre del producto" required></textarea>
				</div>
			  </div>
			  
			
			  <div class="form-group">
				<label for="mod_precio_compra" class="col-sm-4 control-label">Valor Gasto</label>
				<div class="col-sm-12">
				  <input type="text" class="form-control" id="mod_precio_compra" name="mod_precio_compra" placeholder="Precio venta al publico" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
				</div>
			  </div>
		
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-lg btn-new" data-dismiss="modal" title="Cancelar"><span class="fa fa-ban fa-1x "></span></button>
			<button type="submit" class="btn btn-lg btn-new" id="guardar_datos"title="Guardar"><span class="fa fa-floppy-o fa-1x "></span></button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>