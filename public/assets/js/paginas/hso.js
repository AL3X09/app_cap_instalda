//creado por Alex Cs 18/04/2021

$(document).ready(function () {
  cargardata();
});

function cargardata() {

  $.ajax({
    url: base_url+ '/api/hso/alldata',
    method: 'get',
    contentType: 'application/json',
  }).done(function (res) {
    //data=msg.data;
    cargar_table(res.data);
  });

}

function cargar_table(data) {
  $('#table_hso').bootstrapTable({
    search: true,
    showRefresh: false,
    buttonsAlign: 'left',
    columns: [
      {
        field: 'nombre',
        title: 'Nombre'
      }, {
        field: 'sigla',
        title: 'Sigle'
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
          //console.log(row);
          //return '<input name="elementname"  value="'+value+'"/>';
          return '<button type="button" class="btn btn-icon btn-round btn-success" onclick="updatehso(' + row.id_tbl_uni_serv_hospital + ')"><i class="fa icon-refresh"></i></button>' +
            '<button type="button" class="btn btn-icon btn-round btn-danger" onclick="deletehso(' + row.id_tbl_uni_serv_hospital + ')"><i class="fa icon-trash"></i></button>';
          //'<button class=\'btn btn-primary \' pageName="'+row.id+'" pageDetails="'+row.price+'"  >Edit</button>'+
          //'<button class=\'btn btn-primary \' pageName="'+row.id+'" pageDetails="'+row.price+'"  >Edit</button>';
        }
      },
    ],
    data: data
    /*{
      nombre: data.nombre,
      sigla: data.sigla,
    },/* {
    id: 2,
    name: 'Item 2',
    price: '$2'
  }*/
    ,

  })

}

function inserthso() {

  $.ajax({
    url: base_url+ '/api/hso/crear',
    method: 'POST',
    data: $("#forminsert").serialize(),
    beforeSend: function () {
    },
    success: function (data) {

      if (data.status == '201') {

        //window.location.href = "/Home";
        swal.fire({
          title: "",
          text: data.messages,
          type: "success",
          timer: 3000,
          showConfirmButton: false
        });
        window.setTimeout(function () { }, 3000);
        location.reload();
        
      } else {
        //alert(data.messages);
        Swal.fire(data.messages);
      }

    }
  });

}

function updatehso($id) {

  $.ajax({
    //async: false,//no se debe usar afecta los procesos
    url: base_url+ '/api/hso/buscar',
    method: 'POST',
    data: { pkhso: $id },
    beforeSend: function () {

    },
    success: function (data) {

      if (data.status == '200') {

        Swal.fire({
          title: 'Actualizar',
          html: '<form id="formupdatehso" method="post">' +
            '<input type="text" id="nombre" name="nombre" class="swal2-input" value="' + data.data.nombre + '">' +
            '<input type="text" id="sigla" class="swal2-input" name="sigla" value="' + data.data.sigla + '">' +
            '<input type="hidden" id="idhdo" class="swal2-input" name="idhso" value="' + data.data.id_tbl_uni_serv_hospital + '">' +
            '</form>',
          confirmButtonText: 'actualizar',
          focusConfirm: false,
          preConfirm: () => {
            const nombre = Swal.getPopup().querySelector('#nombre').value
            //const form = Swal.getPopup().querySelector('#formupdatehso')
            //const password = Swal.getPopup().querySelector('#password').value
            if (!nombre) {
              Swal.showValidationMessage('Diligencie el campo de nombre')
            } else
              return { nombre: nombre }
          }
        }).then((result) => {

          if (result.isConfirmed) {
            //ajax update
            $.ajax({
              url: 'api/hso/editar',
              method: 'POST',
              data: $("#formupdatehso").serialize(),
              beforeSend: function () {
              },
              success: function (data) {
                
                if (data.status == '201') {
      
                  swal.fire({
                    title: "",
                    text: data.messages,
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

      } else {
        Swal.fire(data.messages);
      }

    }
  });

}

function deletehso($id) {

  $.ajax({
    url: base_url+ '/api/hso/eliminar',
    method: 'POST',
    data: { pkhso: $id },
    beforeSend: function () {
    },
    success: function (data) {

      if (data.status == '201') {

        swal.fire({
          title: data.messages,
          text: '',
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

