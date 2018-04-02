
 	function llenarTipo(dato) {
	    $('#cmbTipo').find('option').remove();
	    $("#cmbTipo").append('<option value="Nueva Categoria">Nueva Categoria</option>');
	    $.each(dato,function(index,value) {
	    	$('#cmbTipo').append('<option value="'+index+'">'+index+'</option>');

	    });
	}

	function llenarSubtipo(tipo) {
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
	}


	$(document).ready(function(){

		dato = jQuery.parseJSON(dato);
		dato = dato['categorias'];
		llenarTipo(dato);
		tipo = $('#cmbTipo').val();
		llenarSubtipo(tipo);
		
	    $("#cmbTipo").change(function(){
	      tipo = $('#cmbTipo').val();
	      llenarSubtipo(tipo);
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
