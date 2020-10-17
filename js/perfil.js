firebase.auth().onAuthStateChanged(function(user) {
    if (user) {
      message(user)
      var displayName = user.displayName;
      var email = user.email;
      var emailVerified = user.emailVerified;
      var photoURL = user.photoURL;
      var isAnonymous = user.isAnonymous;
      var uid = user.uid;
      var providerData = user.providerData;
      var img = document.getElementById('img')
      img.innerHTML = `<img src="${photoURL}" alt="" class="mb-4 img-thumbnail center-img" width="120px">`;

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
          var objeto = JSON.parse(data);

          email = objeto.email; 
          name = objeto.name; 
          apellido = objeto.apellido; 
          ti = objeto.ti; 
          ni = objeto.ni; 
          fechanacimiento = objeto.fechanacimiento; 
          telefono = objeto.telefono; 

          var text_email = document.getElementById('text_email')
          text_email.innerHTML = email;

          var text_perfil = document.getElementById('text_perfil')
          text_perfil.innerHTML = `${name} ${apellido}`;

          var text_perfil = document.getElementById('text_identificacion')
          text_perfil.innerHTML = `${ti} ${ni}`;

          var text_perfil = document.getElementById('text_fecha')
          text_perfil.innerHTML = `${fechanacimiento}`;

          var text_perfil = document.getElementById('text_telefono')
          text_perfil.innerHTML = `${telefono}`;         
        },
        error: function (err) {
          alert("Disculpe, ocurrio un error");           
        }

      });
    } else {
      console.log('NO existe usuario activo')
      /* Borrar mensajes al cerrar sesión */
    }
  });
  

