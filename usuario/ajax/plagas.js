url = window.location.pathname;

/* Consultar */
if(url.split('/').reverse()[0] == ""){   

  /* Consultar plaga */
  function plagas() {

  /* obtener los valores enviamos por GET */
  var loc = window.location.search;
    
    if(loc)
    {
      /* Buscar en los valores el nombre del campo y obtener su valor*/
      const urlParams  = new URLSearchParams(loc);
      var cultivo = urlParams .get('cultivo');
  
      /* Ubicar nombre cultivo */
      var cultivo_name = 
      {
        "id_cultivo":cultivo
      };
  
      $.ajax({
        data: cultivo_name,
        url: 'cultivo.php',
        type: 'POST',
        
        success: function(data)
        {      

        var objeto = JSON.parse(data);
        nameRegional = objeto.nameRegional;
          
        var plag_name = document.getElementById('planta_name')
        plag_name.innerHTML = nameRegional 
          
        },
        error: function (err) {
          alert("Disculpe, ocurrio un error");           
        }
      });

      /* Mostrar plagas del cultivo */
      var parametro = 
      {
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
          if (response=='invalid_user')  {
            window.location.replace('../cultivos');
          }else{
          $('#result').html(response); 
          }  

        },
        error: function (err) {
          alert("Disculpe, ocurrio un error");           
        }
      });

    }else{
        window.location.replace("../");
    }
  }
    plagas();



  /* Eliminar cultivos */
  function eliminar(id_plagas){

    if (confirm("Esta seguro que desea eliminar esta plaga?"))
    {
      var loc = document.location.href;
      // cogemos la parte de la url que hay despues del interrogante
      var id = loc.split('=')[1];

      var parametro = 
      {
        "id_plagas":id_plagas,
        "id_cultivo":id,
        
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

          if (response.indexOf("La plaga seleccionada no puede ser eliminada debido a que esta cuenta con uno o mas tratamientos registrados.")=='-1'){
            setTimeout(function(){window.location.reload();}, 3000);
          }
        },
        error: function (err) {
          alert("Disculpe, ocurrio un error");           
        }
    
      });
  
    } 
  }

    /* Solicitar aval */
    function aval(id_plagas){

      if (confirm("¿Esta seguro que desea solicitar el aval?"))
      {
        /* obtener los valores enviamos por GET */
        var loc = window.location.search;
        /* Buscar en los valores el nombre del campo y obtener su valor*/
        const urlParams  = new URLSearchParams(loc);
        var cultivo = urlParams .get('cultivo');
  
          var parametro = 
          {
            "id_plagas":id_plagas,
            "id_cultivo":cultivo,
          };
        
          $.ajax({
            data: parametro,
            url: 'aval.php',
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
  
    /* Solicitar nuevamente aval */
    function repeat_aval(id_plagas){
  
      if (confirm("¿Esta seguro que desea solicitar nuevamente el aval?"))
      {
        /* obtener los valores enviamos por GET */
        var loc = window.location.search;
        /* Buscar en los valores el nombre del campo y obtener su valor*/
        const urlParams  = new URLSearchParams(loc);
        var cultivo = urlParams .get('cultivo');

        var parametro = 
        {
          "id_plagas":id_plagas,
          "id_cultivo":cultivo,
        };
      
        $.ajax({
          data: parametro,
          url: 'repeat_aval.php',
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
  

/* Registar plaga */
  $("#p_register").submit(function(e){
    e.preventDefault();

    var tipoPlaga = document.getElementById('tipoPlaga').value;
    var nameT = document.getElementById('nameT').value;
    var nameC = document.getElementById('nameC').value;
    var descrip = document.getElementById('descrip').value;
    var photoA = document.getElementById('photoA').value;
    var photoB = document.getElementById('photoB').value;
    var photoC = document.getElementById('photoC').value;
    var photoD = document.getElementById('photoD').value;

    /* Mensaje de error */
    var tipoPlaga_error = document.getElementById('tipoPlaga_error')
    var nameT_error = document.getElementById('nameT_error')
    var nameC_error = document.getElementById('nameC_error')
    var descrip_error = document.getElementById('descrip_error')
    var photoA_error = document.getElementById('photoA_error')
    var photoB_error = document.getElementById('photoB_error')
    var photoC_error = document.getElementById('photoC_error')
    var photoD_error = document.getElementById('photoD_error')

    /* Color de alerta */
    var tipoPlaga_color = document.getElementsByClassName("tipoPlaga_color");
    var nameT_color = document.getElementsByClassName("nameT_color");
    var nameC_color = document.getElementsByClassName("nameC_color");
    var descrip_color = document.getElementsByClassName("descrip_color");
    var photoA_color = document.getElementsByClassName("photoA_color");
    var photoB_color = document.getElementsByClassName("photoB_color");
    var photoC_color = document.getElementsByClassName("photoC_color");
    var photoD_color = document.getElementsByClassName("photoD_color");

    if (!tipoPlaga) {
      tipoPlaga_error.innerHTML = 'Campo obligatorio.'
      $('.tipoPlaga_color').addClass('border-danger')
    }else{
      tipoPlaga_error.innerHTML = ''
      $('.tipoPlaga_color').removeClass('border-danger')
    }

    if (!nameT) {
      nameT_error.innerHTML = 'Campo obligatorio.'
      $('.nameT_color').addClass('border-danger')
    }else{
      nameT_error.innerHTML = ''
      $('.nameT_color').removeClass('border-danger')
    }

    if (!nameC) {
      nameC_error.innerHTML = 'Campo obligatorio.'
      $('.nameC_color').addClass('border-danger')
    }else{
      nameC_error.innerHTML = ''
      $('.nameC_color').removeClass('border-danger')
    }

    if (!descrip) {
      descrip_error.innerHTML = 'Campo obligatorio.'
      $('.descrip_color').addClass('border-danger')
    }else{
      descrip_error.innerHTML = ''
      $('.descrip_color').removeClass('border-danger')
    }

    if (!photoA) {
      photoA_error.innerHTML = 'Se debe adjuntar una foto.'
      $('.photoA_color').addClass('text-danger')
    }else{
      photoA_error.innerHTML = ''
      $('.photoA_color').removeClass('text-danger')
    }

    if (!photoB) {
      photoB_error.innerHTML = 'Se debe adjuntar una foto.'
      $('.photoB_color').addClass('text-danger')
    }else{
      photoB_error.innerHTML = ''
      $('.photoB_color').removeClass('text-danger')
    }

    if (!photoC) {
      photoC_error.innerHTML = 'Se debe adjuntar una foto.'
      $('.photoC_color').addClass('text-danger')
    }else{
      photoC_error.innerHTML = ''
      $('.photoC_color').removeClass('text-danger')
    }

    if (!photoD) {
      photoD_error.innerHTML = 'Se debe adjuntar una foto.'
      $('.photoD_color').addClass('text-danger')
    }else{
      photoD_error.innerHTML = ''
      $('.photoD_color').removeClass('text-danger')
    }

    if (tipoPlaga != "" & nameT != ""  & nameC != "" & descrip != "" & photoA != "" & photoB != "" & photoC != "" & photoD != ""){

      var loc = window.location.search;
      const urlParams  = new URLSearchParams(loc);
      var cultivo = urlParams .get('cultivo');

      var parametros = new FormData($("#p_register")[0]);
      parametros.append("id_cultivo", cultivo);

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

            if (response.indexOf("El formato de alguna de las imagenes no es valida (Solo se acepta jpg o jpeg).")=='-1'){
              document.getElementById("p_register").reset();
              setTimeout(function(){window.location.reload();}, 3000);
            }
            
            
          },
          error: function (err) {
            alert("Disculpe, ocurrio un error");           
        }
      });
    }
       
  });   
}


/* Consulta para actualizar plagas */
if(url.split('/').reverse()[0] == "actualizar.php"){ 

  /* obtener los valores enviamos por GET */
  var loc = window.location.search;
    
    if(loc)
    {
        /* Buscar en los valores el nombre del campo y obtener su valor*/
        const urlParams  = new URLSearchParams(loc);
        var plaga = urlParams .get('plaga');
        var cultivo = urlParams .get('cultivo');
          
        var parametro = 
        {
          "id_plagas":plaga,
          "id_cultivo":cultivo,
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
            if (data.indexOf("invalid_user")=='-1'){
              var objeto = JSON.parse(data);
  
              id_cultivo = objeto.id_cultivo; 
              tp_plaga = objeto.tp_plaga; 
              nombreT_plagas = objeto.nombreT_plagas; 
              nombreC_plagas = objeto.nombreC_plagas; 
              Descp_plagas = objeto.Descp_plagas; 
              imagen_u = objeto.imagen_u; 
              imagen_d = objeto.imagen_d; 
              imagen_t = objeto.imagen_t; 
              imagen_c = objeto.imagen_c; 

              document.update.tipoPlaga.value = tp_plaga;
              document.update.nameT.value = nombreT_plagas;
              document.update.nameC.value = nombreC_plagas;
              document.update.descrip.value = Descp_plagas;

              var btn_back = document.getElementById('btn-back')
              btn_back.innerHTML = '<a href="../plagas/?cultivo='+id_cultivo+'" class="btn btn-secondary mt-2" style="width: 49%;">cancelar</a>'

              var btn_update = document.getElementById('btn-update')
              btn_update.innerHTML = '<button type="submit" class="btn btn-success mt-2 float-right" style="width: 49%;">Actualizar</button>'
              
              var plag_img1 = document.getElementById('plag-img1')
              plag_img1.innerHTML = '<img src="plagas_img/'+imagen_u+'" alt="imagen_cultivo" class="img-thumbnail center-img w-75">'

              var plag_img2 = document.getElementById('plag-img2')
              plag_img2.innerHTML = '<img src="plagas_img/'+imagen_d+'" alt="imagen_cultivo" class="img-thumbnail center-img w-75">'

              var plag_img3 = document.getElementById('plag-img3')
              plag_img3.innerHTML = '<img src="plagas_img/'+imagen_t+'" alt="imagen_cultivo" class="img-thumbnail center-img w-75">'

              var plag_img4 = document.getElementById('plag-img4')
              plag_img4.innerHTML = '<img src="plagas_img/'+imagen_c+'" alt="imagen_cultivo" class="img-thumbnail center-img w-75">'
            }else{
              window.location.replace('../cultivos');
            }

            
      
          },
          error: function (err) {
            alert("Disculpe, ocurrio un error");           
          }
    
        });  

    }else{
      window.location.replace("../cultivos");
    }
}

/* Actualizar plagas */
$("#p_update").submit(function(e){
  e.preventDefault();
  
      var loc = window.location.search;
      const urlParams  = new URLSearchParams(loc);
      var plaga = urlParams .get('plaga');

      var tipoPlaga = document.getElementById('tipoPlaga').value;
      var nameT = document.getElementById('nameT').value;
      var nameC = document.getElementById('nameC').value;
      var descrip = document.getElementById('descrip').value;
      var photoA = document.getElementById('photoA').value;
      var photoB = document.getElementById('photoB').value;
      var photoC = document.getElementById('photoC').value;
      var photoD = document.getElementById('photoD').value;

      /* Mensaje de error */
      var tipoPlaga_error = document.getElementById('tipoPlaga_error')
      var nameT_error = document.getElementById('nameT_error')
      var nameC_error = document.getElementById('nameC_error')
      var descrip_error = document.getElementById('descrip_error')
      var photoA_error = document.getElementById('photoA_error')
      var photoB_error = document.getElementById('photoB_error')
      var photoC_error = document.getElementById('photoC_error')
      var photoD_error = document.getElementById('photoD_error')

      /* Color de alerta */
      var tipoPlaga_color = document.getElementsByClassName("tipoPlaga_color");
      var nameT_color = document.getElementsByClassName("nameT_color");
      var nameC_color = document.getElementsByClassName("nameC_color");
      var descrip_color = document.getElementsByClassName("descrip_color");
      var photoA_color = document.getElementsByClassName("photoA_color");
      var photoB_color = document.getElementsByClassName("photoB_color");
      var photoC_color = document.getElementsByClassName("photoC_color");
      var photoD_color = document.getElementsByClassName("photoD_color");
  

      if (!tipoPlaga) {
        tipoPlaga_error.innerHTML = 'Campo obligatorio.'
        $('.tipoPlaga_color').addClass('border-danger')
      }else{
        tipoPlaga_error.innerHTML = ''
        $('.tipoPlaga_color').removeClass('border-danger')
      }

      if (!nameT) {
        nameT_error.innerHTML = 'Campo obligatorio.'
        $('.nameT_color').addClass('border-danger')
      }else{
        nameT_error.innerHTML = ''
        $('.nameT_color').removeClass('border-danger')
      }

      if (!nameC) {
        nameC_error.innerHTML = 'Campo obligatorio.'
        $('.nameC_color').addClass('border-danger')
      }else{
        nameC_error.innerHTML = ''
        $('.nameC_color').removeClass('border-danger')
      }

      if (!descrip) {
        descrip_error.innerHTML = 'Campo obligatorio.'
        $('.descrip_color').addClass('border-danger')
      }else{
        descrip_error.innerHTML = ''
        $('.descrip_color').removeClass('border-danger')
      }

      if (tipoPlaga != "" & nameT != ""  & nameC != "" & descrip != ""){
      
        var parametros = new FormData($("#p_update")[0]);
        parametros.append("id_plagas", plaga);

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

              if (response.indexOf("El formato de alguna de las imagenes no es valida (Solo se acepta jpg o jpeg).")=='-1'){
                setTimeout(function(){window.location.replace('../plagas/?cultivo='+id_cultivo+'');}, 5000);
              }
          },
          error: function (err) {
            alert("Disculpe, ocurrio un error");           
          }  
        });
    
      }

});


        