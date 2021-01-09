function observer (){  
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
      } else {
        console.log('NO existe usuario activo')
        /* Borrar mensajes al cerrar sesión */
        var contenido = document.getElementById('success-message')
        contenido.innerHTML = '';
        window.location.replace("../../ingresar");
      }
    });
  }
  observer();
  
/* Mensajes de bienvenida */
function message(user){
    var user = user;
    var contenido = document.getElementById('success-message')
    if(user.emailVerified){
      contenido.innerHTML = '';
    }else{
      contenido.innerHTML = '<div class="mt-4 alert alert-danger text-center" role="alert">Recuerda: Tu correo no esta verificado</div>';
    }
}

/* Funcion de cerrar Sesión */
function exit(){
    firebase.auth().signOut()
    .then(function(){
      console.log('Saliendo...')
      window.location.replace("../../ingresar");
    })
    .catch(function(error){
      console.log(error)
    })
}



                        