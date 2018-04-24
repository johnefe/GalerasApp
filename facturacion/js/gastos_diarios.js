	$(document).ready(function(){
		
			load_diarias(1);
			
	});

	function load_diarias(page){
			var z= $("#z").val();
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'./ajax/buscar_gastos_diarios.php?action=ajax&page='+page+'&z='+z,
				 beforeSend: function(objeto){
				 //$('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					//$('[data-toggle="tooltip"]').tooltip({html:true}); 
					
				}
			})
	}

	function eliminar (id)
		{
			var q= $("#q").val();
		if (confirm("Realmente deseas eliminar este gasto")){	
		$.ajax({
        type: "GET",
        url: "./ajax/buscar_gastos.php",
        data: "id="+id,"q":q,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		load(1);
		}
			});
		}
	}
		
	function imprimir_factura(id_factura){
			VentanaCentrada('./pdf/documentos/ver_factura.php?id_factura='+id_factura,'Factura','','1024','768','true');
		}