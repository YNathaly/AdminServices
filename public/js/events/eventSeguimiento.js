var service = new Object();

function getServices(services) {

	codeHtml = "";
	total = 0;
	active = "";
	codePanel = "";
	$.each(services,function(index,value){
		service[value['id_servicio']] = value;
		if (total == 0) {
			active = "active";
			llenarCampos(value['id_servicio']);
		} else {
			active = "";
		}
		codeHtml = codeHtml+"<li role='presentation' class='disabled "+active+"'>"+
	                  				"<a id='"+value['id_servicio']+"' href='#"+value['id_servicio']+"' class='select_item' aria-controls='"+value['id_servicio']+"' role='tab' data-toggle='tab'>"+
										"<span class='number'>"+value['descripcion']+"</span>"+
	                  				"</a>"+
	                  			"</li>";

		total ++;
		
	});
	if (total>0) {
		$("#divForm").show();
	} else {
		$("#divForm").hide();
	}
	$("#botones").html(codeHtml);

	$(".select_item").click(function(){
		id_service = $(this).attr('id');
		llenarCampos(id_service);
	});
}



function llenarCampos(id_servicio) {
	$("#serv_id").val(id_servicio);
	$("#txt_titulo").html(service[id_servicio]['descripcion']);
	$("#serv_descripcion").val(service[id_servicio]['descripcion']);
	$("#serv_comentarios").val(service[id_servicio]['comentarios']);
	$("#txt_comentarios_gen").val(service[id_servicio]['comentarios']);
	$("#txt_fechaIni").val(service[id_servicio]['created_at']);
	$("#txt_responsable").val(service[id_servicio]['responsable']);
	$("#txt_solicitante").val(service[id_servicio]['id_solicitante']);
	$("#txt_servicio").val(service[id_servicio]['id']);
	$("#txt_seguimiento").val(service[id_servicio]['seguimiento']);
	if (service[id_servicio]['comentarios'] != "") {
		 $('#serv_prioridad > option[value="'+service['prioridad']+'"]').attr('selected', 'selected');
	}
	$("#serv_cantidad").val(service[id_servicio]['cant']);
	

}

$(document).ready(function(){
	$("#alertMessage").hide();
	jQuery.ajaxSetup({
        headers: {
            'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
        }
    });
	dato = JSON.parse(dato);
	getServices(dato);

	$("#event_service").submit(function(e){
		var params = $(this).serialize();
		e.preventDefault();
		id_service = $("#serv_id").val();
	    $.ajax({
	        url:$(this).attr('action'),
	        type:$(this).attr('method'),
	        data:params,
	        dataType:'json',
	        success:function(data){
	          if(data.status == "false") {
	            alert(data.msg);
	          } else {
	          	service[id_service]['seguimiento'] = data.msg;
	            $("#txt_seguimiento").val(data.msg);
	            $("#txt_message").val("");
	          }
	        }
	    })
	});
});