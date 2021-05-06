//creado por Alex Cs 18/04/2021

$(document).ready(function () {
  cargardataperf();
});

function cargardataperf() {

  $.ajax({
    url: base_url+ '/api/perfilest/alldata',
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
  $('#table_perf').bootstrapTable({
    search: true,
    showRefresh: false,
    buttonsAlign: 'left',
    columns: [
      {
        field: 'nombre',
        title: 'Nombre'
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
          return '<button type="button" class="btn btn-icon btn-round btn-success" onclick="updateperf(' + row.id_tbl_perfil_est + ')"><i class="fa icon-refresh"></i></button>' +
            '<button type="button" class="btn btn-icon btn-round btn-danger" onclick="deleteperf(' + row.id_tbl_perfil_est + ')"><i class="fa icon-trash"></i></button>';
        }
      },
    ],
    data: data,

  })

}

function insertperfil() {

  $.ajax({
    url: base_url+ '/api/perfilest/crear',
    method: 'POST',
    data: $("#forminsertperf").serialize(),
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

async function updateperf($id) {

  $.ajax({
    url: base_url+ '/api/perfilest/buscar',
    method: 'POST',
    data: { idprog: $id },
    beforeSend: function () {
    },
    success: function (data) {
      
      if (data.status == '200') {
        
        //console.log(data.data.fk_tbl_serv_hospital);
        Swal.fire({
          title: 'Actualizar',
          html: '<form id="formupdateperf" method="post">' +
            '<label for="perfil" class="col-form-label">Perfil</label>'+
            '<input type="text" id="perfil" name="perfil" class="swal2-input" value="' + data.data.nombre + '">' +
            '<input type="hidden" id="idperf" name="idperf" class="swal2-input"  value="' + data.data.id_tbl_perfil_est + '">' +
            '</form>',
          confirmButtonText: 'actualizar',
          focusConfirm: false,
          didOpen() {
            //console.log(data.data.fk_tbl_grupo_serv);
          },         
          preConfirm: () => {
            
            const perfil = Swal.getPopup().querySelector('#perfil').value
            //const form = Swal.getPopup().querySelector('#formupdatehso')
            //const password = Swal.getPopup().querySelector('#password').value
            if (!perfil) {
              Swal.showValidationMessage('Diligencie el perfil')
            } else
              return { perfil: perfil }
          },
          //$("#hso_selectd").val(data.data.fk_tbl_serv_hospital).change();
        }).then((result) => {

          if (result.isConfirmed) {
            //ajax update
            $.ajax({
              url: base_url+ '/api/perfilest/editar',
              method: 'POST',
              data: $("#formupdateperf").serialize(),
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

function deleteperf($id) {

  $.ajax({
    url: base_url+ '/api/perfilest/eliminar',
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

