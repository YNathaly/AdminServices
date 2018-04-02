
$(document).ready(function(){
  $("#service_seg").submit(function(e) {
      var params = $(this).serialize();
      e.preventDefault();
      $.ajax({
        url:$(this).attr('action'),
        type:$(this).attr('method'),
        data:params,
        dataType:'json',
        success:function(data){
          if(data.status == "false"){
            alert(data.msg);
          } else {
            $("#txt_seguimiento").val(data.msg);
            $("#txt_message").val("");
          }
        }
      })
  });
});
