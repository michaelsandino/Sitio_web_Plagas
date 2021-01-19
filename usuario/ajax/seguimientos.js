url = window.location.pathname;

if(url.split('/').reverse()[0] == ""){  
  
  /* SOLICITUD */  
  $.ajax({
    url: 'consult_seguimientos.php',
    type: 'POST',
    
    beforeSend:function (objeto) {
      $("#progress").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeOut("slow");
    },
    success: function(response)
    {
      if (response=='            ') {
        $('#result_solicitudes').html('<p class="subtitle text-center my-4">Actualmente no se encuentra solicitudes en espera.</p>'); 
      }else if (response.indexOf("invalid_user")=='0') {
        window.location.replace('../inicio');
      }else{
        $('#result_solicitudes').html(response); 
      }
            
    },
    error: function (err) {
      alert("Disculpe, ocurrio un error");           
    }

  });

  /* MIS SEGUIMIENTOS */
  $.ajax({
    url: 'consult_misseguimientos.php',
    type: 'POST',
    
    beforeSend:function (objeto) {
      $("#progress").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeOut("slow");
    },
    success: function(response)
    {
      if (response=='            ') {
        $('#result_misseguimientos').html('<p class="subtitle text-center my-4">Actualmente no cuenta con seguimientos.</p>');    
      }else if (response.indexOf("invalid_user")=='0'){
        window.location.replace('../inicio');
      }else{
        $('#result_misseguimientos').html(response);     
      }
    },
    error: function (err) {
      alert("Disculpe, ocurrio un error");           
    }

  });

}

  /* añadir solicitud de cultivo a lista */
  function añadir_c(solicitud){
    if (confirm("¿Seguro que desea añadir esta solicitud a su lista de seguimientos? holaaa"))
    {     

      var parametro = 
        {
          "solicitud":solicitud,
        };

      $.ajax({
        data: parametro,
        url: 'añadir_c.php',
        type:'POST',

         beforeSend:function (objeto) {
           $("#progress-jurado").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeOut("slow");
        },
        success: function(response)
        {
          if (response.indexOf("La solicitud no ha sido añadida debido a que cuenta con un proceso de verificación pendiente.")=='-1'){
            /* window.location.reload(); */
            console.log(response)
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

  /* añadir solicitud de plaga a lista */
  function añadir_p(solicitud){
    if (confirm("¿Seguro que desea añadir esta solicitud a su lista de seguimientos?"))
    {     

      var parametro = 
        {
          "solicitud":solicitud,
        };

      $.ajax({
        data: parametro,
        url: 'añadir_p.php',
        type:'POST',

         beforeSend:function (objeto) {
           $("#progress-jurado").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeOut("slow");
        },
        success: function(response)
        {
          if (response.indexOf("La solicitud no ha sido añadida debido a que cuenta con un proceso de verificación pendiente.")=='-1'){
            /* window.location.reload(); */
            console.log(response)
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

  /* añadir solicitud de tratamineto a lista */
  function añadir_t(solicitud){
    if (confirm("¿Seguro que desea añadir esta solicitud a su lista de seguimientos?"))
    {     

      var parametro = 
        {
          "solicitud":solicitud,
        };

      $.ajax({
        data: parametro,
        url: 'añadir_t.php',
        type:'POST',

         beforeSend:function (objeto) {
           $("#progress-jurado").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeOut("slow");
        },
        success: function(response)
        {
          if (response.indexOf("La solicitud no ha sido añadida debido a que cuenta con un proceso de verificación pendiente.")=='-1'){
            /* window.location.reload(); */
            console.log(response)
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

if(url.split('/').reverse()[0] == "cultivos.php"){ 

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
            $("#progress").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeOut("slow");
          },
          success: function(response)
          {            
            
            if (response!='invalid_user'){

              $('#panel').html(response);

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
          $("#message").html('<div class="progress"><div class="progress-bar mt-2 progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeOut("slow");
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


/* ----------- Consultar información acerca de una plaga ------------- */

if(url.split('/').reverse()[0] == "plagas.php"){ 

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
            $("#progress").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeOut("slow");
          },
          success: function(response)
          {            
            
            if (response!='invalid_user'){

              $('#panel').html(response);

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
          $("#message").html('<div class="progress"><div class="progress-bar mt-2 progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeOut("slow");
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


/* ----------- Consultar información acerca de un tratamiento ------------- */

if(url.split('/').reverse()[0] == "tratamientos.php"){ 

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
            $("#progress").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeOut("slow");
          },
          success: function(response)
          {            
            
            if (response!='invalid_user'){

              $('#panel').html(response);

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
          $("#message").html('<div class="progress"><div class="progress-bar mt-2 progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeOut("slow");
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