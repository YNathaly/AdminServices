var service = {
	eliminar:function(id){
		$.ajax({
			url:'/AdminServices/public/delete_service',
			dataType : 'json', 
			type:'POST',
			data:{'id_service':id},
			success:function(data){
				if(data.status){
					alert(data.msg);
					$("#serviceRow"+id).remove();
				} else {
					alert('Error al eliminar el registro');
				}
				
			}
		})
	},
	llenarGrupo:function(dato) {
	    $('#cmbDepartamento').find('option').remove();
	    $.each(dato,function(index,value) {
	    	$('#cmbDepartamento').append('<option value="'+index+'">'+index+'</option>');

	    });
	},

	llenarArea:function(grupo) {
		$('#cmbSubDepartamento').find('option').remove();
		$.each(dato[grupo],function(index,value){
			$("#cmbSubDepartamento").append('<option value="'+value+'">'+value+'</option>');
		});
	},

	modal:function(id){
		$.ajax({
			url:'/AdminServices/public/datos_service',
			type:'POST',
			dataType:'json',
			data:{'id':id},
			beforeSend:function(){
			},
			success:function(data){
				if(data.status){
					$('#modal_services').modal({
				        backdrop:'static',
				        keyboard:true
          			}).on('shown.bs.modal',function(e){
          				$("#id_service").val(data.datos['id']);
						$("#txt_descripcion").val(data.datos['descripcion']);
						$("#cmbCantidad").val(data.datos['cantidad']);
						$("#txt_comentarios").val(data.datos['comentarios']);
						$("#cmbTipo").val(data.datos['tipo']);
						$('#cmbSubtipo').find('option').remove();
						$("#cmbSubtipo").append('<option value="Nueva subCategoria">Nueva subCategoria</option>');
						$("#categoria").hide();
						$("#subcategoria").hide();
						$.each(dato[data.datos['tipo']],function(index,value){
								$("#cmbSubtipo").append('<option value="'+index+'">'+value+'</option>');
						});
						$("#cmbSubtipo").val(data.datos['subtipo']); 

					}).on('hidden.bs.modal',function(){
         					$('#edit_service[input]').val('');
         					$("#contError").empty();
         			});
					}

				},
				error:function(){
					

				}
 		});
	},

	llenarTipo:function(dato) {
		$('#cmbTipo').find('option').remove();
	    $("#cmbTipo").append('<option value="Nueva Categoria">Nueva Categoria</option>');
	    $.each(dato,function(index,value) {
	    	$('#cmbTipo').append('<option value="'+index+'">'+index+'</option>');

	    });	
	},
	llenarSubtipo:function(tipo) {

		$('#cmbSubtipo').find('option').remove();
		$("#cmbSubtipo").append('<option value="Nueva subCategoria">Nueva subCategoria</option>');
		if(tipo != 'Nueva Categoria') {
			$("#categoria").hide();
			$.each(dato[tipo],function(index,value){
				$("#cmbSubtipo").append('<option value="'+index+'">'+value+'</option>');
			});
		} else {
			$("#categoria").show();
			$("#subcategoria").show();
		}		
	},
	modificarService:function() {

	}
}


$(document).ready(function(){
	jQuery.ajaxSetup({
        headers: {
            'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
        }
    });
	$('a.eliminar').on('click',function(e){
		id = $(this).attr('id');
        service.eliminar(id);
    });

    $('a.actualizar').on('click',function(e){

    	id = $(this).attr('id');
    	service.modal(id);
    });
	
	dato = jQuery.parseJSON(dato);
	dato = dato['categorias'];
	service.llenarTipo(dato);
	tipo = $('#cmbTipo').val();
	service.llenarSubtipo(tipo);
		
	$("#cmbTipo").change(function(){
	    tipo = $('#cmbTipo').val();
	    service.llenarSubtipo(tipo);
	});

	$("#cmbSubtipo").change(function(){
		subtipo = $("#cmbSubtipo").val();
	    if (subtipo == 'Nueva subCategoria') {
	    	$("#subcategoria").show();
	    } else {
	    	$("#subcategoria").hide();
	    }
	});
});	
