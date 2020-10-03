/* Función de registrar usuarios */
function registrar(){
    var email = document.getElementById('email-register').value;
    var password = document.getElementById('password-register').value;

    /* Creacion de variable para mostrar mensajes de error */
    var reg_email_error = document.getElementById('reg_email_error')
    var reg_password_error = document.getElementById('reg_password_error')
    var reg_email_mess = document.getElementsByClassName("reg_email_mess");
    var reg_password_mess = document.getElementsByClassName("reg_password_mess");

    /* Mensaje de error en correo*/
    if (!email) {
      $('.reg_email_mess').addClass('border-danger');
      reg_email_error.innerHTML = 'Este campo es obligatorio'
    }else if(email.indexOf('@') == -1 ){
      $('.reg_email_mess').addClass('border-danger');
      reg_email_error.innerHTML = 'El correo debe estar bien formateado'
    }else{
      $('.reg_email_mess').removeClass('border-danger');
      reg_email_error.innerHTML = ''
    }
    
    /* Mensaje de error en contraseña*/
    if(!password){
      $('.reg_password_mess').addClass('border-danger');
      reg_password_error.innerHTML = 'Este campo es obligatorio'
    }else if (password.length < 6) {
      $('.reg_password_mess').addClass('border-danger');
      reg_password_error.innerHTML = 'La contraseña debe tener al menos 6 caracteres' 
    }else{
      $('.reg_password_mess').removeClass('border-danger');
      reg_password_error.innerHTML = ''
    }

    /* Registro de usuarios */
    if (email != '' && password != '' && password.length >= 6) {
      firebase.auth().createUserWithEmailAndPassword(email, password)
    
      /* Enviar mensaje de verificacion de correo */
      .then(function(){
        verificar()
      })
      
      /* Redireccionamiento si no hay problemas */
      .then(result => {
        window.location.replace("../usuario");
      })
      
      /* Mensaje de error final*/
      .catch(function(error) {
        var errorCode = error.code;
        var errorMessage = error.message;
        console.log(errorCode);
        console.log(errorMessage);

        var register_error = document.getElementById('register_error')
        register_error.innerHTML = 'Correo invalido'
        
      });
    }

}

/* Función de acceso usuarios */
function acceso (){
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;

    /* Creacion de variable para mostrar mensajes de error */
    var email_error = document.getElementById('email_error')
    var password_error = document.getElementById('password_error')
    var email_mess = document.getElementsByClassName("email_mess");
    var password_mess = document.getElementsByClassName("password_mess");

    /* Mensaje de error en correo*/
    if (!email) {
      $('.email_mess').addClass('border-danger');
      email_error.innerHTML = 'Este campo es obligatorio'
    }else{
      $('.email_mess').removeClass('border-danger');
      email_error.innerHTML = ''
    }
    
    /* Mensaje de error en contraseña*/
    if(!password){
      $('.password_mess').addClass('border-danger');
      password_error.innerHTML = 'Este campo es obligatorio'
    }else{
      $('.password_mess').removeClass('border-danger');
      password_error.innerHTML = ''
    }

    /* Acceso de usuario */
    if (email != '' && password != '') {
      firebase.auth().signInWithEmailAndPassword(email, password)

    /* Redireccionamiento si no hay problemas */
    .then(result => {
      window.location.replace("../usuario");
    })

      /* Mensaje de error final*/
      .catch(function(error) {
        var errorCode = error.code;
        var errorMessage = error.message;
        var login_error = document.getElementById('login_error')
        login_error.innerHTML = 'Correo o contraseña invalido'
      });
    }
}

/* Función de revisión de usuario logueado */
function observador (){  
  firebase.auth().onAuthStateChanged(function(user) {
    if (user) {
      console.log('Existe usuario activo')
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
    }
  });
}
observador();

/* Mensajes de bienvenida */
function aparece(user){
  var user = user;
  var contenido = document.getElementById('success-message')
  if(user.emailVerified){
    contenido.innerHTML = '<div class="alert alert-success text-center" role="alert">Ha iniciado sesión correctamente,</div> <button class="btn btn-danger btn-block" onclick="cerrar()">Cerrar Sesion</button>';
  }else{
    contenido.innerHTML = '<div class="alert alert-success text-center" role="alert">Ha iniciado sesión correctamente</div> <div class="alert alert-danger text-center" role="alert">Recuerda: Tu correo no esta verificado</div> <button class="btn btn-danger btn-block" onclick="cerrar()">Cerrar Sesion</button>';
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

/* Función de verificacion de correo */
function verificar(){
  var user = firebase.auth().currentUser;
  user.sendEmailVerification().then(function() {
    console.log('Enviando Correo...')
  }).catch(function(error) {
    console.log(error)
  });
}

