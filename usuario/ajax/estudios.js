url = window.location.pathname;

if(url.split('/').reverse()[0] == ""){   
  /* Consultar estudios */
  function estudios() {
    firebase.auth().onAuthStateChanged(function(user) {
      if (user) {
        message(user)
        var email = user.email;

        var parametro = 
        {
          "id_usu":email
        };
    
        $.ajax({
          data: parametro,
          url: 'consult.php',
          type: 'POST',
          
          beforeSend:function (objeto) {
            $("#progress").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeOut("slow");
          },
          success: function(response)
          {
            $('#result').html(response);
          },
          error: function (err) {
            alert("Disculpe, ocurrio un error");           
          }

        });
      }
    });
  }
    estudios();
    setInterval(estudios, 3000);

  /* Eliminar estudios */
  function eliminar(idFormacion){

    if (confirm("Esta seguro que desea eliminar este estudio?"))
    {
      firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
          message(user)
          var email = user.email;

          var parametro = 
          {
            "idFormacion":idFormacion,
            "id_usu":email,
          };
        
          $.ajax({
            data: parametro,
            url: 'delete.php',
            type:'POST',

            beforeSend:function (objeto) {
              $("#eliminado").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeOut("slow");
            },
            success: function(response)
            {
              console.log(response)
              $('#eliminado').html(response).fadeIn("slow");
            },
            error: function (err) {
              alert("Disculpe, ocurrio un error");           
            }
        
          });
        }
      });
    }
    
  }
    
  /* Registrar de estudios*/
  $("#e_register").submit(function(e){
    e.preventDefault();

    var nvformativo = document.getElementById('nvformativo').value;
    var titulo = document.getElementById('titulo').value;
    var entidadEdu = document.getElementById('entidadEdu').value;
    var fechGrado = document.getElementById('fechGrado').value;
    var pdf = document.getElementById('pdf').value;

    /* Mensaje de error */
    var nvformativo_error = document.getElementById('nvformativo_error')
    var titulo_error = document.getElementById('titulo_error')
    var entidadEdu_error = document.getElementById('entidadEdu_error')
    var fechGrado_error = document.getElementById('fechGrado_error')
    var pdf_error = document.getElementById('pdf_error')

    /* Color de alerta */
    var nvformativo_color = document.getElementsByClassName("nvformativo_color");
    var titulo_color = document.getElementsByClassName("titulo_color");
    var entidadEdu_color = document.getElementsByClassName("entidadEdu_color");
    var fechGrado_color = document.getElementsByClassName("fechGrado_color");
    var pdf_color = document.getElementsByClassName("pdf_color");

    if (!nvformativo) {
      nvformativo_error.innerHTML = 'Campo obligatorio.'
      $('.nvformativo_color').addClass('border-danger')
    }else{
      nvformativo_error.innerHTML = ''
      $('.nvformativo_color').removeClass('border-danger')
    }

    if (!titulo) {
      titulo_error.innerHTML = 'Campo obligatorio.'
      $('.titulo_color').addClass('border-danger')
    }else{
      titulo_error.innerHTML = ''
      $('.titulo_color').removeClass('border-danger')
    }

    if (!entidadEdu) {
      entidadEdu_error.innerHTML = 'Campo obligatorio.'
      $('.entidadEdu_color').addClass('border-danger')
    }else{
      entidadEdu_error.innerHTML = ''
      $('.entidadEdu_color').removeClass('border-danger')
    }

    if (!fechGrado) {
      fechGrado_error.innerHTML = 'Campo obligatorio.'
      $('.fechGrado_color').addClass('border-danger')
    }else{
      fechGrado_error.innerHTML = ''
      $('.fechGrado_color').removeClass('border-danger')
    }

    if (!pdf) {
      pdf_error.innerHTML = 'Campo obligatorio.'
      $('.pdf_color').addClass('text-danger')
    }else{
      pdf_error.innerHTML = ''
      $('.pdf_color').removeClass('text-danger')
    }

    if (nvformativo != "" & titulo != ""  & entidadEdu != "" & fechGrado != "" & pdf != "") {
      firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
          message(user)
          var email = user.email;

          var parametros = new FormData($("#e_register")[0]);
          parametros.append("id_user", email);

          $.ajax({
              data:parametros,
              url:'register.php',
              type:'POST',
              contentType: false,
              processData: false,

              beforeSend:function (objeto) {
                $("#message").html('<div class="progress mt-3"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeOut("slow");
            },
              success: function(response)
              {    
                $("#message").html(response).fadeIn("slow");
                document.getElementById("e_register").reset();     
              },
              error: function (err) {
                alert("Disculpe, ocurrio un error");           
            }
          });
        }
      });
    }
  });   
}

