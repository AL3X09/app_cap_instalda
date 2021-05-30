//creado por Alex Cs 18/04/2021

$(document).ready(function () {
  $('#navinstrum').addClass("active");
  get_hso();
  //$('#navdashboard').remove('active')
  /*get_gus();
  get_svo();
  get_programa();
  get_perfil();*/
});

function cargardataestand() {

  $.ajax({
    url: base_url + '/api/capinstalada/alldata',
    method: 'get',
    contentType: 'application/json',
  }).done(function (res) {
    //console.log(res);//data=msg.data;
    if (res.status == '200') {
      cargar_tablesstand(res.data);
    } else {
      //alert(data.messages);
      Swal.fire(res.data);
    }
  });
  //get_hso();
}

async function get_hso() {

  //cargo select
  $.ajax({
    url: base_url + '/api/hso/alldata',
    method: 'GET',
    beforeSend: function () {
    },
    success: function (data) {

      if (data.status == '200') {

        $.each(data.data, function (k, v) {
          $("#hso_select").append('<option value=' + v.id_tbl_uni_serv_hospital + '>' + v.nombre + '</option>');
          $("#hso_select").val(1);
        });

      } else {
        Swal.fire(data.messages);
      }
    },
    error: function (data) {
      Swal.fire('Error al conectar y traer datos dinamicos');
    }

  });

  //envio un tiempo para llamar una función asyncrona
  setTimeout(() => {
    get_uss();
  }, 2000);

}

async function get_uss() {

  var hso = $('#hso_select').val();

  //limpio select
  $('#uus_select')
    .find('option')
    .remove()
    .end()
    .val('');

  //cargo select
  $.ajax({
    url: base_url + '/api/uss/fkagrupado',
    method: 'POST',
    data: { pkhso: hso },
    beforeSend: function () {
    },
    success: function (data) {

      if (data.status == '200') {

        $.each(data.data, function (k, v) {
          $("#uss_select").append('<option value=' + v.id_tbl_uni_serv_salud + '>' + v.nombre + '</option>');
        });

      } else {
        Swal.fire(data.messages);
      }
    },
    error: function (data) {
      Swal.fire('Error al conectar y traer datos dinamicos');
    }

  });

  //envio un tiempo para llamar una función asyncrona
  setTimeout(() => {
    get_gus();
  }, 1000);

}

function get_gus() {

  var uss = $('#uss_select').val();

  //limpio select
  $('#gus_select')
    .find('option')
    .remove()
    .end()
    .val('');

  //cargo select
  $.ajax({
    url: base_url + '/api/gus/alldata',
    method: 'GET',
    //data: {pkuss: uss},
    beforeSend: function () {
    },
    success: function (data) {

      if (data.status == '200') {

        $.each(data.data, function (k, v) {
          $("#gus_select").append('<option value=' + v.id_tbl_grup_servicio + '>' + v.numero + '-' + v.grupo + '</option>');

        });

      } else {
        Swal.fire(data.messages);
      }
    },
    error: function (data) {
      Swal.fire('Error al conectar y traer datos dinamicos');
    }

  });

  //envio un tiempo para llamar una función asyncrona
  setTimeout(() => {
    get_svo();
  }, 1000);

}

function get_svo() {

  var gus = $('#gus_select').val();

  //limpio select
  $('#svo_select')
    .find('option')
    .remove()
    .end()
    .append('<option value=""></option>')
    .val('');

  //cargo select
  $.ajax({
    url: base_url + '/api/svo/alldata',
    method: 'get',
    //data: {pkgus: gus},
    beforeSend: function () {
    },
    success: function (data) {

      if (data.status == '200') {

        $.each(data.data, function (k, v) {
          $("#svo_select").append('<option value=' + v.id_tbl_serv_ofertado + '>' + v.nombre_serv + '</option>');
        });

      } else {
        Swal.fire(data.messages);
      }
    },
    error: function (data) {
      Swal.fire('Error al conectar y traer datos dinamicos del grupo');
    }

  });


  //envio un tiempo para llamar una función asyncrona
  setTimeout(() => {
    get_programa();
    get_perfil();
    calldata();
  }, 1000);

}

