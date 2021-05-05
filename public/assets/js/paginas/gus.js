//creado por Alex Cs 18/04/2021

$(document).ready(function () {
  cargardatagus();
});

function cargardatagus() {

  $.ajax({
    url: '/api/gus/alldata',
    method: 'get',
    contentType: 'application/json',
  }).done(function (res) {
    //console.log(res);//data=msg.data;
    if (res.status == '200') {
      cargar_tablegus(res.data);
    } else {
      //alert(data.messages);
      Swal.fire(res.data);
    }
  });
  //get_hso();
}

function cargar_tablegus(data) {
  $('#table_gus').bootstrapTable({
    search: true,
    showRefresh: false,
    buttonsAlign: 'left',
    columns: [
      {
        field: 'numero',
        title: 'Número'
      }, {
        field: 'grupo',
        title: 'Grupo'
      },
      {
        field: 'codigo',
        title: 'Código'
      },
      {
        field: 'nombres',
        title: 'Unidad de Servicios'
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
          return '<button type="button" class="btn btn-icon btn-round btn-success" onclick="updategus(' + row.id_tbl_grup_servicio + ')"><i class="fa icon-refresh"></i></button>' +
            '<button type="button" class="btn btn-icon btn-round btn-danger" onclick="deletegus(' + row.id_tbl_grup_servicio + ')"><i class="fa icon-trash"></i></button>';
        }
      },
    ],
    data: data,

  })



}

function get_uss($iduss) {
  //limpio select
  $('#uss_select')
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
          $("#uss_select").append('<option value=' + v.id_tbl_uni_serv_salud + '>' + v.nombre + '</option>');
          if ($("#uss_selectd").length) {
            $("#uss_selectd").append('<option value=' + v.id_tbl_uni_serv_salud + '>' + v.nombre + '</option>');
            $("#uss_selectd").val($iduss);
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

function insertgus() {

  $.ajax({
    url: 'api/gus/crear',
    method: 'POST',
    data: $("#forminsertgus").serialize(),
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

async function updategus($id) {

  $.ajax({
    url: 'api/gus/buscar',
    method: 'POST',
    data: { pkgus: $id },
    beforeSend: function () {
    },
    success: function (data) {
      
      if (data.status == '200') {
        
        //console.log(data.data.fk_tbl_serv_hospital);
        Swal.fire({
          title: 'Actualizar',
          html: '<form id="formupdategus" method="post">' +
            '<label for="uss" class="col-form-label">Unidad de servicios</label>'+
            '<select class="form-control form-control" id="uss_selectd" name="pkuss" required>' +
            '</select>' +
            '<label for="numero" class="col-form-label">Número</label>'+
            '<input type="text" id="numero" name="numero" class="swal2-input" value="' + data.data.numero + '">' +
            '<label for="grupo" class="col-form-label">Grupo</label>'+
            '<input type="text" id="grupo" name="grupo" class="swal2-input" value="' + data.data.grupo + '">' +
            '<label for="codigo" class="col-form-label">Código</label>'+
            '<input type="text" id="codigo" name="codigo" class="swal2-input" value="' + data.data.codigo + '">' +
            '<input type="hidden" id="idgus" name="idgus" class="swal2-input"  value="' + data.data.id_tbl_grup_servicio + '">' +
            '</form>',
          confirmButtonText: 'actualizar',
          focusConfirm: false,
          didOpen() {
            get_uss(data.data.fk_tbl_serv_salud)
          },         
          preConfirm: () => {
            
            const grupo = Swal.getPopup().querySelector('#grupo').value
            //const form = Swal.getPopup().querySelector('#formupdatehso')
            //const password = Swal.getPopup().querySelector('#password').value
            if (!grupo) {
              Swal.showValidationMessage('Diligencie el campo de Grupo')
            } else
              return { grupo: grupo }
          },
          //$("#hso_selectd").val(data.data.fk_tbl_serv_hospital).change();
        }).then((result) => {

          if (result.isConfirmed) {
            //ajax update
            $.ajax({
              url: 'api/gus/editar',
              method: 'POST',
              data: $("#formupdategus").serialize(),
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

              }
            });
          }

        })

        //get_hso();
        if ($('#hso_selectd').has('option').length > 0) {
          //$('#hso_selectd').val(1);
          //$("#hso_selectd > select > option[value=" + 1 + "]").prop("selected",true);
          //$('#hso_selectd option[value="${data.data.fk_tbl_serv_hospital}"]').prop('selected', true);
          //console.log(data.data.fk_tbl_serv_hospital);
          //$("#hso_selectd").val(data.data.fk_tbl_serv_hospital);
        }
        
        

        
      } else {
        Swal.fire(data.messages);
      }
      
      
    }
  });
  //get_hso();
  
}

function deletegus($id) {

  $.ajax({
    url: 'api/gus/eliminar',
    method: 'POST',
    data: { idgus: $id },
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

