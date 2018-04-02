	function llenarService() {
		$.each(dato,function(index,value) {
			$("#Add_"+value['id']).click(function(){
				$("#serv_descripcion").val(value['descripcion']);
				$("#serv_descripcion2").val(value['descripcion']);
			    $("#serv_comentarios").val(value['comentarios']);
			    $("#serv_comentarios2").val(value['comentarios']);
			    $("#serv_id").val(value['id_service']);
                $("#rel_responsable").val(value['tipo_rel_resp']);
                if(value['tipo_rel_resp'] == 'Usuario') {
                	user = value['responsable'].split('|');
                	$("#serv_responsable").val(user[0]);
                } else {
                	$("#serv_responsable").val(value['responsable']);
                }
                $("#serv_empresa").val(value['empresa_sol']);
			    if (value['cantidad'] == "Si") {
					$("#divCantidad").show();
				}
			    $("#idServ").val(value['id']);
			    $("#ModalServices").modal('hide');
  				$('body').removeClass('modal-open');
 				$('.modal-backdrop').remove();

			});
		});
	}
 	
 	$(document).ready(function() {
		$("#divCantidad").hide();
		dato = jQuery.parseJSON(dato);
		llenarService();
		$("#service").hide();
		$('body .dropdown-toggle').dropdown();
	});
