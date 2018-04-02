var listAsig = {
	eliminar:function(id){
		$.ajax({
			url:'/AdminServices/public/delete_serviceRel',
			dataType : 'json', 
			type:'POST',
			data:{'id_rel':id},
			success:function(data){
				if(data.status){
					alert(data.msg);
					$("#serv"+id).remove();
				} else {
					alert('Error al eliminar el registro');
				}
				
			}
		})
	}
}


$(document).ready(function(){
	jQuery.ajaxSetup({
        headers: {
            'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
        }
    });
	$('a.eliminarServ').on('click',function(e){
		id = $(this).attr('id');
        listAsig.eliminar(id);
    });
});	
