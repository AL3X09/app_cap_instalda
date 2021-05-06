$(document).ready(function () {
  $('#formRegistro').bootstrapValidator({
    message: 'Este valor no es valido',
    feedbackIcons: {
      valid: 'glyphicon',
      invalid: 'glyphicon',
      validating: 'glyphicon glyphicon-refresh'
    },    
    fields: {
      nombres: {
        validators: {
          notEmpty: {
            message: 'El campo Nombre no puede estar vacío.'
          }
        }
      },
      apellidos: {
        validators: {
          notEmpty: {
            message: 'El campo Tipo de Documento no puede estar vacío'
          }
        }
      },
      telefono: {
        validators: {
          notEmpty: {
            message: 'El campo teléfono no puede estar vacío'
          },
          numeric: {
            message: 'El teléfono debe ser un número.'
          },
          stringLength: {
            min: 7,
            max: 10,
            message: 'El numero de debe tener maximo 10 digitos.'
          }
        }
      },
      correo: {
        validators: {
          notEmpty: {
            message: 'El campo Correo Electrónico no puede estar vacío'
          },
          emailAddress: {
            message: 'El correo electrónico introducido no es correcto.'
          },
          callback: {
            message: 'El correo electronico ya se encuentra registrado.',
            callback: function (value, validator) {
                //console.log(value);
                var flag = true;
                $.ajax({
                    url:base_url+'/api/existe_correo',
                    type:'POST',
                    async:false,
                    data: {
                        correo: $('#correo').val(),
                    },
                    success:function(res){
                      
                      if(res.status=400){
                        flag = false;
                      }
                        
                    }
                });
                //console.log(flag);
                return flag
            }
          },
          /*remote: { no se puede usar xq el framework ya no se ajusta
            url: 'api/existe_correo',
            type: 'GET',
            delay: 350,
            data: {
              type: 'correo'
            },
            message: 'El correo electronico ya se encuentra registrado.'
          }*/
        }
      },
      correo_confir: {
        validators: {
          notEmpty: {
            message: 'El campo Confirmar Correo Electrónico no puede estar vacío'
          },
          emailAddress: {
            message: 'El correo electrónico introducido no es correcto.'
          },
          identical: {
            field: 'correo',
            message: 'El correo electrónico y su confirmación deben ser iguales.'
          }
        }
      },
      contrasenia: {
        validators: {
          regexp:{
            regexp: "^((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]))(?=.*[@#$%^&+=*_-]).*$",
            message: 'La contraseña debe tener 1 letra Mayuscula, 1 letra minuscula, 1 Numero 1 caracter especial y sin espacios, '
           },
          notEmpty: {
            message: 'El campo contraeña no puede estar vacío'
          },
          stringLength: {
            min: 8,
            message: 'La contraseña debe tener minimo 8 caractres.'
          }
        }
      },
      conf_contrasenia: {
        validators: {
          notEmpty: {
            message: 'El campo Confirmar Contraseña no puede estar vacío'
          },
          identical: {
            field: 'contrasenia',
            message: 'La contraseña y su confirmación deben ser iguales.'
          }
        }
      },
      
    }
  }).on('success.form.bv', function (e,data) {
    //console.log(e);
    e.preventDefault();
    //console.log($('#formRegistro').data('bootstrapValidator'));
    if ($("#formRegistro").data('bootstrapValidator').isValid()) {//Get the verification result, if successful, execute the following code
      
      guardar();
    }else{
      //console.info($('#btnregistro'));
      $('#btnregistro').removeAttr("disabled");
    }
    
  });
});

