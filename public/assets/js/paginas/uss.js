//creado por Alex Cs 18/04/2021

$(document).ready(function () {
  $("#base").addClass("show");
  $('#btnuss').addClass("active");
  cargardatauss();
});

function cargardatauss() {



  $.ajax({
    url: base_url+ '/api/uss/alldata',
    method: 'get',
    contentType: 'application/json',
  }).done(function (res) {
    //console.log(res);//data=msg.data;
    if (res.status == '200') {
      cargar_tableuus(res.data);
    } else {
      //alert(data.messages);
      Swal.fire(res.data);
    }
  });
  //get_hso();
}

function cargar_tableuus(data) {
  $('#table_uss').bootstrapTable({
    search: true,
    showRefresh: false,
    buttonsAlign: 'left',
    columns: [
      {
        field: 'nombre',
        title: 'Nombre'
      }, {
        field: 'direccion',
        title: 'dirección'
      },
      {
        field: 'telefono',
        title: 'Teléfono'
      },
      {
        field: 'nombreh',
        title: 'HSO'
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
          return '<button type="button" class="btn btn-icon btn-round btn-success" onclick="updateuss(' + row.id_tbl_uni_serv_salud + ')"><i class="fa icon-refresh"></i></button>' +
            '<button type="button" class="btn btn-icon btn-round btn-danger" onclick="deleteuss(' + row.id_tbl_uni_serv_salud + ')"><i class="fa icon-trash"></i></button>';
        }
      },
    ],
    data: data,

  })



}

function get_hso($idhso) {
  //limpio select
  $('#hso_select')
    .find('option')
    .remove()
    .end()
    .append('<option value="">Seleccione</option>')
    .val('');
  //cargo select
  $.ajax({
    url: base_url+ '/api/hso/alldata',
    method: 'GET',
    beforeSend: function () {
    },
    success: function (data) {

      if (data.status == '200') {

        $.each(data.data, function (k, v) {
          //console.log(k);

          //console.info($("#hso_select"));

          $("#hso_select").append('<option value=' + v.id_tbl_uni_serv_hospital + '>' + v.nombre + '</option>');
          //console.log($("#hso_selectd").length);
          if ($("#hso_selectd").length) {
            //alert('qui'+k);
            $("#hso_selectd").append('<option value=' + v.id_tbl_uni_serv_hospital + '>' + v.nombre + '</option>');
            $("#hso_selectd").val($idhso);
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

function insertuss() {

  $.ajax({
    url: base_url+ '/api/uss/crear',
    method: 'POST',
    data: $("#forminsertuss").serialize(),
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

async function updateuss($id) {

  $.ajax({
    url: base_url+ '/api/uss/buscar',
    method: 'POST',
    data: { pkuss: $id },
    beforeSend: function () {
    },
    success: function (data) {
      
      if (data.status == '200') {
        
        //console.log(data.data.fk_tbl_serv_hospital);
        Swal.fire({
          title: 'Actualizar',
          html: '<form id="formupdateuss" method="post">' +
            '<label for="hso" class="col-form-label">HSO</label>'+
            '<select class="form-control form-control" id="hso_selectd" name="idhso" required>' +
            '</select>' +
            '<label for="hso" class="col-form-label">Nombre</label>'+
            '<input type="text" id="nombre" name="nombre" class="swal2-input" value="' + data.data.nombre + '">' +
            '<label for="hso" class="col-form-label">Direccion</label>'+
            '<input type="text" id="direccion" name="direccion" class="swal2-input" value="' + data.data.direccion.toString() + '">' +
            '<label for="hso" class="col-form-label">Teléfono</label>'+
            '<input type="text" id="telefono" name="telefono" class="swal2-input" value="' + data.data.telefono + '">' +
            '<input type="hidden" id="iduss" name="iduss" class="swal2-input"  value="' + data.data.id_tbl_uni_serv_salud + '">' +
            '</form>',
          confirmButtonText: 'actualizar',
          focusConfirm: false,
          didOpen() {
            get_hso(data.data.fk_tbl_serv_hospital)
          },         
          preConfirm: () => {
            
            const nombre = Swal.getPopup().querySelector('#nombre').value
            //const form = Swal.getPopup().querySelector('#formupdatehso')
            //const password = Swal.getPopup().querySelector('#password').value
            if (!nombre) {
              Swal.showValidationMessage('Diligencie el campo de nombre')
            } else
              return { nombre: nombre }
          },
          //$("#hso_selectd").val(data.data.fk_tbl_serv_hospital).change();
        }).then((result) => {

          if (result.isConfirmed) {
            //ajax update
            $.ajax({
              url: 'api/uss/editar',
              method: 'POST',
              data: $("#formupdateuss").serialize(),
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

function deleteuss($id) {

  $.ajax({
    url: base_url+ '/api/uss/eliminar',
    method: 'POST',
    data: { iduss: $id },
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

