	$(document).ready(function(){
			load(1);
			$( "#resultados" ).load( "ajax/editar_compracion.php" );
		});

		function load(page){
			var q= $("#q").val();
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'./ajax/productos_compra.php?action=ajax&page='+page+'&q='+q,
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					
				}
			})
		}

	function agregar (id)
		{
			var precio_compra=document.getElementById('precio_compra_'+id).value;
			var cantidad=document.getElementById('cantidad_'+id).value;
			//Inicia validacion
			if (isNaN(cantidad))
			{
			alert('Esto no es un numero');
			document.getElementById('cantidad_'+id).focus();
			return false;
			}
			if (isNaN(precio_compra))
			{
			alert('Esto no es un numero');
			document.getElementById('precio_compra_'+id).focus();
			return false;
			}
			//Fin validacion
			
			$.ajax({
        type: "POST",
        url: "./ajax/editar_compracion.php",
        data: "id="+id+"&precio_compra="+precio_compra+"&cantidad="+cantidad,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		}
			});
		}
		
			function eliminar (id)
		{
			
			$.ajax({
        type: "GET",
        url: "./ajax/editar_compracion.php",
        data: "id="+id,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		}
			});

		}
		
		$("#datos_compra").submit(function(event){
		  var id_proveedor = $("#id_proveedor").val();
	  
		  if (id_proveedor==""){
			  alert("Debes seleccionar un proveedor");
			  $("#nombre_proveedor").focus();
			  return false;
		  }
			var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "ajax/editar_compra.php",
					data: parametros,
					 beforeSend: function(objeto){
						$(".editar_compra").html("Mensaje: Cargando...");
					  },
					success: function(datos){
						$(".editar_compra").html(datos);
					}
			});
			
			 event.preventDefault();
	 	});
		
		$( "#guardar_compra" ).submit(function( event ) {
		  $('#guardar_datos').attr("disabled", true);
		  
		 var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "ajax/nuevo_proveedor.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados_ajax").html("Mensaje: Cargando...");
					  },
					success: function(datos){
					$("#resultados_ajax").html(datos);
					$('#guardar_datos').attr("disabled", false);
					load(1);
				  }
			});
		  event.preventDefault();
		})
		
		$( "#guardar_producto" ).submit(function( event ) {
		  $('#guardar_datos').attr("disabled", true);
		  
		 var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "ajax/nuevo_producto.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados_ajax_productos").html("Mensaje: Cargando...");
					  },
					success: function(datos){
					$("#resultados_ajax_productos").html(datos);
					$('#guardar_datos').attr("disabled", false);
					load(1);
				  }
			});
		  event.preventDefault();
		})

		function imprimir_compra(id_compra){
			VentanaCentrada('./pdf/documentos/ver_compra.php?id_compra='+id_compra,'Compra','','1024','768','true');
		}