url = window.location.pathname;
if(url.split('/').reverse()[1] == "jurado"){ 

    /* Consultar el estado en que se encuentra el usuario */
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
            success: function(data)
            {
                $('#result').html(data);     
            },
            error: function (err) {
              alert("Disculpe, ocurrio un error");           
            }
    
          });
        }
    });


    /* Solicitar ser jurado */
    function jurado(){
        if (confirm("¿Seguro que quieres ser parte del equipo de jurados?"))
        {
            firebase.auth().onAuthStateChanged(function(user) {
                if (user) {
                message(user)
                var email = user.email;
        
                var parametro = 
                {
                    "idSolicitante":email,
                };
                
                $.ajax({
                    data: parametro,
                    url: 'jurado.php',
                    type:'POST',

                    beforeSend:function (objeto) {
                    $("#progress-jurado").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeOut("slow");
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
            });
        }
    }

    /* Solicitar ser jurado nuevamente */
    function repeat_jurado(){
        if (confirm("¿Seguro que quieres ser parte del equipo de jurados?"))
        {
            firebase.auth().onAuthStateChanged(function(user) {
                if (user) {
                message(user)
                var email = user.email;
        
                var parametro = 
                {
                    "idSolicitante":email,
                };
                
                $.ajax({
                    data: parametro,
                    url: 'repeat_jurado.php',
                    type:'POST',

                    beforeSend:function (objeto) {
                    $("#progress-jurado").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeOut("slow");
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
            });
        }
    }

  

}else{
    console.log("error")
}