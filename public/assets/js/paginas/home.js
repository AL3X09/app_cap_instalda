//creado por Alex Cs 18/04/2021

$(document).ready(function () {
  get_uus();
});

function get_uus() {

  //limpio select
  $('#uus_select')
    .find('option')
    .remove()
    .end()
    .append('<option value="">Seleccione</option>')
    .val('');
  //cargo select
  $.ajax({
    url: 'api/uss/alldata',
    method: 'GET',
    beforeSend: function () {
    },
    success: function (data) {

      if (data.status == '200') {

        $.each(data.data, function (k, v) {
          $("#uus_select").append('<option value=' + v.id_tbl_uni_serv_salud + '>' + v.nombre + '</option>');
        });

      } else {
        Swal.fire(data.messages);
      }
    },
    error: function (data) {
      Swal.fire('Error al conectar y traer datos dinamicos');
    }

  });
  count_uus();
}

function count_uus() {
 
  $.ajax({
    url: 'api/uss/countalluss',
    method: 'GET',
    beforeSend: function () {
    },
    success: function (data) {
      if (data.status == '200') {
          $("#carduss").html(data.data);
      } else {
        Swal.fire(data.messages);
      }
    },
    error: function (data) {
      Swal.fire('Error al conectar y traer datos dinamicos');
    }

  });
  count_gus();
}


function count_gus() {
  
  $.ajax({
    url: 'api/gus/countallgus',
    method: 'GET',
    beforeSend: function () {
    },
    success: function (data) {
      var nombres = [];
      var valores = [];
      if (data.status == '200') {
        $("#cardgus").html(data.data);
      } else {
        Swal.fire(data.messages);
      }
    },
    error: function (data) {
      Swal.fire('Error al conectar y traer datos dinamicos');
    }

  });
  count_svo();
}

function count_svo() {

  $.ajax({
    url: 'api/svo/countallsvo',
    method: 'GET',
    beforeSend: function () {
    },
    success: function (data) {
      var nombres = [];
      var valores = [];
      if (data.status == '200') {
        $("#cardsvo").html(data.data);

      } else {
        Swal.fire(data.messages);
      }
    },
    error: function (data) {
      Swal.fire('Error al conectar y traer datos dinamicos');
    }

  });
  count_progxestu();
}


function count_progxestu() {

  var btx = document.getElementById('chartproperf').getContext('2d');
  
  $.ajax({
    url: 'api/estandar/countestprog',
    method: 'GET',
    beforeSend: function () {
    },
    success: function (data) {
      var nombres = [];
      var valores = [];
      if (data.status == '200') {
          
        $.each(data.data, function (k, v) {
          nombres.push(v.programa +'-'+ v.perfil_est);
          valores.push(v.total);
        });

         /////
         var myBarChart = new Chart(btx, {
          type: 'bar',
          data: {
            labels: nombres,
            datasets : [{
              label: "Estudiantes",
              backgroundColor: 'rgb(23, 125, 255)',
              borderColor: 'rgb(23, 125, 255)',
              data: valores,
            }],
          },
          options: {
            responsive: true, 
            maintainAspectRatio: false,
            scales: {
              yAxes: [{
                ticks: {
                  beginAtZero:true
                }
              }]
            },
          }
        });
        /////

      } else {
        Swal.fire(data.messages);
      }
    },
    error: function (data) {
      Swal.fire('Error al conectar y traer datos dinamicos');
    }

  });
  count_progxdocent();
}

function count_progxdocent() {

  var btx = document.getElementById('chartprogdocente').getContext('2d');
  
  $.ajax({
    url: 'api/capinstalada/countdoceprog',
    method: 'GET',
    beforeSend: function () {
    },
    success: function (data) {
      var nombres = [];
      var valores = [];
      if (data.status == '200') {
          
        $.each(data.data, function (k, v) {
          nombres.push(v.programa +'-'+ v.perfil_est);
          valores.push(v.total);
        });

         /////
         var myBarChart = new Chart(btx, {
          type: 'bar',
          data: {
            labels: nombres,
            datasets : [{
              label: "Docentes",
              backgroundColor: '#CCFF1A',
              borderColor: 'rgb(23, 125, 255)',
              data: valores,
            }],
          },
          options: {
            responsive: true, 
            maintainAspectRatio: false,
            scales: {
              yAxes: [{
                ticks: {
                  beginAtZero:true
                }
              }]
            },
          }
        });
        /////

      } else {
        Swal.fire(data.messages);
      }
    },
    error: function (data) {
      Swal.fire('Error al conectar y traer datos dinamicos');
    }

  });
  //count_gus();
}
