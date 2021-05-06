//creado por Alex Cs 18/04/2021

$(document).ready(function () {
  cargardatasvo();
});

function cargardatasvo() {

  $.ajax({
    url: base_url+ '/api/svo/alldata',
    method: 'get',
    contentType: 'application/json',
  }).done(function (res) {
    //console.log(res);//data=msg.data;
    if (res.status == '200') {
      cargar_tablesvo(res.data);
    } else {
      //alert(data.messages);
      Swal.fire(res.data);
    }
  });
  //get_hso();
}

function cargar_tablesvo(data) {
  $('#table_svo').bootstrapTable({
    search: true,
    showRefresh: false,
    buttonsAlign: 'left',
    columns: [
      {
        field: 'nombre_serv',
        title: 'Nombre servicio'
      }, 
      {
        field: 'nombreg',
        title: 'Grupo de Servicios'
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
          return '<button type="button" class="btn btn-icon btn-round btn-success" onclick="updatesvo(' + row.id_tbl_serv_ofertado + ')"><i class="fa icon-refresh"></i></button>' +
            '<button type="button" class="btn btn-icon btn-round btn-danger" onclick="deletesvo(' + row.id_tbl_serv_ofertado + ')"><i class="fa icon-trash"></i></button>';
        }
      },
    ],
    data: data,

  })



}

function get_gus($idgus) {
  //limpio select
  $('#gus_select')
    .find('option')
    .remove()
    .end()
    .append('<option value="">Seleccione</option>')
    .val('');
  //cargo select
  $.ajax({
    url: base_url+ '/api/gus/alldata',
    method: 'GET',
    beforeSend: function () {
    },
    success: function (data) {

      if (data.status == '200') {

        $.each(data.data, function (k, v) {
          $("#gus_select").append('<option value=' + v.id_tbl_grup_servicio + '>' +v.numero + '-'+ v.grupo + '</option>');
          
          if ($("#gus_selectd").length) {
            $("#gus_selectd").append('<option value=' + v.id_tbl_grup_servicio + '>' +v.numero + '-'+ v.grupo + '</option>');
            $("#gus_selectd").val($idgus);
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

function insertsvo() {

  $.ajax({
    url: base_url+ '/api/svo/crear',
    method: 'POST',
    data: $("#forminsertsvo").serialize(),
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

async function updatesvo($id) {

  $.ajax({
    url: base_url+ '/api/svo/buscar',
    method: 'POST',
    data: { pksvo: $id },
    beforeSend: function () {
    },
    success: function (data) {
      
      if (data.status == '200') {
        
        //console.log(data.data.fk_tbl_serv_hospital);
        Swal.fire({
          title: 'Actualizar',
          html: '<form id="formupdatesvo" method="post">' +
            '<label for="gus" class="col-form-label">Grupo</label>'+
            '<select class="form-control form-control" id="gus_selectd" name="pkgus" required>' +
            '</select>' +
            '<label for="nombre" class="col-form-label">Servicio ofertado</label>'+
            '<input type="text" id="nombre" name="nombre" class="swal2-input" value="' + data.data.nombre_serv + '">' +
            '<input type="hidden" id="idsvo" name="idsvo" class="swal2-input"  value="' + data.data.id_tbl_grup_servicio + '">' +
            '</form>',
          confirmButtonText: 'actualizar',
          focusConfirm: false,
          didOpen() {
            //console.log(data.data.fk_tbl_grupo_serv);
            get_gus(data.data.fk_tbl_grupo_serv)
          },         
          preConfirm: () => {
            
            const grupo = Swal.getPopup().querySelector('#nombre').value
            //const form = Swal.getPopup().querySelector('#formupdatehso')
            //const password = Swal.getPopup().querySelector('#password').value
            if (!grupo) {
              Swal.showValidationMessage('Diligencie el Servicio ofertado')
            } else
              return { grupo: grupo }
          },
          //$("#hso_selectd").val(data.data.fk_tbl_serv_hospital).change();
        }).then((result) => {

          if (result.isConfirmed) {
            //ajax update
            $.ajax({
              url: 'api/svo/editar',
              method: 'POST',
              data: $("#formupdatesvo").serialize(),
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

function deletesvo($id) {

  $.ajax({
    url: base_url+ '/api/svo/eliminar',
    method: 'POST',
    data: { idsvo: $id },
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

