function observador (){  
    firebase.auth().onAuthStateChanged(function(user) {
      if (user) {
        /* Crear mensaje de bienvenida */
        aparece(user)
        var displayName = user.displayName;
        var email = user.email;
        var emailVerified = user.emailVerified;
        var photoURL = user.photoURL;
        var isAnonymous = user.isAnonymous;
        var uid = user.uid;
        var providerData = user.providerData;
        
        console.log(user.emailVerified)
      } else {
        console.log('NO existe usuario activo')
        /* Borrar mensajes al cerrar sesión */
        var contenido = document.getElementById('success-message')
        contenido.innerHTML = '';
        window.location.replace("../ingresar");
      }
    });
  }
  observador();
  
/* Mensajes de bienvenida */
function aparece(user){
    var user = user;
    var contenido = document.getElementById('success-message')
    var exit = document.getElementById('exit')
    if(user.emailVerified){
      contenido.innerHTML = '<div class="alert alert-success text-center" role="alert">Ha iniciado sesión correctamente,</div>';
      exit.innerHTML = '<hr class="menu-divider"> <button class="nav-link active btn btn-link" onclick="cerrar()"><img src="../icons/salida.svg" class="pr-2"  alt="icono_salir" height="20px">Cerrar Sesión</button>';
    }else{
      contenido.innerHTML = '<div class="alert alert-success text-center" role="alert">Ha iniciado sesión correctamente</div> <div class="alert alert-danger text-center" role="alert">Recuerda: Tu correo no esta verificado</div>';
      exit.innerHTML = '<hr class="menu-divider"> <button class="nav-link active btn btn-link" onclick="cerrar()"><img src="../icons/salida.svg" class="pr-2"  alt="icono_salir" height="20px">Cerrar Sesión</button>';
    }
}

/* Funcion de cerrar Sesión */
function cerrar(){
    firebase.auth().signOut()
    .then(function(){
      console.log('Saliendo')
      window.location.replace("../ingresar");
    })
    .catch(function(error){
      console.log(error)
    })
}



                        