function get_programa() {

  //limpio select
  $('#prog_select')
    .find('option')
    .remove()
    .end()
    .append('<option value=""></option>')
    .val('');

  //cargo select
  $.ajax({
    url: base_url + '/api/programa/alldata',
    method: 'GET',
    beforeSend: function () {
    },
    success: function (data) {

      if (data.status == '200') {

        $.each(data.data, function (k, v) {
          $("#prog_select").append('<option value=' + v.id_tbl_programa + '>' + v.nombre_prog + '</option>');
        });

      } else {
        Swal.fire(data.messages);
      }
    },
    error: function (data) {
      Swal.fire('Error al conectar y traer datos dinamicos del programa');
    }

  });
  //get_perfil();
}

function get_perfil() {

  //limpio select
  $('#perf_select')
    .find('option')
    .remove()
    .end()
    .append('<option value=""></option>')
    .val('');

  //cargo select
  $.ajax({
    url: base_url + '/api/perfilest/alldata',
    method: 'GET',
    beforeSend: function () {
    },
    success: function (data) {

      if (data.status == '200') {

        $.each(data.data, function (k, v) {
          $("#perf_select").append('<option value=' + v.id_tbl_perfil_est + '>' + v.nombre + '</option>');
        });

      } else {
        Swal.fire(data.messages);
      }
    },
    error: function (data) {
      Swal.fire('Error al conectar y traer datos dinamicos del programa');
    }

  });

}




