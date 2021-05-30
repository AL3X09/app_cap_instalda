//creado por Alex Cs 18/04/2021

$(document).ready(function () {
  //$(".collapsed").attr("aria-expanded","true");
  $("#base").addClass("show");
  $('#btnest').addClass("active");
  cargardataestan();
});


function cargardataestan() {

  $.ajax({
    url: base_url + '/api/estandar/alldata',
    method: 'get',
    contentType: 'application/json',
  }).done(function (res) {
    //console.log(res);//data=msg.data;
    if (res.status == '200') {
      cargar_tablestan(res.data);
    } else {
      //alert(data.messages);
      Swal.fire(res.data);
    }
  });
  //get_hso();
}

function get_uus(iduus) {

  //limpio select
  $('#uus_select')
    .find('option')
    .remove()
    .end()
    .append('<option value="">Seleccione</option>')
    .val('');
  //cargo select
  $.ajax({
    url: base_url + '/api/uss/alldata',
    method: 'GET',
    beforeSend: function () {
    },
    success: function (data) {

      if (data.status == '200') {

        $.each(data.data, function (k, v) {
          $("#uus_select").append('<option value=' + v.id_tbl_uni_serv_salud + '>' + v.nombre + '</option>');

          /*if (iduus>0) {
            //$("#uus_select").append('<option value=' + v.id_tbl_uni_serv_salud + '>' + v.nombre + '</option>');
            //$("#uus_select").val(iduus).change();
            //$("#uus_select").change();
          }*/
        });

      } else {
        Swal.fire(data.messages);
      }
    },
    error: function (data) {
      Swal.fire('Error al conectar y traer datos dinamicos');
    }

  });
  //get_gus();
}

function get_gus(idgus) {

  //console.info($('#uus_select'));
  //var uus = $('#uus_select').val();

  //limpio select
  $('#gus_select')
    .find('option')
    .remove()
    .end()
    .append('<option value="">Seleccione</option>')
    .val('');
  //cargo select
  $.ajax({
    url: base_url + '/api/gus/alldata',
    method: 'GET',
    beforeSend: function () {
    },
    success: function (data) {

      if (data.status == '200') {

        $.each(data.data, function (k, v) {
          $("#gus_select").append('<option value=' + v.id_tbl_grup_servicio + '>' + v.numero + '-' + v.grupo + '</option>');

          /*if (idgus>0) {
            //$("#gus_selectd").append('<option value=' + v.id_tbl_grup_servicio + '>' + v.numero + '-' + v.grupo + '</option>');
            $("#gus_select").val(idgus);
          }*/
        });

      } else {
        Swal.fire(data.messages);
      }
    },
    error: function (data) {
      Swal.fire('Error al conectar y traer datos dinamicos');
    }

  });
  //get_svo();

}

function get_svo(idsvo) {

  //obtengo el valor del select
  //var gus = $('#gus_select').val();
  //console.info($('#gus_select'));

  //limpio select
  $('#svo_select')
    .find('option')
    .remove()
    .end()
    .append('<option value="">Seleccione</option>')
    .val('');
  //cargo select
  $.ajax({
    url: base_url + '/api/svo/alldata',
    method: 'GET',
    //data: { pkgus: gus },
    beforeSend: function () {
    },
    success: function (data) {

      if (data.status == '200') {

        $.each(data.data, function (k, v) {
          $("#svo_select").append('<option value=' + v.id_tbl_serv_ofertado + '>' + v.nombre_serv + '</option>');

          /*if (idsvo>0) {
            //$("#svo_selectd").append('<option value=' + v.id_tbl_serv_ofertado + '>' + v.nombre_serv + '</option>');
            $("#svo_select").val(idsvo);
          }*/
        });

      } else {
        Swal.fire(data.messages);
      }
    },
    error: function (data) {
      Swal.fire('Error al conectar y traer datos dinamicos del grupo');
    }

  });
  //get_programa();

}

