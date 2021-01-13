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
        /* Borrar mensajes al cerrar sesión */
        var contenido = document.getElementById('success-message')
        contenido.innerHTML = '';
        setTimeout(function(){window.location.replace('../../ingresar');}, 3000);
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
    
    $.ajax({
      url: '../close.php',
      type: 'POST',
      
      success: function(response)
      { 
        console.log(response)
        window.location.replace("../../ingresar");
      },
      error: function (err) {
        alert("Disculpe, ocurrio un error");           
      }
    });
    
  })
  .catch(function(error){
    console.log(error)
  })
}





                        