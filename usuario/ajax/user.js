/* Consultar si el usuario ya a completado su registro */
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
          console.log(data)
            if (!data) {
                window.location.replace("../registro");
            }     
        },
        error: function (err) {
          alert("Disculpe, ocurrio un error");           
        }

      });
    }
});