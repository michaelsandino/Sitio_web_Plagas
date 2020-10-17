firebase.auth().onAuthStateChanged(function(user) {
    if (user) {
      /* Crear mensaje de bienvenida */
      message(user)
      var displayName = user.displayName;
      var email = user.email;
      var emailVerified = user.emailVerified;
      var photoURL = user.photoURL;
      var isAnonymous = user.isAnonymous;
      var uid = user.uid;
      var providerData = user.providerData;

      var parametro = 
      {
        "email":email
      };
  
      $.ajax({
        data: parametro,
        url: '../perfil/consult.php',
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

          document.update.email.value = email;
          document.update.nombre.value = name;
          document.update.apellido.value = apellido;
          document.update.ti.value = ti;
          document.update.ni.value = ni;
          document.update.fechanacimiento.value = fechanacimiento;      
          document.update.telefono.value = telefono;      
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
  

