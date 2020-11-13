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
              $('#result').html(response);
            },
            error: function (err) {
              alert("Disculpe, ocurrio un error");           
            }
    
          });
        }
      });
    }
    cultivos();
    setInterval(cultivos, 3000);


  /* Eliminar cultivos */
  function eliminar(id_cultivo){

    if (confirm("Esta seguro que desea eliminar este cultivo?"))
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
                document.getElementById("c_register").reset();     
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
              "id_user":email,
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

/* Actualizar cultivos */
$("#c_update").submit(function(e){
  e.preventDefault();

  var loc = document.location.href;
// si existe el interrogante
if(loc.indexOf('?')>0)
{
    // cogemos la parte de la url que hay despues del interrogante
    var id = loc.split('=')[1];

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
              var id_user = email;
              var id_cultivo = id;
    
            var parametros = new FormData($("#c_update")[0]);
            parametros.append("id_user", id_user);
            parametros.append("id_cultivo", id_cultivo);

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
                  setTimeout(function(){window.location.replace("../cultivos");}, 5000);
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