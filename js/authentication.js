/* Función de registrar usuarios con correo */
function register() {

  var email = document.getElementById('email-register').value;
  var password = document.getElementById('password-register').value;

  var reg_email_error = document.getElementById('reg_email_error')
  var reg_password_error = document.getElementById('reg_password_error')
  var reg_email_color = document.getElementsByClassName("reg_email_color");
  var reg_password_color = document.getElementsByClassName("reg_password_color");

  if (!email) {
    reg_email_error.innerHTML = 'Campo obligatorio.'
    $('.reg_email_color').addClass('border-danger')
  }else{
    reg_email_error.innerHTML = ''
    $('.reg_email_color').removeClass('border-danger')
  }

  if (!password) {
    reg_password_error.innerHTML = 'Campo obligatorio.'
    $('.reg_password_color').addClass('border-danger')
  }else {
    reg_password_error.innerHTML = ''
    $('.reg_password_color').removeClass('border-danger')
  }

  firebase.auth().createUserWithEmailAndPassword(email, password)
    
  /* Enviar mensaje de verificacion de correo */
  .then(function(){
    email_verification()
  })
      
  /* Redireccionamiento si no hay problemas */
  .then(result => {
    console.log("registrando...")
  })
  /* Mensaje de error final*/
  .catch(function(error) {
    var errorCode = error.code;
    var errorMessage = error.message;

    var register_error = document.getElementById('register_error')

    console.log(errorMessage)
    
    if (email!='') {
      if (errorMessage == 'The email address is badly formatted.') {
        reg_email_error.innerHTML = 'Correo invalido.'
        $('.reg_email_color').addClass('border-danger')
      }else{
        reg_email_error.innerHTML = ''
        $('.reg_email_color').removeClass('border-danger')
      }
    }

    if (password.length > 0 && password.length < 6) {
      reg_password_error.innerHTML = 'La contraseña debe tener al menos 6 caracteres.'
      $('.reg_password_color').addClass('border-danger')
    }else if(password.length > 0){
      reg_password_error.innerHTML = ''
      $('.reg_password_color').removeClass('border-danger')
    }

    if(email!='' && password!=''){

      if (errorMessage == 'The email address is already in use by another account.') {
        register_error.innerHTML = 'Este correo ya está siendo utilizado por otra cuenta.'
      }else{
        register_error.innerHTML = ''
      }
    }

  });
}

/* Función de acceso usuarios */
function login() {
  var email = document.getElementById('email').value;
  var password = document.getElementById('password').value;

  /* Mensajes de error en campos vacios */
  var email_error = document.getElementById('email_error')
  var password_error = document.getElementById('password_error')
  var email_color = document.getElementsByClassName("email_color");
  var password_color = document.getElementsByClassName("password_color");

  if (!email) {
    email_error.innerHTML = 'Este campo es obligatorio.'
    $('.email_color').addClass('border-danger');
  }else{
    email_error.innerHTML = ''
    $('.email_color').removeClass('border-danger');
  }
  if (!password) {
    password_error.innerHTML = 'Este campo es obligatorio.'
    $('.password_color').addClass('border-danger');
    
  }else{
    password_error.innerHTML = ''
    $('.password_color').removeClass('border-danger');
  }

  firebase.auth().signInWithEmailAndPassword(email, password)

  /* Redireccionamiento si no hay problemas */
  .then(result => {
    console.log("ingresando...")
  })

  /* Mensaje de error finales*/
  .catch(function(error) {
    var errorCode = error.code;
    var errorMessage = error.message;

    var login_error = document.getElementById('login_error')

    console.log(errorMessage)

    if (errorMessage == 'The email address is badly formatted.' && email!='') {
      $('.email_color').addClass('border-danger');
      email_error.innerHTML = 'Correo invalido.'
    }

    if (errorMessage == 'There is no user record corresponding to this identifier. The user may have been deleted.') {
      login_error.innerHTML = 'No existe un usuario con estas credenciales.'
    }else if (errorMessage == 'The password is invalid or the user does not have a password.' && password!='') {
      login_error.innerHTML = 'Contraseña incorrecta.'
    }else if (errorMessage == 'Access to this account has been temporarily disabled due to many failed login attempts. You can immediately restore it by resetting your password or you can try again later.') {
      login_error.innerHTML = 'El acceso a esta cuenta se ha desactivado temporalmente debido a muchos intentos fallidos. Puede restaurarlo inmediatamente restableciendo su contraseña o seguir intentado más tarde.'
    }else{
      login_error.innerHTML = ''
    }

  });
}

/* Función de revisión de usuario logueado */
function observer (){  
  firebase.auth().onAuthStateChanged(function(user) {
    if (user) {
      /* Crear mensaje de bienvenida */
      var displayName = user.displayName;
      var email = user.email;
      var emailVerified = user.emailVerified;
      var photoURL = user.photoURL;
      var isAnonymous = user.isAnonymous;
      var uid = user.uid;
      var providerData = user.providerData;
      setTimeout(function(){window.location.replace("../usuario/inicio");}, 1000);
    }
  });
}
observer();

