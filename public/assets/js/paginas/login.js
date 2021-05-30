//creado por Alex Cs 18/04/2021

$(document).ready(function () {

  $("#formlogin").submit(function (e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.
    login();
  });

});

function login() {
  //console.log('holalogin')

  $.ajax({
    url: base_url+'/api/logeo',
    method: 'POST',
    data: $("#formlogin").serialize(),
    beforeSend: function () {
    },
    success: function (data) {
      //console.log(data);
      if (data.status == '201') {
        console.log(data);
        localStorage.setItem("user", JSON.stringify(data.token));
        window.location.href = base_url+"/Home";
        //alertify.success(data.msg);
      } else {
        alert(data.messages);
        //alertify.error(data.msg);
      }

    }
  });

}