async function calldata() {
  var html = [];
  $('#titulouss').empty();
  $('#contenido').empty();
  var uss = $('#uss_select').val();
  var gus = $('#gus_select').val();
  var svo = $('#svo_select').val();
  var prog = $('#prog_select').val();
  var perf = $('#perf_select').val();


  //valida 1
  if (uss > 0 && gus > 0) {

    $.ajax({
      url: base_url + '/api/capmedinstall/buscar',
      method: 'POST',
      data: { pkuss: uss, pkgus: gus, pksvo: svo, pkprog: prog, pkperf: perf },
      beforeSend: function () {
      },
      success: function (data) {
        html.unshift();
        if (data.status == '200') {

          $.each(data.data, function (k, v) {
            //console.log('num_cama_uus');
            v.num_cama_uus = (v.num_cama_uus.length === 0) ? "N/A" : v.num_cama_uus;
            v.num_consultorio_uus = (v.num_consultorio_uus.length === 0) ? "N/A" : v.num_consultorio_uus;
            v.num_paciente_uus = (v.num_paciente_uus.length === 0) ? "N/A" : v.num_paciente_uus;
            v.capa_max_estud_cama = (v.capa_max_estud_cama === null) ? "N/A" : v.capa_max_estud_cama;
            v.capa_max_estud_consulta = (v.capa_max_estud_consulta === null) ? "N/A" : v.capa_max_estud_consulta;
            v.capa_max_estud_paciente = (v.capa_max_estud_paciente === null) ? "N/A" : v.capa_max_estud_paciente;

            html.push('<div class="col-md-6">' +
              '<div class="card">' +
              '<div class="card-header">' +
              '<div class="card-title">' + v.numero + '-' + v.grupo + '</div>' +
              '</div>' +
              '<div class="card-body">' +
              '<div class="row">' +
              '<div class="col-md-12">' +
              '<div class="table-responsive table-hover table-sales">' +
              '<table class="table">' +
              '<tbody>' +
              '<tr>' +
              '<td class="text-center text-primary">' + v.codigo + '</td>' +
              '<td class="text-center text-primary">' + v.nombreserv + '</td>' +
              '<td class="text-center text-primary">' + v.programa + '</td>' +
              '<td class="text-center text-primary">' + v.perfil_est + '</td>' +
              '</tr>' +
              '</tbody>' +
              '</table>' +
              '</div>' +
              '</div>' +
              '</div>' +
              '<h6 class="fw-bold text-uppercase op-8">Esatndar definido</h6>' +
              '<div class="row">' +
              '<div class="col-md-12">' +
              '<div class="table-responsive table-hover table-sales">' +
              '<table class="table">' +
              '<thead>' +
              '<tr>' +
              '<th scope="col">Estándar Número estudiantes</th>' +
              '<th scope="col">Número de camas, No quirófanos,  No de consultorios y No de pacientes en relación al estadar de estudiantes</th>' +
              '<th scope="col">Estándar Número de estudiantes por cada docente</th>' +
              '</tr>' +
              '</thead>' +
              '<tbody>' +
              '<tr>' +
              '<td>' + v.num_estudiantes + '</td>' +
              '<td>' + v.num_pacientes + '</td>' +
              '<td class="">' + v.num_estudiante_x_docente + '</td>' +
              '</tr>' +
              '</tbody>' +
              '</table>' +
              '</div>' +
              '</div>' +
              '</div>' +
              '<h6 class="fw-bold text-uppercase op-8">Datos de la Unidad de Servicio</h6>' +
              '<div class="row">' +
              '<div class="col-md-12">' +
              '<div class="table-responsive table-hover table-sales">' +
              '<table class="table">' +
              '<thead>' +
              '<tr>' +
              '<th scope="col">No camas, No de camillas, No quirófanos del servicio en la USS</th>' +
              '<th scope="col">No Consultorios y/o unidades odontológicas del servicio en la USS</th>' +
              '<th scope="col">No de pacientes en la USS</th>' +
              '</tr>' +
              '</thead>' +
              '<tbody>' +
              '<tr>' +
              '<td class="">' + v.num_cama_uus + '</td>' +
              '<td>' + v.num_consultorio_uus + '</td>' +
              '<td>' + v.num_paciente_uus + '</td>' +
              '</tr>' +
              '</tbody>' +
              '</table>' +
              '</div>' +
              '</div>' +
              '</div>' +
              '<h6 class="fw-bold text-uppercase op-8">Capacidad médica.</h6>' +
              '<div class="row">' +
              '<div class="col-md-12">' +
              '<div class="table-responsive table-hover table-sales">' +
              '<table class="table">' +
              '<thead>' +
              '<tr>' +
              '<th scope="col">Capacidad máxima de estudiantes según No de camas  de la USS</th>' +
              '<th scope="col">Capacidad máxima de estudiantes según No de consultorios y/o unidades odontológicas  de la USS</th>' +
              '<th scope="col">Capacidad máxima de estudiantes según No de pacientes</th>' +
              '</tr>' +
              '</thead>' +
              '<tbody>' +
              '<tr>' +
              '<td>' + v.capa_max_estud_cama + '</td>' +
              '<td>' + v.capa_max_estud_consulta + '</td>' +
              '<td>' + v.capa_max_estud_paciente + '</td>' +
              '</tr>' +
              '</tbody>' +
              '</table>' +
              '</div>' +
              ' </div>' +
              '</div>' +
              '<div class="row">' +
              '<div class="col-md-12">' +
              '<div class="table-responsive table-hover table-sales">' +
              '<table class="table">' +
              '<thead>' +
              '<tr>' +
              '<th class="text-center" scope="col">Número de docentes requeridos</th>' +
              '</tr>' +
              '</thead>' +
              '<tbody>' +
              '<tr>' +
              '<td class="text-center text-success"><h4>' + v.num_docen_requiere + '</h4></td>' +
              '</tr>' +
              '</tbody>' +
              '</table>' +
              '</div>' +
              '</div>' +
              '</div>' +
              '</div>' +
              '</div>' +
              '</div>');
          });

          //((v.num_cama_uus.length === 0 ) ? +'<td class="text-center">N/A</td>' : console.log("222"));
          //console.log(data.data[0].nombreuss);

          $('#titulouss').append('UNIDAD DE SERVICIOS DE SALUD: <h1 class="text-success" >' + data.data[0].nombreuss + '</h1>');
          $('#contenido').append(html);
        } else {
          Swal.fire(data.messages);
        }
      },
      error: function (data) {
        Swal.fire('Error al conectar y traer datos dinamicos');
      }

    });

    /*} else if (uss > 0 && gus > 0 && svo > 0 && prog > 0 && perf.length == 0) {
      console.log('hola2');
    } else if (uss > 0 && gus > 0 && svo > 0 && prog.length > 0 && perf.length > 0) {
      console.log('hola3');*/
  } else {

  }


}

function sendmodal(params) {
  $('#exampleModal').modal('toggle');
  $('#exampleModal').modal('show');
  //$('#exampleModal').modal('hide');
}


