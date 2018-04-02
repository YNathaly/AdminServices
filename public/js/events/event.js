var services = new Object();

function getServices(services) {

	codeHtml = "";
	total = 0;
	active = "";
	codePanel = "";
	$.each(services,function(index,value){
		if (total == 0) {
			active = "active";
			llenarCampos(value['id_service']);
		} else {
			active = "";
		}
		codeHtml = codeHtml+"<li role='presentation' class='disabled "+active+"'>"+
	                  				"<a id='"+value['id_service']+"' href='#"+value['id_service']+"' class='select_item' aria-controls='"+value['id_service']+"' role='tab' data-toggle='tab'>"+
										"<span class='number'>"+value['descripcion']+"</span><button class='close eliminarItem' id='"+value['id_service']+"'>x</button>"+
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

	$(".eliminarItem").click(function(){
    	var itemtoRemove =  $(this).attr('id');
    	delete services[itemtoRemove];
		getServices(services);
	});

	$(".select_item").click(function(){
		id_service = $(this).attr('id');
		asignarServices();
		llenarCampos(id_service);
	});
}

function asignarServices() {
	actual = $("#serv_id").val();
	services[actual]['prioridad'] = $("#serv_prioridad").val();
	services[actual]['cant'] = $("#serv_cantidad").val();
	services[actual]['comentarios_gen'] = $("#txt_comentarios_gen").val();
	//console.log(services[id_service]);
}

function llenarCampos(id_service) {
	$("#serv_id").val(id_service);
	$("#txt_titulo").html(services[id_service]['descripcion']);
	$("#serv_descripcion").val(services[id_service]['descripcion']);
	$("#serv_comentarios").val(services[id_service]['comentarios']);
	$("#txt_comentarios_gen").val(services[id_service]['comentarios_gen']);
	if (services[id_service]['comentarios'] != "") {
		 $('#serv_prioridad > option[value="'+services[id_service]['prioridad']+'"]').attr('selected', 'selected');
	}
	if (services[id_service]['cantidad'] == "Si") {
		$("#divCantidad").show();
		$("#serv_cantidad").val(services[id_service]['cant']);
	} else {
		$("#serv_cantidad").val("NA");
	}

}

$(document).ready(function(){
	$("#alertMessage").hide();
	jQuery.ajaxSetup({
        headers: {
            'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
        }
    });

	dato = jQuery.parseJSON(dato);
	$("#divForm").hide();
	$(".agregar").click(function(){
		i = $(this).attr('id');
		services[dato[i]['id_service']] = dato[i];
		services[dato[i]['id_service']]['prioridad'] = "";
		services[dato[i]['id_service']]['cant'] = "";
		services[dato[i]['id_service']]['comentarios_gen'] = "";
		getServices(services);
	});

	$("#event_service").submit(function(e){
		e.preventDefault();
		asignarServices();
		fecha_evento = $("#txt_fecha_evento").val();
		descripcion_evento = $("#txtDes").val();
		comentarios_evento = $("#txt_comentarios").val();
	     $.ajax({
	        url:$(this).attr('action'),
	        type:$(this).attr('method'),
	        data:{'fecha_evento':fecha_evento,'descripcion_evento':descripcion_evento,'comentarios_evento':comentarios_evento,'datos':services},
	        dataType:'json',
	        success:function(data){
	        	$("#alertMessage").show();
	          if(data.status == "success"){
	            $("#alertMessage").html(data.msg);
	          } else {
	          	$("#alertMessage").html("Error al dar de alta el evento");
	          	//$("#alertMessage").attr('class','danger');
	          }
	        }
	    })
	});
});