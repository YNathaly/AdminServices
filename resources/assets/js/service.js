
 	function llenarGrupo(dato) {
	    $('#cmbDepartamento').find('option').remove();
	    $.each(dato['grupos_areas'],function(index,value) {
	    	$('#cmbDepartamento').append('<option value="'+index+'">'+index+'</option>');

	    });
	}


	$(document).ready(function(){
		alert('here');
		dato = jQuery.parseJSON(dato);
		llenarGrupo(dato);
		
	    $("#cmbTipo").change(function(){
	      tipo = $('#cmbTipo').val();
	      llenarSubcategoria(tipo);
	    });

	    $("#cmbsubtipo").change(function(){
	    	tipo = $('#cmbTipo').val();
	    	subtipo = $("#cmbsubtipo").val();
	    	llenarServicios(tipo,subtipo);	
	    });

		tipo = $('#cmbTipo').val();
	    llenarSubcategoria(tipo);
	});
