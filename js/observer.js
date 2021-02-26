function observer (){  
    firebase.auth().onAuthStateChanged(function(user) {
      if (user) {
  
        /* -------Detectar inactividad------- */
        var contadorAfk = 0;
        $(document).ready(function () {
            //Cada minuto se lanza la función ctrlTiempo
            var contadorAfk = setInterval(ctrlTiempo, 60000); 

            //Si el usuario mueve el ratón cambiamos la variable a 0.
            $(this).mousemove(function (e) {
                contadorAfk = 0;
            });
            //Si el usuario presiona alguna tecla cambiamos la variable a 0.
            $(this).keypress(function (e) {
                contadorAfk = 0;
            });

        });

        function ctrlTiempo() {
            //Se aumenta en 1 la variable.
            contadorAfk++;
            //Se comprueba si ha pasado del tiempo que designemos.
            if (contadorAfk > 15) { // Más de 15 minutos, lo detectamos como ausente o inactivo.
              $.ajax({
                url: '../close.php',
                type: 'POST',
                
                success: function(response)
                { 
                  exit();
                  window.location.replace("../../ingresar");
                },
                error: function (err) {
                  alert("Disculpe, ocurrio un error");           
                }
              });
            }
        }
        
        
      } else {
        setTimeout(function(){window.location.replace('../../ingresar');}, 1000);
      }
      
    });
  }
  observer();
  


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






                        