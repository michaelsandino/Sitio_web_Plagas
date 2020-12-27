url = window.location.pathname;

/* Consultar */
if(url.split('/').reverse()[0] == ""){   

  /* Consultar tratamientos */
  function tratamientos() {

/* obtener los valores enviamos por GET */
  var loc = window.location.search;
    
    if(loc)
    {
        /* Buscar en los valores el nombre del campo y obtener su valor*/
        const urlParams  = new URLSearchParams(loc);
        var plaga = urlParams .get('plaga');
        var cultivo = urlParams .get('cultivo');
    
    
      firebase.auth().onAuthStateChanged(function(user) {
        
        if (user) {
          message(user)
          var email = user.email;
    
          /* Ubicar nombre plaga */
          var plaga_name = 
          {
            "id_plagas":plaga,
            "id_cultivo":cultivo,
            "idUsuCultivo":email
          };

          $.ajax({
            data: plaga_name,
            url: 'plaga.php',
            type: 'POST',
            
            success: function(data)
            {      
            var objeto = JSON.parse(data);
            nombreT_plagas = objeto.nombreT_plagas;
            
            var plaga_name = document.getElementById('plaga_name')
            plaga_name.innerHTML = nombreT_plagas 
            
            },
            error: function (err) {
              alert("Disculpe, ocurrio un error");           
            }
          });

           /* Mostrar tratamientos del cultivo */

          var parametro = 
          {
            "idUsuCultivo":email,
            "id_plaga":plaga,
            "id_cultivo":cultivo
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

              if (response=='invalid_user') {
                window.location.replace('../cultivos');
              }else{
                $('#result').html(response);  
              }
  
            },
            error: function (err) {
              alert("Disculpe, ocurrio un error");           
            }
          });
      

        }
      });
    }else{
        window.location.replace("../");
    }
  }
    tratamientos();



  /* Eliminar cultivos */
  function eliminar(idTratamiento){

    if (confirm("Esta seguro que desea eliminar este tratamiento?"))
    {
      var parametro = 
      {
        "idTratamiento":idTratamiento,            
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
          $('#eliminado').html(response).fadeIn("slow");
          setTimeout(function(){window.location.reload();}, 3000);
        },
        error: function (err) {
          alert("Disculpe, ocurrio un error");           
        }
        
      });     
    }   
  }

}


/* Registrar de tratamientos*/
$("#t_register").submit(function(e){
  e.preventDefault();

  var TpTratamiento = document.getElementById('TpTratamiento').value;
  var NaTratamiento = document.getElementById('NaTratamiento').value;
  var DesTratamiento = document.getElementById('DesTratamiento').value;

  /* Mensaje de error */
  var TpTratamiento_error = document.getElementById('TpTratamiento_error')
  var NaTratamiento_error = document.getElementById('NaTratamiento_error')
  var DesTratamiento_error = document.getElementById('DesTratamiento_error')

  /* Color de alerta */
  var TpTratamiento_color = document.getElementsByClassName("TpTratamiento_color");
  var NaTratamiento_color = document.getElementsByClassName("NaTratamiento_color");
  var DesTratamiento_color = document.getElementsByClassName("DesTratamiento_color");

  if (!TpTratamiento) {
    TpTratamiento_error.innerHTML = 'Campo obligatorio.'
    $('.TpTratamiento_color').addClass('border-danger')
  }else{
    TpTratamiento_error.innerHTML = ''
    $('.TpTratamiento_color').removeClass('border-danger')
  }

  if (!NaTratamiento) {
    NaTratamiento_error.innerHTML = 'Campo obligatorio.'
    $('.NaTratamiento_color').addClass('border-danger')
  }else{
    NaTratamiento_error.innerHTML = ''
    $('.NaTratamiento_color').removeClass('border-danger')
  }

  if (!DesTratamiento) {
    DesTratamiento_error.innerHTML = 'Campo obligatorio.'
    $('.DesTratamiento_color').addClass('border-danger')
  }else{
    DesTratamiento_error.innerHTML = ''
    $('.DesTratamiento_color').removeClass('border-danger')
  }

  if (TpTratamiento != "" & NaTratamiento != ""  & DesTratamiento != "") {

    var loc = window.location.search;
    const urlParams  = new URLSearchParams(loc);
    var plaga = urlParams .get('plaga');

    var parametro = 
    {
      "IdPlagas":plaga,
      "TpTratamiento":TpTratamiento,
      "NaTratamiento":NaTratamiento,
      "DesTratamiento":DesTratamiento,
    };

    $.ajax({
        url:'register.php',
        type:'POST',
        data:parametro,

        beforeSend:function (objeto) {
          $("#message").html('<div class="progress mt-3"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeOut("slow");
      },
        success: function(response)
        {    
           $("#message").html(response).fadeIn("slow");
          document.getElementById("t_register").reset();   
              
          setTimeout(function(){window.location.reload();}, 3000);
        },
        error: function (err) {
          alert("Disculpe, ocurrio un error");           
      }
    });
  }
});   


/* Consulta para actualizar tratamientos */
if(url.split('/').reverse()[0] == "actualizar.php"){ 

  /* obtener los valores enviamos por GET */
  var loc = window.location.search;
    
    if(loc)
    {
        /* Buscar en los valores el nombre del campo y obtener su valor*/
        const urlParams  = new URLSearchParams(loc);
        var tratamiento = urlParams .get('tratamiento');
        var plaga = urlParams .get('plaga');
        var cultivo = urlParams .get('cultivo');

        firebase.auth().onAuthStateChanged(function(user) {
        
          if (user) {
          message(user)
          var email = user.email;
          
            var parametro = 
            {
              "idTratamiento":tratamiento,
              "id_plagas":plaga,
              "id_cultivo":cultivo,
              "idUsuCultivo":email
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
                if (data=='invalid_user') {

                  window.location.replace('../cultivos');

                }else{
                  
                  var objeto = JSON.parse(data);
      
                  id_plaga = objeto.id_plaga; 
                  tipoTratamiento = objeto.tipoTratamiento; 
                  nameTrata = objeto.nameTrata; 
                  pasosTratamiento = objeto.pasosTratamiento;  
  
                  document.update.TpTratamiento.value = tipoTratamiento;
                  document.update.NaTratamiento.value = nameTrata;
                  document.update.DesTratamiento.value = pasosTratamiento;

                  var btn_back = document.getElementById('btn-back')
                  btn_back.innerHTML = '<a href="../tratamientos/?plaga='+plaga+'&cultivo='+cultivo+'" class="btn btn-secondary mt-2" style="width: 49%;">cancelar</a>'
  
                  var btn_update = document.getElementById('btn-update')
                  btn_update.innerHTML = '<button type="submit" class="btn btn-success mt-2 float-right" style="width: 49%;">Actualizar</button>'

                }

              },
              error: function (err) {
                alert("Disculpe, ocurrio un error");           
              }
        
            });
          }

        });

    }else{
      window.location.replace("../cultivos");
    }
}

