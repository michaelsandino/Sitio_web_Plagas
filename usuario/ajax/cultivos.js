url = window.location.pathname;

/* Consultar */
if(url.split('/').reverse()[0] == ""){   
  /* Consultar cultivos */
  function cultivos() {
      firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
          message(user)
          var email = user.email;
    
          var parametro = 
          {
            "idUsuCultivo":email
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
              if (response!='invalid_user'){
                $('#result').html(response);
              }else{
                window.location.replace('../inicio');
              }
              
            },
            error: function (err) {
              alert("Disculpe, ocurrio un error");           
            }
    
          });
        }
      });
    }
    cultivos();


  /* Eliminar cultivos */
  function eliminar(id_cultivo){

    if (confirm("¿Esta seguro que desea eliminar este cultivo?"))
    {

      firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
          message(user)
          var email = user.email;
          
          var parametro = 
          {
            "id_cultivo":id_cultivo,
            "idUsuCultivo":email,
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

              if (response.indexOf("El cultivo seleccionado no puede ser eliminado debido a que esta cuenta con una o más plagas registradas.")=='-1'){
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
  }

  /* Solicitar aval */
  function aval(idCultivo){

    if (confirm("¿Esta seguro que desea solicitar el aval?"))
    {

      firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
          message(user)
          var email = user.email;
  
          var parametro = 
          {
            "idCultivo":idCultivo,
            "idUsuCultivo":email,
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
              console.log(response)

              $('#eliminado').html(response).fadeIn("slow");
              setTimeout(function(){window.location.reload();}, 3000);

            },
            error: function (err) {
              alert("Disculpe, ocurrio un error");           
            }
        
          });
        }
      });
    }
  }

  /* Solicitar nuevamente aval */
  function repeat_aval(idCultivo){

    if (confirm("¿Esta seguro que desea solicitar nuevamente el aval?"))
    {

      firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
          message(user)
          var email = user.email;
  
          var parametro = 
          {
            "idCultivo":idCultivo,
            "idUsuCultivo":email,
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
              console.log(response)

              $('#eliminado').html(response).fadeIn("slow");
              setTimeout(function(){window.location.reload();}, 3000);

            },
            error: function (err) {
              alert("Disculpe, ocurrio un error");           
            }
        
          });
        }
      });
    }
  }
  

/* Registar cultivo */
  $("#c_register").submit(function(e){
    e.preventDefault();

    var nameR = document.getElementById('nameR').value;
    var nameC = document.getElementById('nameC').value;
    var descrip = document.getElementById('descrip').value;
    var photo = document.getElementById('photo').value;

    /* Mensaje de error */
    var nameR_error = document.getElementById('nameR_error')
    var nameC_error = document.getElementById('nameC_error')
    var descrip_error = document.getElementById('descrip_error')
    var photo_error = document.getElementById('photo_error')

    /* Color de alerta */
    var nameR_color = document.getElementsByClassName("nameR_color");
    var nameC_color = document.getElementsByClassName("nameC_color");
    var descrip_color = document.getElementsByClassName("descrip_color");
    var photo_color = document.getElementsByClassName("photo_color");

    if (!nameR) {
      nameR_error.innerHTML = 'Campo obligatorio.'
      $('.nameR_color').addClass('border-danger')
    }else{
      nameR_error.innerHTML = ''
      $('.nameR_color').removeClass('border-danger')
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

    if (!photo) {
      photo_error.innerHTML = 'Se debe adjuntar una foto.'
      $('.photo_color').addClass('text-danger')
    }else{
      photo_error.innerHTML = ''
      $('.photo_color').removeClass('text-danger')
    }

    if (nameR != "" & nameC != ""  & descrip != "" & photo != ""){

      firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
          message(user)
          var email = user.email;
          var id_user = email;

          var parametros = new FormData($("#c_register")[0]);
          parametros.append("id_user", id_user);

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

                if (response.indexOf("El formato de la imagen no es valida.")=='-1'){
                  document.getElementById("c_register").reset();  
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
  });   
}


/* Consulta para actualizar cultivos */
if(url.split('/').reverse()[0] == "actualizar.php"){ 


   /* obtener los valores enviamos por GET */
   var loc = window.location.search;
    
   if(loc)
   {
       /* Buscar en los valores el nombre del campo y obtener su valor*/
       const urlParams  = new URLSearchParams(loc);
       var id = urlParams .get('cultivo');
  
        firebase.auth().onAuthStateChanged(function(user) {
          if (user) {
            message(user)
          var email = user.email;
      
            var parametro = 
            {
              "idUsuCultivo":email,
              "id_cultivo":id
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
        
                  nameRegional = objeto.nameRegional; 
                  nameCientifico = objeto.nameCientifico; 
                  descripCultivo = objeto.descripCultivo; 
                  imagenC = objeto.imagenC; 

                  document.update.nameR.value = nameRegional;
                  document.update.nameC.value = nameCientifico;
                  document.update.descrip.value = descripCultivo;

                  var plant_img = document.getElementById('plant-img')
                  plant_img.innerHTML = '<img src="cultivos_img/'+imagenC+'" alt="imagen_cultivo" class="img-thumbnail center-img w-75">'

                  var btn_back = document.getElementById('btn-back')
                  btn_back.innerHTML = '<a href="../cultivos/" class="btn btn-secondary mt-2" style="width: 49%;">cancelar</a>'
    
                  var btn_update = document.getElementById('btn-update')
                  btn_update.innerHTML = '<button type="submit" class="btn btn-success mt-2 float-right" style="width: 49%;">Actualizar</button>'

                }else{
                  window.location.replace('../cultivos');
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

/* Actualizar cultivos */
$("#c_update").submit(function(e){
  e.preventDefault();

  /* obtener los valores enviamos por GET */
  var loc = window.location.search;
    
    if(loc)
    {
        /* Buscar en los valores el nombre del campo y obtener su valor*/
        const urlParams  = new URLSearchParams(loc);
        var cultivo = urlParams .get('cultivo');

        var nameR = document.getElementById('nameR').value;
        var nameC = document.getElementById('nameC').value;
        var descrip = document.getElementById('descrip').value;    

        /* Mensaje de error */
        var nameR_error = document.getElementById('nameR_error')
        var nameC_error = document.getElementById('nameC_error')
        var descrip_error = document.getElementById('descrip_error')

        /* Color de alerta */
        var nameR_color = document.getElementsByClassName("nameR_color");
        var nameC_color = document.getElementsByClassName("nameC_color");
        var descrip_color = document.getElementsByClassName("descrip_color");
 

        if (!nameR) {
          nameR_error.innerHTML = 'Campo obligatorio.'
          $('.nameR_color').addClass('border-danger')
        }else{
          nameR_error.innerHTML = ''
          $('.nameR_color').removeClass('border-danger')
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
  
        if (nameR != "" & nameC != ""  & descrip != ""){

          firebase.auth().onAuthStateChanged(function(user) {
            if (user) {
              message(user)
              var email = user.email;
    
            var parametros = new FormData($("#c_update")[0]);
            parametros.append("id_user", email);
            parametros.append("id_cultivo", cultivo);

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

                  if (response.indexOf("El formato de la imagen no es valida.")=='-1'){
                    setTimeout(function(){window.location.replace("../cultivos");}, 5000);
                  }
                  
              },
              error: function (err) {
                alert("Disculpe, ocurrio un error");           
              }  
            });
          }
      });
    }
    

}else{
  window.location.replace("../cultivos");
}

});  