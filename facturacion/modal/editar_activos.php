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
					<h4 class="" id="myModalLabel">Actualizar activo</h4>
			</div>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="editar_activo" name="editar_activo">
			<div id="resultados_ajax2"></div>
				<input type="hidden" name="mod_id" id="mod_id">
			   <div class="form-group">
				<label for="mod_descripcion" class="col-sm-4 control-label">Descripción</label>
				<div class="col-sm-12">
				  <textarea class="form-control" id="mod_descripcion" name="mod_descripcion" placeholder="Descripción del activo" required></textarea>
				</div>
			  </div>
			  
			
			  <div class="form-group">
				<label for="mod_valor" class="col-sm-4 control-label">Valor Activo</label>
				<div class="col-sm-12">
				  <input type="text" class="form-control" id="mod_valor" name="mod_valor" placeholder="Valor activo" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
				</div>
			  </div>
		
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn" data-dismiss="modal" title="Cancelar"><span class=""><img src="img/iconos/cancel.png"></span></button>
			<button type="submit" class="btn" id="guardar_datos"title="Guardar"><span class=""><img src="img/iconos/save.png"></span></button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>