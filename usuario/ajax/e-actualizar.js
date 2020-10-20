/* Actualizar estudios */
var loc = document.location.href;
  // si existe el interrogante
  if(loc.indexOf('?')>0)
  {
      // cogemos la parte de la url que hay despues del interrogante
      var id = loc.split('=')[1];
      console.log(id);
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
    
              nivelFormacion = objeto.nivelFormacion; 
              tituloFormacion = objeto.tituloFormacion; 
              entidadEducativa = objeto.entidadEducativa; 
              fechaGrado = objeto.fechaGrado; 
    
              document.update.nvformativo.value = nivelFormacion;
              document.update.titulo.value = tituloFormacion;
              document.update.entidadEdu.value = entidadEducativa;
              document.update.fechGrado.value = fechaGrado;
        
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

    
  
  
