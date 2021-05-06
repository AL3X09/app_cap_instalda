//var getUrl = window.location;
//var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1] + "/"; // lineas servidor local


$(document).ready(function () {
  //var bootstrapValidator = $('#formRegistro').data('bootstrapValidator');
  //console.log(bootstrapValidator);
  /*$("#correo_confir").on("input", function() {
    //has-error
    verificar_correo();
    //console.log('verifica correo');
 });*/

});


function guardar() {
  
  $.ajax({
    url: 'api/register',
    method: 'POST',
    data: $('#formRegistro').serialize(),
    success: function (data) {
      console.log(data);
      if(data.status=='201'){
        console.log(data);
        alert(data.messages);
        window.location.href = "/Login";
        
      } else {
          alert(data.messages);
        
      }
      
    }
  });
  
  
}
