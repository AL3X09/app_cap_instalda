//creado por Alex Cs 18/04/2021

$(document).ready(function () {
  cargardataestand();
});

function cargardataestand() {

  $.ajax({
    url: base_url+ '/api/capinstalada/alldata',
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

function get_uus(iduus) {

  /*if($('#gus_selectd').length){
    uus = $('#gus_selectd').val();
  }else{}*/
  //limpio select
  $('#uus_select')
    .find('option')
    .remove()
    .end()
    .append('<option value="">Seleccione</option>')
    .val('');
  //cargo select
  $.ajax({
    url: base_url+ '/api/uss/alldata',
    method: 'GET',
    beforeSend: function () {
    },
    success: function (data) {

      if (data.status == '200') {

        $.each(data.data, function (k, v) {
          $("#uus_select").append('<option value=' + v.id_tbl_uni_serv_salud + '>' + v.nombre + '</option>');

          if ($("#uus_selectd").length) {
            $("#uus_selectd").append('<option value=' + v.id_tbl_uni_serv_salud + '>' + v.nombre + '</option>');
            $("#uus_selectd").val(iduus);
          }
        });

      } else {
        Swal.fire(data.messages);
      }
    },
    error: function (data) {
      Swal.fire('Error al conectar y traer datos dinamicos');
    }

  });

}

function get_gus(idgus) {


  var uus = $('#uus_select').val();

  //limpio select
  $('#gus_select')
    .find('option')
    .remove()
    .end()
    .append('<option value="">Seleccione</option>')
    .val('');
  //cargo select
  $.ajax({
    url: base_url+ '/api/gus/fkagrupado',
    method: 'POST',
    data: { pkuus: uus },
    beforeSend: function () {
    },
    success: function (data) {

      if (data.status == '200') {

        $.each(data.data, function (k, v) {
          $("#gus_select").append('<option value=' + v.id_tbl_grup_servicio + '>' + v.numero + '-' + v.grupo + '</option>');

          if ($("#gus_selectd").length) {
            $("#gus_selectd").append('<option value=' + v.id_tbl_grup_servicio + '>' + v.numero + '-' + v.grupo + '</option>');
            $("#gus_selectd").val(idgus);
          }
        });

      } else {
        Swal.fire(data.messages);
      }
    },
    error: function (data) {
      Swal.fire('Error al conectar y traer datos dinamicos');
    }

  });

}

function get_svo(idsvo) {

  //obtengo el valor del select
  var gus = $('#gus_select').val();

  //limpio select
  $('#svo_select')
    .find('option')
    .remove()
    .end()
    .append('<option value="">Seleccione</option>')
    .val('');
  //cargo select
  $.ajax({
    url: base_url+ '/api/svo/fkagrupado',
    method: 'POST',
    data: { pkgus: gus },
    beforeSend: function () {
    },
    success: function (data) {

      if (data.status == '200') {

        $.each(data.data, function (k, v) {
          $("#svo_select").append('<option value=' + v.id_tbl_serv_ofertado + '>' + v.nombre_serv + '</option>');

          if ($("#svo_selectd").length) {
            $("#svo_selectd").append('<option value=' + v.id_tbl_serv_ofertado + '>' + v.nombre_serv + '</option>');
            $("#svo_selectd").val(idsvo);
          }
        });

      } else {
        Swal.fire(data.messages);
      }
    },
    error: function (data) {
      Swal.fire('Error al conectar y traer datos dinamicos del grupo');
    }

  });

}

function get_programa(idprog) {
  //obtengo el valor del select
  var sov = $('#svo_select').val();

  //limpio select
  $('#prog_select')
    .find('option')
    .remove()
    .end()
    .append('<option value="">Seleccione</option>')
    .val('');
  //cargo select
  $.ajax({
    url: base_url+ '/api/programa/fkagrupado',
    method: 'POST',
    data: { pksov: sov },
    beforeSend: function () {
    },
    success: function (data) {

      if (data.status == '200') {

        $.each(data.data, function (k, v) {
          $("#prog_select").append('<option value=' + v.id_tbl_programa + '>' + v.nombre_prog + '-' + v.perfil_est + '</option>');

          if ($("#prog_selectd").length) {
            $("#prog_selectd").append('<option value=' + v.id_tbl_programa + '>' + v.nombre_prog + '-' + v.perfil_est + '</option>');
            $("#prog_selectd").val(idprog);
          }
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

function cargar_tablesstand(data) {
  $('#table_prog').bootstrapTable({
    search: true,
    showRefresh: false,
    showExport: true,
    filter: true,
    exportTypes: ['json', 'xml', 'csv', 'txt', 'sql', 'excel', 'pdf'],
    //buttonsAlign: 'left',
    columns: [
      {
        field: 'nombreuss',
        title: 'Unidad de servicio',
      },
      {
        field: 'numero',
        title: 'Num grupo'
      },
      {
        field: 'grupo',
        title: 'Grupo'
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
      //data1
      {
        field: 'num_estudiantes',
        title: 'Núm estudiantes'
      },
      {
        field: 'num_pacientes',
        title: 'Núm de pacientes en relación al estadar de estudiantes'
      },
      {
        field: 'num_estudiante_x_docente',
        title: 'Número de estudiantes por cada docente'
      },
      //data2
      {
        field: 'num_cama_uus',
        title: 'Núm camas, No de camillas, No quirófanos del servicio en la USS'
      },
      {
        field: 'num_consultorio_uus',
        title: 'Núm Consultorios y/o unidades odontológicas del servicio en la USS'
      },
      {
        field: 'num_paciente_uus',
        title: 'Número de pacientes en la USS'
      },
      //data3
      {
        align: 'center',
        valign: 'middle',
        field: 'capa_max_estud_cama',
        title: 'Número de estudiantes por cada docenteCapacidad máxima de estudiantes según No de camas  de la USS',
      },
      {
        field: 'capa_max_estud_consulta',
        title: 'Capacidad máxima de estudiantes según No de consultorios y/o unidades odontológicas  de la USS'
      },
      {
        field: 'capa_max_estud_paciente',
        title: 'Capacidad máxima de estudiantes según No de pacientes'
      },
      {
        field: 'num_docen_requiere',
        title: 'Número de docentes requeridos'
      },
      {
        field: 'is_active',
        title: 'Estado'
      },
      {
        field: 'operate',
        title: 'Opciones',
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

function insertestd() {
  
  $.ajax({
    url: base_url+ '/api/estandar/crear',
    method: 'POST',
    data: $("#formcapinstalada").serialize(),
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
        //window.setTimeout(function () { }, 4000);
        //location.reload();
        insertcapuus();
      } else {
        Swal.fire(data.messages);
      }

    }
  });

}

function insertcapuus() {

  $.ajax({
    url: base_url+ '/api/capacidaduus/crear',
    method: 'POST',
    data: $("#formcapinstalada").serialize(),
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
        //window.setTimeout(function () { }, 4000);
        //location.reload();
        insertcapinsta();
      } else {
        Swal.fire(data.messages);
      }

    }
  });

}

function insertcapinsta() {

  $.ajax({
    url: base_url+ '/api/capinstalada/crear',
    method: 'POST',
    data: $("#formcapinstalada").serialize(),
    beforeSend: function () {
    },
    success: function (data) {

      if (data.status == '201') {

        swal.fire({
          title: "",
          text: data.messages,
          type: "success",
          timer: 5000,
          showConfirmButton: false
        });
        window.setTimeout(function () { }, 5000);
        location.reload();
      } else {
        Swal.fire(data.messages);
      }

    }
  });

}

function insertcapainsta() {

  $.ajax({
    url: base_url+ '/api/insertcapainsta/crear',
    method: 'POST',
    data: $("#forminsertestd").serialize(),
    beforeSend: function () {
    },
    success: function (data) {

      if (data.status == '201') {

        swal.fire({
          title: "",
          text: data.messages,
          type: "success",
          timer: 5000,
          showConfirmButton: false
        });
        window.setTimeout(function () { }, 5000);
        location.reload();
        
      } else {
        Swal.fire(data.messages);
      }

    }
  });

}


function updatestand(params) {
  $('#exampleModal').modal('toggle');
  $('#exampleModal').modal('show');
  //$('#exampleModal').modal('hide');
}

async function updatestand1($id) {

  $.ajax({
    url: base_url+ '/api/XX/buscar',
    method: 'POST',
    data: { idstand: $id },
    beforeSend: function () {
    },
    success: function (data) {

      if (data.status == '200') {

        //console.log(data.data.fk_tbl_serv_hospital);
        Swal.fire({
          title: 'Actualizar',
          html: '<form id="formupdatestandar" method="post">' +
            '<label for="svo" class="col-form-label">Unidad de servicios</label>' +
            '<select class="form-control form-control" id="uus_selectd" name="pkuus" required onchange="cambio_uus()">' +
            '</select>' +
            '<label for="pkgus" class="col-form-label">Grupo</label>' +
            '<select class="form-control form-control" id="gus_selectd" name="pkgus" required>' +
            '</select>' +
            '<label for="pksvo" class="col-form-label">Servicio ofertado</label>' +
            '<select class="form-control form-control" id="svo_selectd" name="pksvo" required>' +
            '</select>' +
            '<label for="prog" class="col-form-label">Programa</label>' +
            '<select class="form-control form-control" id="prog_selectd" name="pkprog" required>' +
            '</select>' +
            '<label for="numest" class="col-form-label">Núm estudiantes</label>' +
            '<input type="text" id="numest" name="numest" class="swal2-input" value="' + data.data.num_estudiantes + '">' +
            '<label for="numpaci" class="col-form-label">Núm pacientes</label>' +
            '<input type="text" id="numpaci" name="numpaci" class="swal2-input" value="' + data.data.num_pacientes + '">' +
            '<label for="numestdoc" class="col-form-label">Núm estudiantes por docente</label>' +
            '<input type="text" id="numestdoc" name="numestdoc" class="swal2-input" value="' + data.data.num_estudiante_x_docente + '">' +
            '<input type="hidden" id="idstand" name="idstand" class="swal2-input"  value="' + data.data.id_tbl_estandar + '">' +
            '</form>',
          confirmButtonText: 'actualizar',
          focusConfirm: false,
          didOpen() {
            //console.log(data.data.fk_tbl_programa);
            get_programa(data.data.fk_tbl_programa, data.data.id_tbl_serv_ofertado);
            get_svo(data.data.id_tbl_serv_ofertado, data.data.id_tbl_grup_servicio);
            get_gus(data.data.id_tbl_grup_servicio, data.data.id_tbl_uni_serv_salud);
            get_uus(data.data.id_tbl_uni_serv_salud);

          },
          preConfirm: () => {

            const grupo = Swal.getPopup().querySelector('#programa').value
            //const form = Swal.getPopup().querySelector('#formupdatehso')
            //const password = Swal.getPopup().querySelector('#password').value
            if (!grupo) {
              Swal.showValidationMessage('Diligencie el Programa')
            } else
              return { grupo: grupo }
          },
          //$("#hso_selectd").val(data.data.fk_tbl_serv_hospital).change();
        }).then((result) => {

          if (result.isConfirmed) {
            //ajax update
            $.ajax({
              url: 'api/estandar/editar',
              method: 'POST',
              data: $("#formupdatestandar").serialize(),
              beforeSend: function () {
              },
              success: function (data) {

                if (data.status == '201') {

                  swal.fire({
                    title: data.messages,
                    text: "",
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

        })

      } else {
        Swal.fire(data.messages);
      }


    }
  });
  //get_hso();

}

function deletestand($id) {

  $.ajax({
    url: base_url+ '/api/XX/eliminar',
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

/*function cambio_uus() {

  uus = $('#gus_selectd').val();
  $('#gus_selectd')
    .find('option')
    .remove()
    .end()
    .append('<option value="">Seleccione</option>')
    .val('');
  get_gus('',uus);
}

function cambio_gus() {

  gus = $('#gus_selectd').val();
  $('#gus_selectd')
    .find('option')
    .remove()
    .end()
    .append('<option value="">Seleccione</option>')
    .val('');
  get_svo('',gus);
}*/