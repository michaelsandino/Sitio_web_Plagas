url = window.location.pathname;

if(url.split('/').reverse()[0] == ""){  
  
  /* SOLICITUDES */  
  $.ajax({
    url: 'consult_seguimientos.php',
    type: 'POST',
    
    beforeSend:function (objeto) {
      $("#progress").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeIn("slow");
    },
    success: function(response)
    {
      $("#progress").html('')

      if (response=='            ') {
        $('#result_solicitudes').html('<p class="subtitle text-center my-4">Actualmente no se encuentra solicitudes en espera.</p>').fadeIn("slow"); 
      }else if (response.indexOf("invalid_user")=='0') {
        window.location.replace('../inicio');
      }else{
        $('#result_solicitudes').html(response).fadeIn("slow"); 
      }
            
    },
    error: function (err) {
      alert("Disculpe, ocurrio un error");           
    }

  });

  /* MIS SEGUIMIENTOS */
  $.ajax({
    url: 'consult_mi_lista.php',
    type: 'POST',
    
    beforeSend:function (objeto) {
      $("#progress").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeIn("slow");
    },
    success: function(response)
    {
      $("#progress").html('')

      if (response=='            ') {
        $('#result_misseguimientos').html('<p class="subtitle text-center my-4">Actualmente no cuenta con seguimientos.</p>').fadeIn("slow");    
      }else if (response.indexOf("invalid_user")=='0'){
        window.location.replace('../inicio');
      }else{
        $('#result_misseguimientos').html(response).fadeIn("slow");     
      }
    },
    error: function (err) {
      alert("Disculpe, ocurrio un error");           
    }

  });

}

  /* añadir solicitud a mi lista */
  function añadir(idCultivo){
    if (confirm("¿Seguro que desea añadir esta solicitud a su lista de seguimientos?"))
    {     

      var parametro = 
        {
          "idCultivo":idCultivo,
        };

      $.ajax({
        data: parametro,
        url: 'añadir.php',
        type:'POST',

         beforeSend:function (objeto) {
           $("#progress-jurado").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeIn("slow");
        },
        success: function(response)
        {
          $("#progress-jurado").html('')

          if (response.indexOf("La solicitud no ha sido añadida debido a que cuenta con procesos de verificación pendientes.")=='-1'){
            window.location.reload();
          }else{
            $("#message").html(response).fadeIn("slow");
          }
           
        },
        error: function (err) {
          alert("Disculpe, ocurrio un error");           
        }
      });
    }
  }


/* ----------- Consultar información acerca de un cultivo ------------- */

