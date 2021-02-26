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

function check_user() {
  console.log('hola')
  
  firebase.auth().onAuthStateChanged(function(user) {
    
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

    
  });
  
}

/* Función de revisión de usuario logueado */
function observer (){  
  firebase.auth().onAuthStateChanged(function(user) {
    if (user) {
      $("#autent").html('<button class="btn btn-success btn-block" onclick="check_user();">Usuario autenticado - Presione para ingresar.</button>')
    }
  });
}
observer();

