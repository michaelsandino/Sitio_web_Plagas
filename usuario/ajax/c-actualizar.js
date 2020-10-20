/* Actualizar cultivos */
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

    
  
  