function get_programa(idprog) {
  //obtengo el valor del select
  //var sov = $('#svo_select').val();

  //limpio select
  $('#prog_select')
    .find('option')
    .remove()
    .end()
    .append('<option value="">Seleccione</option>')
    .val('');
  //cargo select
  $.ajax({
    url: base_url + '/api/programa/alldata',
    method: 'GET',
    //data: { pksov: sov },
    beforeSend: function () {
    },
    success: function (data) {

      if (data.status == '200') {

        $.each(data.data, function (k, v) {
          $("#prog_select").append('<option value=' + v.id_tbl_programa + '>' + v.nombre_prog + '</option>');

          /*if (idprog>0) {
            //$("#prog_selectd").append('<option value=' + v.id_tbl_programa + '>' + v.nombre_prog + '-' + v.perfil_est + '</option>');
            $("#prog_select").val(idprog);
          }*/
        });

      } else {
        Swal.fire(data.messages);
      }
    },
    error: function (data) {
      Swal.fire('Error al conectar y traer datos dinamicos del programa');
    }

  });
  //get_perfil_est();
}

function get_perfil_est(idprog) {
  //obtengo el valor del select
  //var sov = $('#svo_select').val();

  //limpio select
  $('#perf_select')
    .find('option')
    .remove()
    .end()
    .append('<option value="">Seleccione</option>')
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

          /*if (idprog>0) {
            //$("#prog_selectd").append('<option value=' + v.id_tbl_programa + '>' + v.nombre_prog + '-' + v.perfil_est + '</option>');
            $("#perf_select").val(idprog);
          }*/
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

function cargar_tablestan(data) {
  $('#table_esta').bootstrapTable({
    search: true,
    showRefresh: false,
    buttonsAlign: 'left',
    columns: [
      
      {
        field: 'numero',
        title: 'N°'
      },
      {
        field: 'grupo',
        title: 'Grupo'
      },
      {
        field: 'codigo',
        title: 'Código'
      },
      {
        field: 'nombreserv',
        title: 'Servicio Ofertado'
      },
      {
        field: 'programa',
        title: 'Programa'
      },
      {
        field: 'perfil_est',
        title: 'Perfil del estudiante'
      },
      {
        field: 'num_estudiantes',
        title: 'Número estudiantes'
      },
      {
        field: 'num_pacientes',
        title: 'No de pacientes en relación al estadar de estudiantes'
      },
      {
        field: 'num_estudiante_x_docente',
        title: 'Número de estudiantes por cada docente'
      },
      /*{
        field: 'observacion',
        title: 'observación'
      },*/
      {
        field: 'is_active',
        title: 'Estado'
      },
      {
        field: 'operate',
        title: 'Edit',
        align: 'center',
        valign: 'middle',
        clickToSelect: false,
        formatter: function (value, row, index) {
          return '<button type="button" class="btn btn-icon btn-round btn-success" onclick="updatestand(' + row.id_tbl_estandar + ')"><i class="fa icon-refresh"></i></button>' +
            '<button type="button" class="btn btn-icon btn-round btn-danger" onclick="deletestand(' + row.id_tbl_estandar + ')"><i class="fa icon-trash"></i></button>';
        }
      },
    ],
    data: data,

  })

}

function insertasocia() {

  $.ajax({
    url: base_url + '/api/asociacion/crear',
    method: 'POST',
    data: $("#forminsertestandar").serialize(),
    beforeSend: function () {
    },
    success: function (data) {

      if (data.status == '201') {

        /*swal.fire({
          title: "",
          text: data.messages,
          type: "success",
          timer: 4000,
          showConfirmButton: false
        });
        window.setTimeout(function () { }, 4000);
        location.reload();*/
        insertestan();
      } else {
        Swal.fire(data.messages);
      }

    }
  });
  //insertestan();
}

function insertestan() {

  $.ajax({
    url: base_url + '/api/estandar/crear',
    method: 'POST',
    data: $("#forminsertestandar").serialize(),
    beforeSend: function () {
    },
    success: function (data) {

      if (data.status == '201') {

        swal.fire({
          title: "",
          text: data.messages,
          type: "success",
          timer: 4000,
          showConfirmButton: false
        });
        window.setTimeout(function () { }, 4000);
        location.reload();
      } else {
        Swal.fire(data.messages);
      }

    }
  });

}

async function updatestand($id) {
  $('#exampleModal').modal('toggle');
  $('#exampleModal').modal('show');

  get_uus();
  get_gus();
  get_svo();
  get_programa();
  get_perfil_est();

  updatestan2($id);

}

function updatestan2($id) {

  var datos;
  $.ajax({
    url: base_url + '/api/estandar/buscar',
    method: 'POST',
    data: { idstand: $id },
    beforeSend: function () {


    },
    success: function (data) {

      if (data.status == '200') {
        datos = data.data;
      } else {
        Swal.fire(data.messages);
      }

    },
    complete: function () {

      if (datos !== null) {
        $("#uus_select").val(datos.id_tbl_uni_serv_salud);

        $("#gus_select").val(datos.id_tbl_grup_servicio);

        $("#svo_select").val(datos.id_tbl_serv_ofertado);

        $("#prog_select").val(datos.id_tbl_programa);
        
        $("#perf_select").val(datos.id_tbl_perfil_est);

        $("#numest").val(datos.num_estudiantes);
        $("#numpaci").val(datos.num_pacientes);
        $("#numestydoc").val(datos.num_estudiante_x_docente);
        $("#observa").val(datos.observacion);
        $("#divhidden").html('<input type="hidden" id="idrelaci" name="idrelaci" value="'+datos.fk_tbl_uss_gus_svo_pro+'">'+
                             '<input type="hidden" id="idestand" name="idestand" value="'+datos.id_tbl_estandar+'">');
        
        $("#btnactua").removeClass('invisible').addClass('visible');
        $("#btnsave").addClass('invisible');

      }
      //console.log(datos);
    }
  });

}

async function updatestan3() {

  $.ajax({
    url: base_url + '/api/asociacion/editar',
    method: 'POST',
    data: $("#forminsertestandar").serialize(),
    beforeSend: function () {
    },
    success: function (data) {

      if (data.status == '201') {
        
        $.ajax({
          url: base_url + '/api/estandar/editar',
          method: 'POST',
          data: $("#forminsertestandar").serialize(),
          beforeSend: function () {
          },
          success: function (data) {
      
            if (data.status == '201') {
              swal.fire({
                title: data.messages,
                text: "",
                type: "success",
                timer: 3000,
                showConfirmButton: false
              });
              window.setTimeout(function () { }, 3000);
              location.reload();
            } else {
              Swal.fire(data.messages);
            }
      
          },
          error: function (data) {
            Swal.fire('Error al actualizar el estandar');
          }
        })
      }

    },
    error: function (data) {
      Swal.fire('Error al actualizar la asociancion del estandar');
    }
  });

}


function deletestan($id) {

  $.ajax({
    url: base_url + '/api/asociacion/eliminar',
    method: 'POST',
    data: { idprog: $id },
    beforeSend: function () {
    },
    success: function (data) {

      if (data.status == '201') {

        swal.fire({
          title: data.messages,
          text: '',
          type: "success",
          timer: 4000,
          showConfirmButton: false
        });
        window.setTimeout(function () { }, 4000);
        location.reload();

      } else {
        Swal.fire(data.messages);
      }

    }
  });


}

function closeM() {
  $("#uus_select").val('');

  $("#gus_select").val('');

  $("#svo_select").val('');

  $("#prog_select").val('');

  $("#perf_select").val('');

  $("#numest").val('');
  $("#numpaci").val('');
  $("#numestydoc").val('');
  $("#observa").val('');
  $("#divhidden").remove();

  $("#btnsave").removeClass('invisible').addClass('visible');
  $("#btnactua").removeClass('visible').addClass('invisible');
}
