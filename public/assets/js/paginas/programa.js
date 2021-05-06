//creado por Alex Cs 18/04/2021

$(document).ready(function () {
  cargardataprog();
});

function cargardataprog() {

  $.ajax({
    url: base_url+ '/api/programa/alldata',
    method: 'get',
    contentType: 'application/json',
  }).done(function (res) {
    //console.log(res);//data=msg.data;
    if (res.status == '200') {
      cargar_tablesprog(res.data);
    } else {
      //alert(data.messages);
      Swal.fire(res.data);
    }
  });
  //get_hso();
}

function cargar_tablesprog(data) {
  $('#table_prog').bootstrapTable({
    search: true,
    showRefresh: false,
    buttonsAlign: 'left',
    columns: [
      {
        field: 'nombres',
        title: 'servicio Ofertado'
      }, 
      {
        field: 'nombre_prog',
        title: 'Programa'
      },
      {
        field: 'nombreper',
        title: 'Perfil del estudiante'
      },
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
          return '<button type="button" class="btn btn-icon btn-round btn-success" onclick="updateprog(' + row.id_tbl_programa + ')"><i class="fa icon-refresh"></i></button>' +
            '<button type="button" class="btn btn-icon btn-round btn-danger" onclick="deleteprog(' + row.id_tbl_programa + ')"><i class="fa icon-trash"></i></button>';
        }
      },
    ],
    data: data,

  })

}

function get_svo($idsvo) {
  //limpio select
  $('#svo_select')
    .find('option')
    .remove()
    .end()
    .append('<option value="">Seleccione</option>')
    .val('');
  //cargo select
  $.ajax({
    url: base_url+ '/api/svo/alldata',
    method: 'GET',
    beforeSend: function () {
    },
    success: function (data) {

      if (data.status == '200') {

        $.each(data.data, function (k, v) {
          $("#svo_select").append('<option value=' + v.id_tbl_serv_ofertado + '>' +v.nombre_serv+ '</option>');
          
          if ($("#svo_selectd").length) {
            $("#svo_selectd").append('<option value=' + v.id_tbl_serv_ofertado + '>' +v.nombre_serv + '</option>');
            $("#svo_selectd").val($idsvo);
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
  //get_perfil()
}

function get_perfil($idperf) {
  //limpio select
  $('#perfil_select')
    .find('option')
    .remove()
    .end()
    .append('<option value="">Seleccione</option>')
    .val('');
  //cargo select
  $.ajax({
    url: base_url+ '/api/perfilest/alldata',
    method: 'GET',
    beforeSend: function () {
    },
    success: function (data) {

      if (data.status == '200') {

        $.each(data.data, function (k, v) {
          $("#perfil_select").append('<option value=' + v.id_tbl_perfil_est + '>' +v.nombre+ '</option>');
          
          if ($("#perfil_selectd").length) {
            //$("#perfil_selectd").remove();
            $("#perfil_selectd").append('<option value=' + v.id_tbl_perfil_est + '>' +v.nombre + '</option>');
            $("#perfil_selectd").val($idperf);
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

function insertprog() {

  $.ajax({
    url: base_url+ '/api/programa/crear',
    method: 'POST',
    data: $("#forminsertprog").serialize(),
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

async function updateprog($id) {

  $.ajax({
    url: base_url+ '/api/programa/buscar',
    method: 'POST',
    data: { idprog: $id },
    beforeSend: function () {
    },
    success: function (data) {
      
      if (data.status == '200') {
        
        //console.log(data.data.fk_tbl_serv_hospital);
        Swal.fire({
          title: 'Actualizar',
          html: '<form id="formupdateprog" method="post">' +
            '<label for="svo" class="col-form-label">Servicio ofertado</label>'+
            '<select class="form-control form-control" id="svo_selectd" name="pksvo" required>' +
            '</select>' +
            '<label for="programa" class="col-form-label">Programa</label>'+
            '<input type="text" id="programa" name="programa" class="swal2-input" value="' + data.data.nombre_prog + '">' +
            '<label for="svo" class="col-form-label">Perfil</label>'+
            '<select class="form-control form-control" id="perfil_selectd" name="perfil" required>' +
            '</select>' +
            '<input type="hidden" id="idprog" name="idprog" class="swal2-input"  value="' + data.data.id_tbl_programa + '">' +
            '</form>',
          confirmButtonText: 'actualizar',
          focusConfirm: false,
          didOpen() {
            //console.log(data.data.fk_tbl_grupo_serv);
            get_svo(data.data.fk_tbl_serv_ofertado);
            get_perfil(data.data.fk_tbl_perfil_est);

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
              url: 'api/programa/editar',
              method: 'POST',
              data: $("#formupdateprog").serialize(),
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

function deleteprog($id) {

  $.ajax({
    url: base_url+ '/api/programa/eliminar',
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