/* Consulta para actualizar estudios */
if(url.split('/').reverse()[0] == "actualizar.html"){  
  var loc = document.location.href;
    // si existe el interrogante
    if(loc.indexOf('?')>0)
    {
        // cogemos la parte de la url que hay despues del interrogante
        var id = loc.split('=')[1];

        firebase.auth().onAuthStateChanged(function(user) {
          if (user) {
            message(user)
          var email = user.email;
      
            var parametro = 
            {
              "ideUsu":email,
              "id":id
            };
          
            $.ajax({
              data: parametro,
              url: 'update.php',
              type:'POST',
          
              beforeSend:function (objeto) {
                $("#progress").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeOut("slow");
              },
              success: function(data)
              {
                var objeto = JSON.parse(data);
      
                nivelFormativo = objeto.nivelFormativo; 
                tituloFormacion = objeto.tituloFormacion; 
                entidadEducativa = objeto.entidadEducativa; 
                fechaGrado = objeto.fechaGrado; 
                soporte = objeto.soporte; 
  
                document.update.nvformativo.value = nivelFormativo;
                document.update.titulo.value = tituloFormacion;
                document.update.entidadEdu.value = entidadEducativa;
                document.update.fechGrado.value = fechaGrado;

                var file_pdf = document.getElementById('file_pdf')
                file_pdf.innerHTML = '<a href="http://localhost/PROYECTOS/SENA/Sitio_Web_Plagas/usuario/estudios/estudios_pdf/'+soporte+'">'+soporte+'</a>'
          
              },
              error: function (err) {
                alert("Disculpe, ocurrio un error");           
              }
        
            });
          }
        });

    }else{
      window.location.replace("../estudios");
    }
}

/* Actualizar estudios */
$("#e_update").submit(function(e){
  e.preventDefault();
  var loc = document.location.href;
// si existe el interrogante
if(loc.indexOf('?')>0)
{
    // cogemos la parte de la url que hay despues del interrogante
    var id = loc.split('=')[1];

        var nvformativo = document.getElementById('nvformativo').value;
        var titulo = document.getElementById('titulo').value;
        var entidadEdu = document.getElementById('entidadEdu').value;
        var fechGrado = document.getElementById('fechGrado').value;
        
        /* Mensaje de error */
        var nvformativo_error = document.getElementById('nvformativo_error')
        var titulo_error = document.getElementById('titulo_error')
        var entidadEdu_error = document.getElementById('entidadEdu_error')
        var fechGrado_error = document.getElementById('fechGrado_error')

        /* Color de alerta */
        var nvformativo_color = document.getElementsByClassName("nvformativo_color");
        var titulo_color = document.getElementsByClassName("titulo_color");
        var entidadEdu_color = document.getElementsByClassName("entidadEdu_color");
        var fechGrado_color = document.getElementsByClassName("fechGrado_color");
        
        if (!nvformativo) {
          nvformativo_error.innerHTML = 'Campo obligatorio.'
          $('.nvformativo_color').addClass('border-danger')
        }else{
          nvformativo_error.innerHTML = ''
          $('.nvformativo_color').removeClass('border-danger')
        }

        if (!titulo) {
          titulo_error.innerHTML = 'Campo obligatorio.'
          $('.titulo_color').addClass('border-danger')
        }else{
          titulo_error.innerHTML = ''
          $('.titulo_color').removeClass('border-danger')
        }

        if (!entidadEdu) {
          entidadEdu_error.innerHTML = 'Campo obligatorio.'
          $('.entidadEdu_color').addClass('border-danger')
        }else{
          entidadEdu_error.innerHTML = ''
          $('.entidadEdu_color').removeClass('border-danger')
        }

        if (!fechGrado) {
          fechGrado_error.innerHTML = 'Campo obligatorio.'
          $('.fechGrado_color').addClass('border-danger')
        }else{
          fechGrado_error.innerHTML = ''
          $('.fechGrado_color').removeClass('border-danger')
        }

        if (nvformativo != "" & titulo != ""  & entidadEdu != "" & fechGrado != "") {

          firebase.auth().onAuthStateChanged(function(user) {
            if (user) {
              message(user)
              var email = user.email;
              
              var parametros = new FormData($("#e_update")[0]);
              parametros.append("id_usu", email);
              parametros.append("idFormacion", id);

              $.ajax({
                data: parametros,
                url: 'update_action.php',
                type:'POST',
                contentType: false,
                processData: false,
            
                beforeSend:function (objeto) {
                  $("#message").html('<div class="progress"><div class="progress-bar mt-2 progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeOut("slow");
                },
                success: function(response)
                {
                    $('#message').html(response).fadeIn("slow");
                    setTimeout(function(){window.location.replace("../estudios");}, 5000);
                },
                error: function (err) {
                  alert("Disculpe, ocurrio un error");           
                }
          
              });
            }
          });
        }
      

}else{
  window.location.replace("../estudios");
}

});  