/* Actualizar plagas */
$("#t_update").submit(function(e){
  e.preventDefault();
  
      const urlParams  = new URLSearchParams(loc);
      var tratamiento = urlParams .get('tratamiento');
      var plaga = urlParams .get('plaga');
      var cultivo = urlParams .get('cultivo');

      var TpTratamiento = document.getElementById('TpTratamiento').value;
      var NaTratamiento = document.getElementById('NaTratamiento').value;
      var DesTratamiento = document.getElementById('DesTratamiento').value;

      /* Mensaje de error */
      var TpTratamiento_error = document.getElementById('TpTratamiento_error')
      var NaTratamiento_error = document.getElementById('NaTratamiento_error')
      var DesTratamiento_error = document.getElementById('DesTratamiento_error')

      /* Color de alerta */
      var TpTratamiento_color = document.getElementsByClassName("TpTratamiento_color");
      var NaTratamiento_color = document.getElementsByClassName("NaTratamiento_color");
      var DesTratamiento_color = document.getElementsByClassName("DesTratamiento_color");

      if (!TpTratamiento) {
        TpTratamiento_error.innerHTML = 'Campo obligatorio.'
        $('.TpTratamiento_color').addClass('border-danger')
      }else{
        TpTratamiento_error.innerHTML = ''
        $('.TpTratamiento_color').removeClass('border-danger')
      }

      if (!NaTratamiento) {
        NaTratamiento_error.innerHTML = 'Campo obligatorio.'
        $('.NaTratamiento_color').addClass('border-danger')
      }else{
        NaTratamiento_error.innerHTML = ''
        $('.NaTratamiento_color').removeClass('border-danger')
      }

      if (!DesTratamiento) {
        DesTratamiento_error.innerHTML = 'Campo obligatorio.'
        $('.DesTratamiento_color').addClass('border-danger')
      }else{
        DesTratamiento_error.innerHTML = ''
        $('.DesTratamiento_color').removeClass('border-danger')
      }

      if (TpTratamiento != ""  & NaTratamiento != "" & DesTratamiento != ""){
      
              var parametro = 
              {
                "idTratamiento":tratamiento,
                "TpTratamiento":TpTratamiento,
                "NaTratamiento":NaTratamiento,
                "DesTratamiento":DesTratamiento
              };

              $.ajax({
                url: 'update_action.php',
                type:'POST',
                data:parametro,
            
                beforeSend:function (objeto) {
                  $("#message").html('<div class="progress"><div class="progress-bar mt-2 progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeOut("slow");
                },
                success: function(response)
                {
                    $('#message').html(response).fadeIn("slow");
                    setTimeout(function(){window.location.replace('../tratamientos/?plaga='+plaga+'&cultivo='+cultivo);}, 5000);
                },
                error: function (err) {
                  alert("Disculpe, ocurrio un error");           
                }  
              });
    
      }

});

