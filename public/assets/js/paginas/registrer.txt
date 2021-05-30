var getUrl = window.location;
var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1] + "/"; // lineas servidor local

var currentDate1 = new Date();
var currentDate2 = new Date();
var miniday = new Date();
var maxday = new Date();
var diasglobal = '0';
var mesesglobal = '0';
var anosglobal = '0';

maxday = new Date(currentDate1.getFullYear() - 16, currentDate1.getMonth(), currentDate1.getDate());
miniday = new Date(currentDate2.getFullYear() - 29, currentDate2.getMonth(), currentDate2.getDate());

$(document).ready(function () {
  var bootstrapValidator = $('#formRegistro').data('bootstrapValidator');
  
  $('#FechaNac_Aspirante').datetimepicker({
    format: 'YYYY/MM/DD',
    //showClose: true,
    //showClear: true,
    maxDate: maxday,
    //toolbarPlacement: 'bottom',
    // defaultDate: maxday,
    minDate: miniday
  }).on("dp.change", function (e) {
    var fecha = $(this).val();
    if (fecha == '' || fecha == undefined) {
      $('#EdadCalculada').val('');
      //alert("Fecha inválida, ingrese una fecha");
    } else {
      CalcularAjustarFechas();
    }
  }).on("dp.hide", function (e) {
    $('#formAspirante').bootstrapValidator('revalidateField', 'FechaNac_Aspirante');
    CargarProcesos();
  });
  

  $('#fkNacionalidad').change(function () {
    var valor = $(this).val();

    if (valor == "1") {
      $("#btnGuardar").prop("disabled", false);
      $("#Identificacion_Aspirante").prop("disabled", false);
      $("#Identificacion_Confirmar").prop("disabled", false);
    } else {
      $("#btnGuardar").prop("disabled", true);
      $("#Identificacion_Aspirante").prop("disabled", true);
      $("#Identificacion_Confirmar").prop("disabled", true);
    }
  });

  $('#FechaNac_Aspirante').val('').change();
  // cuando ESCUCHA el filtro estado sexo
  $('#pkSexo').on('change', listarEstadoCivil);
  // cuando ESCUCHA el filtro estado civili
  $('#pkEdoCivil').on('change', listarNivelAcademico);
  // cuando ESCUCHA el filtro de nivel academico
  $('#pkNivelAcademico').on('change', CargarProcesos);

  $('input[type=radio][name=tieneHijos]').change(function () {
    listarNivelAcademico();
  });
  /**
   * Agrega Alex
   * SELECT DINAMICOS
   */
  ///TRAIGO LAS ZONAS SEGUN DISTRITO
  $('#pkDistrito').change(function () {
    elegido = $(this).find(':selected').val();
    //invoco funcion trae zonas 
    tipoZona(elegido);
  });

});

  
function calcularEdadFechaIngresoEscuela() {
  $.ajax({
    url: baseUrl + 'ControladorTbaspirantes/calcularEdadFechaIngresoEscuela',
    method: 'POST',
    data: {pkProcesoIncorporacion: $("#pkProcesoIncorporacion").val(), FechaNac_Aspirante: $("#FechaNac_Aspirante").val()},
    success: function (data) {
      $("#EdadCalculadaIngresoEscuela").val(data + ' años');
    }
  });

  };