/* Función de verificacion de correo */
function email_verification(){
  var user = firebase.auth().currentUser;
  user.sendEmailVerification().then(function() {
    console.log('Enviando Correo...')
  }).catch(function(error) {
    console.log(error)
  });
}

/* Función de registrarse con Google */
function google() {
  var aut_error = document.getElementById('aut_error');

  var provider = new firebase.auth.GoogleAuthProvider();
  firebase.auth().signInWithPopup(provider).then(function(result) {
    var token = result.credential.accessToken;
    var user = result.user;
  })

  .then(result => {
    
    firebase.auth().onAuthStateChanged(function(user) {
      if (user) {
        var email = user.email;

        var parametro = 
        {
            "email":email,
        };
        $.ajax({
          url: '../usuario/open.php',
          type: 'POST',
          data:parametro,
          
          success: function(response)
          { 
            if(!response){
              window.location.replace("../usuario/registro");
            }else{
              window.location.replace("../usuario/inicio");
            }     
            
          },
          error: function (err) {
            alert("Disculpe, ocurrio un error");           
          }
  
      });

      }
    });
      
    aut_error.innerHTML = '';  
  })

  .catch(function(error) {
    var errorCode = error.code;
    var errorMessage = error.message;
    var email = error.email;
    var credential = error.credential;
    
    if (errorMessage == 'The popup has been closed by the user before finalizing the operation.') {
      aut_error.innerHTML = 'Ha cerrado la ventana emergente antes de finalizar la operación.';  
    }
    
    if (errorMessage == 'An account already exists with the same email address but different sign-in credentials. Sign in using a provider associated with this email address.') {
      aut_error.innerHTML = 'Ya existe una cuenta con la misma dirección de correo electrónico pero con un metodo de inicio de sesión diferente.';  
    }     
    
  });
}

/* Función de registrarse con facebook */
function facebook() {
  var aut_error = document.getElementById('aut_error');
  
  var provider = new firebase.auth.FacebookAuthProvider();

  firebase.auth().signInWithPopup(provider).then(function(result) {
    var token = result.credential.accessToken;
    var user = result.user;
  })

  /* Enviar mensaje de verificacion de correo */
  .then(function(){
    email_verification()
  })

  .then(result => {
    
    firebase.auth().onAuthStateChanged(function(user) {
      if (user) {
        var email = user.email;

        var parametro = 
        {
            "email":email,
        };
        $.ajax({
          url: '../usuario/open.php',
          type: 'POST',
          data:parametro,
          
          success: function(response)
          { 
            if(!response){
              window.location.replace("../usuario/registro");
            }else{
              window.location.replace("../usuario/inicio");
            }   
            
          },
          error: function (err) {
            alert("Disculpe, ocurrio un error");           
          }
  
      });

      }
    });

    aut_error.innerHTML = ''; 
  })

  .catch(function(error) {
    var errorCode = error.code;
    var errorMessage = error.message;
    var email = error.email;
    var credential = error.credential;

    if (errorMessage == 'The popup has been closed by the user before finalizing the operation.') {
      aut_error.innerHTML = 'Ha cerrado la ventana emergente antes de finalizar la operación.';  
    }
    
    if (errorMessage == 'An account already exists with the same email address but different sign-in credentials. Sign in using a provider associated with this email address.') {
      aut_error.innerHTML = 'Ya existe una cuenta con la misma dirección de correo electrónico pero con un metodo de inicio de sesión diferente.';  
    }

  });
}

/* Función de restablecimiento de contraseña */
function password_reset() {
  
  var auth = firebase.auth();
  var emailAddress = document.getElementById('emailAddress').value;
  var password_reset_error = document.getElementById('password_reset_error');
  var meessage = document.getElementById('password_reset_message');
  var reset_color = document.getElementsByClassName("reset_color");
  

  if (!emailAddress) {
    password_reset_error.innerHTML = 'Este campo es obligatorio';
    $('.reset_color').addClass('border-danger');
  }else{
    auth.sendPasswordResetEmail(emailAddress).then(function() {
      
    })
   
    .then(result => {
      $('.reset_color').removeClass('border-danger');
      meessage.innerHTML = '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">Correo de restablecimiento de contraseña enviado.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
    })

    .catch(function(error) {
    
      var errorCode = error.code;
      var errorMessage = error.message;
      console.log(errorMessage);

      if(errorMessage == 'The email address is badly formatted.'){
        password_reset_error.innerHTML = 'Correo invalido';
        $('.reset_color').addClass('border-danger');
      }else if(errorMessage == 'We have blocked all requests from this device due to unusual activity. Try again later.'){
        password_reset_error.innerHTML = 'Hemos bloqueado todas las solicitudes de este dispositivo debido a una actividad inusual. Inténtelo de nuevo más tarde.';
        $('.reset_color').removeClass('border-danger');
      }
  

    });
  }
}


