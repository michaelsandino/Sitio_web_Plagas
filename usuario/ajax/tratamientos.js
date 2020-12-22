url = window.location.pathname;

/* Consultar */
if(url.split('/').reverse()[0] == ""){   

  /* Consultar tratamientos */
  function tratamientos() {

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
            "idUsuCultivo":email,
            "id_plaga":id
          };


          /* Mostrar tratamientos del cultivo */
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
          
          /* Ubicar nombre cultivo */
         

        }
      });
    }else{
        window.location.replace("../");
    }
  }
    tratamientos();
    /* setInterval(cultivos, 3000); */



  /* Eliminar cultivos */
  function eliminar(id_plagas){

    if (confirm("Esta seguro que desea eliminar esta plaga?"))
    {
      firebase.auth().onAuthStateChanged(function(user) {
        
        if (user) {
          message(user)
          var email = user.email;

          var loc = document.location.href;
          // cogemos la parte de la url que hay despues del interrogante
          var id = loc.split('=')[1];

          var parametro = 
          {
            "id_plagas":id_plagas,
            "id_cultivo":id,
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

}