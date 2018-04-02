	function llenarService() {		
		$.each(dato['servicios'],function(index,value) {
			$("#"+value['id']).click(function(){
				alert('hola');
				$("#txtDes").val(value['descripcion']);
			    $("#txtComentarios").val(value['comentarios']);
			    $("#txtDes2").val(value['descripcion']);
			    $("#txtComentarios2").val(value['comentarios']);
			    $("#idServ").val(value['id']);
			    $("#ModalServices").modal('hide');
  				$('body').removeClass('modal-open');
 				$('.modal-backdrop').remove();

			});
		});
	}

	function llenarUsuarios() {
		$.each(dato['usuarios'],function(index,value){
			$("#A-"+value['id']).click(function(){
				$("#txtUserA").val(value['first_name']+" "+value['last_name']);
				$('#id_userA').val(value['id']);
			});
			$("#R-"+value['id']).click(function(){
				$("#txtUserR").val(value['first_name']+" "+value['last_name']);
				$('#id_userR').val(value['id']);
			});
		});
	}



	function llenarSubdepartamentoA() {
		$("#cmbSubDepartamentoA").find('option').remove();
		tipo = $('#departamentoA option:selected').text();
		$.each(dato['grupos_areas'][tipo],function(index,value){
				$("#cmbSubDepartamentoA").append('<option value="'+value+'">'+value+'</option>');
		});
	}

	function llenarSubdepartamentoR() {
		$("#cmbSubDepartamentoR").find('option').remove();
		tipo = $('#departamentoR option:selected').text();
		$.each(dato['grupos_areas'][tipo],function(index,value){
				$("#cmbSubDepartamentoR").append('<option value="'+value+'">'+value+'</option>');
		});
	}

	$(document).ready(function(){
		dato = jQuery.parseJSON(dato);
		llenarService();
		llenarUsuarios();
		$("#empresaR").show();
		$("#departamentoR").hide();
		$("#subdepartamentoR").hide();
		$("#puestoR").hide();
		$("#usuarioR").hide();
		/*Asignado*/
		$("#empresaA").show();
		$("#departamentoA").hide();
		$("#subdepartamentoA").hide();
		$("#puestoA").hide();
		$("#usuarioA").hide();
		$("#departamentoA").change(function(){
			llenarSubdepartamentoA();
		});
		$("#departamentoR").change(function(){
			llenarSubdepartamentoR();
		});
		$("#cmbtipoResp").change(function(){
			tipoval = $("#cmbtipoResp").val();
			switch(tipoval) {
				case 'Empresa':
					$("#empresaR").show();
					$("#departamentoR").hide();
					$("#subdepartamentoR").hide();
					$("#puestoR").hide();
					$("#usuarioR").hide();
				break;
				case 'Departamento':
					$("#empresaR").show();
					$("#departamentoR").show();
					$("#subdepartamentoR").hide();
					$("#puestoR").hide();
					$("#usuarioR").hide();
				break;
				case 'Subdepartamento':
					$("#empresaR").show();
					$("#departamentoR").show();
					$("#subdepartamentoR").show();
					$("#puestoR").hide();
					$("#usuarioR").hide();
				break;
				case 'Puesto':
					$("#empresaR").show();
					$("#departamentoR").hide();
					$("#subdepartamentoR").hide();
					$("#puestoR").show();
					$("#usuarioR").hide();
				break;
				case 'Usuario':
					$("#empresaR").hide();
					$("#departamentoR").hide();
					$("#subdepartamentoR").hide();
					$("#puestoR").hide();
					$("#usuarioR").show();
				break;
			}	
		});
		$("#cmbtipoasig").change(function(){
			tipoval = $("#cmbtipoasig").val();
			switch(tipoval) {
				case 'Empresa':
					$("#empresaA").show();
					$("#departamentoA").hide();
					$("#subdepartamentoA").hide();
					$("#puestoA").hide();
					$("#usuarioA").hide();
				break;
				case 'Departamento':
					$("#empresaA").show();
					$("#departamentoA").show();
					$("#subdepartamentoA").hide();
					$("#puestoA").hide();
					$("#usuarioA").hide();
				break;
				case 'Subdepartamento':
					$("#empresaA").show();
					$("#departamentoA").show();
					$("#subdepartamentoA").show();
					$("#puestoA").hide();
					$("#usuarioA").hide();
				break;
				case 'Puesto':
					$("#empresaA").show();
					$("#departamentoA").hide();
					$("#subdepartamentoA").hide();
					$("#puestoA").show();
					$("#usuarioA").hide();
				break;
				case 'Usuario':
					$("#empresaA").hide();
					$("#departamentoA").hide();
					$("#subdepartamentoA").hide();
					$("#puestoA").hide();
					$("#usuarioA").show();
				break;
			}
		});
		llenarSubdepartamentoR();
		llenarSubdepartamentoA();

	});