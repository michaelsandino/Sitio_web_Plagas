url = window.location.pathname;

if(url.split('/').reverse()[0] == ""){   
  /* Consultar cultivos */
  function cultivos() {
      firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
          message(user)
          var email = user.email;
    
          var parametro = 
          {
            "email":email
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


  /* Eliminar estudios */
  function eliminar(id){

    if (confirm("Esta seguro que desea eliminar este estudio?"))
    {
      var parametro = 
      {
        "id":id
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
    
  }
  

/* Registar cultivo */
  $("#c_register").submit(function(e){
    e.preventDefault();

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
          var id = email;

          var parametro = 
          {
            "nameR":nameR,
            "nameC":nameC,
            "descrip":descrip,
            "id":id,
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

                document.update.nameR.value = nameRegional;
                document.update.nameC.value = nameCientifico;
                document.update.descrip.value = descripCultivo;
          
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

    firebase.auth().onAuthStateChanged(function(user) {
      if (user) {
        message(user)
        var nameR = document.getElementById('nameR').value;
        var nameC = document.getElementById('nameC').value;
        var descrip = document.getElementById('descrip').value;
        var email = user.email;

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

          var parametro = 
          {
            "id_user":email,
            "id_cultivo":id,
            "nameR":nameR,
            "nameC":nameC,
            "descrip":descrip

          };

          $.ajax({
            data: parametro,
            url: 'update_action.php',
            type:'POST',
        
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
      }
    });

}else{
  window.location.replace("../cultivos");
}

});  