if(url.split('/').reverse()[0] == "cultivo.php"){ 

  /* obtener los valores enviamos por GET */
  var loc = window.location.search;
    
    if(loc)
    {
        /* Buscar en los valores el nombre del campo y obtener su valor*/
        const urlParams  = new URLSearchParams(loc);
        var id = urlParams .get('cultivo');
          
        var parametro = 
        {
          "id_cultivo":id
        };
          
        $.ajax({
          data: parametro,
          url: 'cultivo_consult.php',
          type:'POST',
          
          beforeSend:function (objeto) {
            $("#progress").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeIn("slow");
          },
          success: function(response)
          {
            $("#progress").html('')            
            
            if (response!='invalid_user'){

              $('#panel').html(response).fadeIn("slow");

            }else{
              window.location.replace('../inicio');
            }

          },
              error: function (err) {
            alert("Disculpe, ocurrio un error");           
          }
        
        });
    }else{
      window.location.replace('../inicio');
    } 

    /* Actualizar solicitud de cultivo */
  function seguimiento_cultivo(){
    
    const urlParams  = new URLSearchParams(loc);
    var id = urlParams .get('cultivo');

    var option1 = document.getElementById('option1').checked;
    var option2 = document.getElementById('option2').checked;
    var nota = document.getElementById('nota').value; 

    /* Mensaje de error */
    var cumplimiento_error = document.getElementById('cumplimiento_error')

    /* Color de alerta */
    var cumplimiento_color = document.getElementsByClassName("cumplimiento_color");

    if (!option1 & !option2) {
      cumplimiento_error.innerHTML = 'Elija alguna de las opciones.'
      $('.cumplimiento_color').addClass('text-danger')
    }else{
      cumplimiento_error.innerHTML = ''
      $('.cumplimiento_color').removeClass('text-danger')
    }

    if (option1 != "" | option2 != ""){


      if(option1) {
        cumplimiento = "Activo"
      }else if (option2) {
        cumplimiento = "Rechazado"
      }
    
      var parametro = 
      {
        "cumplimiento":cumplimiento,
        "nota":nota,
        "idCultivo":id,
      };

      $.ajax({
        url: 'cultivo_update.php',
        type:'POST',
        data:parametro,
    
        beforeSend:function (objeto) {
          $("#message").html('<div class="progress"><div class="progress-bar mt-2 progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeIn("slow");
        },
        success: function(response)
        {
          window.location.reload();
        },
        error: function (err) {
          alert("Disculpe, ocurrio un error");           
        }  
      });
    }
  }
  
}

/* ----------- Consultar información acerca de las plagas del cultivo ------------- */

if(url.split('/').reverse()[0] == "solicitudes_plagas.php"){ 

  /* obtener los valores enviamos por GET */
  var loc = window.location.search;
    
    if(loc)
    {
        /* Buscar en los valores el nombre del campo y obtener su valor*/
        const urlParams  = new URLSearchParams(loc);
        var id = urlParams .get('cultivo');
          
        var parametro = 
        {
          "id_cultivo":id
        };
          
        $.ajax({
          data: parametro,
          url: 'solicitudes_plagas_consult.php',
          type:'POST',
          
          beforeSend:function (objeto) {
            $("#progress").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeIn("slow");
          },
          success: function(response)
          {            
            $("#progress").html('')

            if (!response){
              $('#result').html('<p class="subtitle text-center my-4">Actualmente no existe seguimientos.</p>').fadeIn("slow"); 
            }else if (response!='invalid_user') {
              $('#result').html(response).fadeIn("slow");
            }else{
              window.location.replace('../inicio');
            }

          },
              error: function (err) {
            alert("Disculpe, ocurrio un error");           
          }
        
        });
    }else{
      window.location.replace('../inicio');
    } 
  
}

/* ----------- Consultar información acerca de una plaga ------------- */

if(url.split('/').reverse()[0] == "plaga.php"){ 

  /* obtener los valores enviamos por GET */
  var loc = window.location.search;
    
    if(loc)
    {
        /* Buscar en los valores el nombre del campo y obtener su valor*/
        const urlParams  = new URLSearchParams(loc);
        var id = urlParams .get('plaga');
          
        var parametro = 
        {
          "id_plagas":id
        };
          
        $.ajax({
          data: parametro,
          url: 'plaga_consult.php',
          type:'POST',
          
          beforeSend:function (objeto) {
            $("#progress").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeIn("slow");
          },
          success: function(response)
          { 
            $("#progress").html('')           
            
            if (response!='invalid_user'){

              $('#panel').html(response).fadeIn("slow");

            }else{
              window.location.replace('../inicio');
            }

          },
              error: function (err) {
            alert("Disculpe, ocurrio un error");           
          }
        
        });
    }else{
      window.location.replace('../inicio');
    } 

    /* Actualizar solicitud de plaga */
  function seguimiento_plaga(){
    
    const urlParams  = new URLSearchParams(loc);
    var id = urlParams .get('plaga');

    var option1 = document.getElementById('option1').checked;
    var option2 = document.getElementById('option2').checked;
    var nota = document.getElementById('nota').value; 

    /* Mensaje de error */
    var cumplimiento_error = document.getElementById('cumplimiento_error')

    /* Color de alerta */
    var cumplimiento_color = document.getElementsByClassName("cumplimiento_color");

    if (!option1 & !option2) {
      cumplimiento_error.innerHTML = 'Elija alguna de las opciones.'
      $('.cumplimiento_color').addClass('text-danger')
    }else{
      cumplimiento_error.innerHTML = ''
      $('.cumplimiento_color').removeClass('text-danger')
    }

    if (option1 != "" | option2 != ""){


      if(option1) {
        cumplimiento = "Activo"
      }else if (option2) {
        cumplimiento = "Rechazado"
      }
    
      var parametro = 
      {
        "cumplimiento":cumplimiento,
        "nota":nota,
        "id_plagas":id,
      };

      $.ajax({
        url: 'plaga_update.php',
        type:'POST',
        data:parametro,
    
        beforeSend:function (objeto) {
          $("#message").html('<div class="progress"><div class="progress-bar mt-2 progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeIn("slow");
        },
        success: function(response)
        {
          window.location.reload();
        },
        error: function (err) {
          alert("Disculpe, ocurrio un error");           
        }  
      });
    }
  }
  
}

/* ----------- Consultar información acerca de las plagas del cultivo ------------- */

if(url.split('/').reverse()[0] == "solicitudes_tratamientos.php"){ 

  /* obtener los valores enviamos por GET */
  var loc = window.location.search;
    
    if(loc)
    {
        /* Buscar en los valores el nombre del campo y obtener su valor*/
        const urlParams  = new URLSearchParams(loc);
        var id = urlParams .get('plaga');
          
        var parametro = 
        {
          "id_plaga":id
        };
          
        $.ajax({
          data: parametro,
          url: 'solicitudes_tratamientos_consult.php',
          type:'POST',
          
          beforeSend:function (objeto) {
            $("#progress").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeIn("slow");
          },
          success: function(response)
          {            
            $("#progress").html('')

            if (!response){
              $('#result').html('<p class="subtitle text-center my-4">Actualmente no existe seguimientos.</p>').fadeIn("slow");
            }else if (response!='invalid_user') {
              $('#result').html(response).fadeIn("slow");
            }else{
              window.location.replace('../inicio');
            }

          },
              error: function (err) {
            alert("Disculpe, ocurrio un error");           
          }
        
        });
    }else{
      window.location.replace('../inicio');
    } 
  
}


/* ----------- Consultar información acerca de un tratamiento ------------- */

if(url.split('/').reverse()[0] == "tratamiento.php"){ 

  /* obtener los valores enviamos por GET */
  var loc = window.location.search;
    
    if(loc)
    {
        /* Buscar en los valores el nombre del campo y obtener su valor*/
        const urlParams  = new URLSearchParams(loc);
        var id = urlParams .get('tratamiento');
          
        var parametro = 
        {
          "idTratamiento":id
        };
          
        $.ajax({
          data: parametro,
          url: 'tratamiento_consult.php',
          type:'POST',
          
          beforeSend:function (objeto) {
            $("#progress").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeIn("slow");
          },
          success: function(response)
          {     
            $("#progress").html('')
            
            if (response!='invalid_user'){

              $('#panel').html(response).fadeIn("slow");

            }else{
              window.location.replace('../inicio');
            }

          },
              error: function (err) {
            alert("Disculpe, ocurrio un error");           
          }
        
        });
    }else{
      window.location.replace('../inicio');
    } 

    /* Actualizar solicitud de cultivo */
  function seguimiento_tratamiento(){
    
    const urlParams  = new URLSearchParams(loc);
    var id = urlParams .get('tratamiento');

    var option1 = document.getElementById('option1').checked;
    var option2 = document.getElementById('option2').checked;
    var nota = document.getElementById('nota').value;

    /* Mensaje de error */
    var cumplimiento_error = document.getElementById('cumplimiento_error')

    /* Color de alerta */
    var cumplimiento_color = document.getElementsByClassName("cumplimiento_color");

    if (!option1 & !option2) {
      cumplimiento_error.innerHTML = 'Elija alguna de las opciones.'
      $('.cumplimiento_color').addClass('text-danger')
    }else{
      cumplimiento_error.innerHTML = ''
      $('.cumplimiento_color').removeClass('text-danger')
    }

    if (option1 != "" | option2 != ""){


      if(option1) {
        cumplimiento = "Activo"
      }else if (option2) {
        cumplimiento = "Rechazado"
      }
    
      var parametro = 
      {
        "cumplimiento":cumplimiento,
        "nota":nota,
        "idTratamiento":id,
      };

      $.ajax({
        url: 'tratamiento_update.php',
        type:'POST',
        data:parametro,
    
        beforeSend:function (objeto) {
          $("#message").html('<div class="progress"><div class="progress-bar mt-2 progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeIn("slow");
        },
        success: function(response)
        {
          window.location.reload();
        },
        error: function (err) {
          alert("Disculpe, ocurrio un error");           
        }  
      });
    }
  }
  
}