	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="nuevoGasto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<div class="col-lg-12 col-md-12 col-sm-12">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="" id="myModalLabel">Agregar nuevo gasto</h4>
			</div>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="guardar_gasto" name="guardar_gasto">
			<div id="resultados_ajax_productos"></div>
			 			  
			  <div class="form-group">
				<label for="descripcion" class="col-sm-4 control-label">Descripción</label>
				<div class="col-sm-12">
					<textarea class="form-control" id="descripcion" name="descripcion" placeholder="Descripción del gasto" required maxlength="255" ></textarea>
				  
				</div>
			  </div>
			 			  
			  
			  <div class="form-group">
				<label for="valor_gasto" class="col-sm-4 control-label">Valor gasto</label>
				<div class="col-sm-12">
				  <input type="text" class="form-control" id="valor_gasto" name="valor_gasto" placeholder="Valor del gasto" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
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