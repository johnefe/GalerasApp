	<?php
		if (isset($con))
		{
	?>	
			<!-- Modal -->
			<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="" id="myModalLabel">Adicionar productos a la factura</h4>
					</div>
				  </div>
				  <div class="modal-body">
					<form class="form-horizontal">
					  <div class="form-group">
						<div class="row">
							<div class="col-lg-10 col-md-2 col-sm-10">
						  <input type="text" class="form-control" id="q" placeholder="Buscar productos" onkeyup="load(1)">
						</div>
						<div class="col-lg-2 col-md-10 col-sm-2">
							<button type="button" class="btn btn-default" onclick="load(1)"><span class=''><img src="img/iconos/search.png" style="width: 70%;height: 70%;"></span></button>
						</div>

						</div>
						
					  </div>
					</form>
					<div id="loader" style="position: absolute;	text-align: center;	top: 55px;	width: 100%;display:none;"></div><!-- Carga gif animado -->
					<div class="outer_div" ></div><!-- Datos ajax Final -->
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					
				  </div>
				</div>
			  </div>
			</div>
	<?php
		}
	?>