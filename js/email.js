firebase.auth().onAuthStateChanged(function(user) {
    /* Crear mensaje de bienvenida */
    var displayName = user.displayName;
    var email = user.email;
    var emailVerified = user.emailVerified;
    var photoURL = user.photoURL;
    var isAnonymous = user.isAnonymous;
    var uid = user.uid;
    var providerData = user.providerData;
    
    document.register.email.value = email;              
});