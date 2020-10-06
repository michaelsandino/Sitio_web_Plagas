/* Función de registrar usuarios con correo */
const register = document.querySelector("#register");
register.addEventListener("submit", (e) => {
  e.preventDefault();
  var email = document.getElementById('email-register').value;
    var password = document.getElementById('password-register').value;

  firebase.auth().createUserWithEmailAndPassword(email, password)
    
  /* Enviar mensaje de verificacion de correo */
  .then(function(){
    email_verification()
  })
      
  /* Redireccionamiento si no hay problemas */
  .then(result => {
    console.log("registrando...")
    window.location.replace("../usuario");
  })
  /* Mensaje de error final*/
  .catch(function(error) {
    var errorCode = error.code;
    var errorMessage = error.message;

    var register_error = document.getElementById('register_error')
    register_error.innerHTML = 'Correo invalido'
  });
});

/* Función de acceso usuarios */
const login = document.querySelector("#login");
login.addEventListener("submit", (e) => {
  e.preventDefault();

  var email = document.getElementById('email').value;
  var password = document.getElementById('password').value;

  firebase.auth().signInWithEmailAndPassword(email, password)

  /* Redireccionamiento si no hay problemas */
  .then(result => {
    console.log("ingresando...")
    window.location.replace("../usuario");
  })

  /* Mensaje de error final*/
  .catch(function(error) {
    var errorCode = error.code;
    var errorMessage = error.message;
    var login_error = document.getElementById('login_error')
    login_error.innerHTML = 'Correo o contraseña invalido'
  });

});

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
      console.log("ingresando...")
      window.location.replace("../usuario");
    } else {
      /* Borrar mensajes al cerrar sesión */
      console.log("Sesión cerrada...")
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
  var provider = new firebase.auth.GoogleAuthProvider();
  firebase.auth().signInWithPopup(provider).then(function(result) {
    var token = result.credential.accessToken;
    var user = result.user;
  })

  .then(result => {
    window.location.replace("../usuario");
  })
  
  .catch(function(error) {
    var errorCode = error.code;
    var errorMessage = error.message;
    var email = error.email;
    var credential = error.credential;
  });
}

/* Función de registrarse con facebook */
function facebook() {
  var provider = new firebase.auth.FacebookAuthProvider();

  firebase.auth().signInWithPopup(provider).then(function(result) {
    var token = result.credential.accessToken;
    var user = result.user;
  })

  .then(result => {
    window.location.replace("../usuario");
  })

  .catch(function(error) {
    var errorCode = error.code;
    var errorMessage = error.message;
    var email = error.email;
    var credential = error.credential;
  });
}