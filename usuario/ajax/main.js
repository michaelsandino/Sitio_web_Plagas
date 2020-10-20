/* Completar Resgistro de usuarios */
$("#u_register").submit(function(e){
    e.preventDefault();

    var email = document.getElementById('email').value;
    var nombre = document.getElementById('nombre').value;
    var apellido = document.getElementById('apellido').value;
    var ti = document.getElementById('ti').value;
    var ni = document.getElementById('ni').value;
    var fechanacimiento = document.getElementById('fechanacimiento').value;
    var telefono = document.getElementById('telefono').value;

    var parametro = 
    {
      "email":email,
      "nombre":nombre,
      "apellido":apellido,
      "ti":ti,
      "ni":ni,
      "fechanacimiento":fechanacimiento,
      "telefono":telefono
    };

    $.ajax({
        url:'register.php',
        type:'POST',
        data:parametro,

        beforeSend:function (objeto) {
          $("#message").html('<div class="progress"><div class="progress-bar mt-2 progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeOut("slow");
      },
        success: function(response)
        {    
          $("#message").html(response).fadeIn("slow"); 
          setTimeout(function(){window.location.replace("../inicio");}, 5000);
        },
        error: function (err) {
          alert("Disculpe, ocurrio un error");           
      }
    });

});    

/* Actualizar Perfil */
$("#p_update").submit(function(e){
  e.preventDefault();

  var email = document.getElementById('email').value;
  var nombre = document.getElementById('nombre').value;
  var apellido = document.getElementById('apellido').value;
  var ti = document.getElementById('ti').value;
  var ni = document.getElementById('ni').value;
  var fechanacimiento = document.getElementById('fechanacimiento').value;
  var telefono = document.getElementById('telefono').value;

  var parametro = 
  {
    "email":email,
    "nombre":nombre,
    "apellido":apellido,
    "ti":ti,
    "ni":ni,
    "fechanacimiento":fechanacimiento,
    "telefono":telefono
  };

  $.ajax({
      url:'update.php',
      type:'POST',
      data:parametro,

      beforeSend:function (objeto) {
        $("#message").html('<div class="progress mt-3"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeOut("slow");
    },
      success: function(response)
      {    
        $("#message").html(response).fadeIn("slow"); 
        setTimeout(function(){window.location.replace("../perfil");}, 5000);
      },
      error: function (err) {
        alert("Disculpe, ocurrio un error");           
    }
  });

});   


/* Actualizar estudios */
$("#e_update").submit(function(e){
  e.preventDefault();

  /* Actualizar estudios */
  var loc = document.location.href;
// si existe el interrogante
if(loc.indexOf('?')>0)
{
    // cogemos la parte de la url que hay despues del interrogante
    var id = loc.split('=')[1];

    firebase.auth().onAuthStateChanged(function(user) {
      if (user) {
        message(user)
        var nvformativo = document.getElementById('nvformativo').value;
        var titulo = document.getElementById('titulo').value;
        var entidadEdu = document.getElementById('entidadEdu').value;
        var fechGrado = document.getElementById('fechGrado').value;
        var email = user.email;
  
        var parametro = 
        {
          "ideUsu":email,
          "id":id,

          "nvformativo":nvformativo,
          "titulo":titulo,
          "entidadEdu":entidadEdu,
          "fechGrado":fechGrado

        };

        $.ajax({
          data: parametro,
          url: 'update_action.php',
          type:'POST',
      
          beforeSend:function (objeto) {
            $("#message").html('<div class="progress"><div class="progress-bar mt-2 progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeOut("slow");
          },
          success: function(response)
          {
              $('#message').html(response).fadeIn("slow");
              setTimeout(function(){window.location.replace("../estudios");}, 5000);
          },
          error: function (err) {
            alert("Disculpe, ocurrio un error");           
          }
    
        });
      }
    });

}else{
  window.location.replace("../estudios");
}

});   


/* Actualizar cultivos */
$("#c_update").submit(function(e){
  e.preventDefault();

  /* Actualizar estudios */
  var loc = document.location.href;
// si existe el interrogante
if(loc.indexOf('?')>0)
{
    // cogemos la parte de la url que hay despues del interrogante
    var id = loc.split('=')[1];

    firebase.auth().onAuthStateChanged(function(user) {
      if (user) {
        message(user)
        var nameR = document.getElementById('nameR').value;
        var nameC = document.getElementById('nameC').value;
        var descrip = document.getElementById('descrip').value;
        var email = user.email;
  
        var parametro = 
        {
          "id_user":email,
          "id_cultivo":id,
          "nameR":nameR,
          "nameC":nameC,
          "descrip":descrip

        };

        $.ajax({
          data: parametro,
          url: 'update_action.php',
          type:'POST',
      
          beforeSend:function (objeto) {
            $("#message").html('<div class="progress"><div class="progress-bar mt-2 progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeOut("slow");
          },
          success: function(response)
          {
              $('#message').html(response).fadeIn("slow");
              setTimeout(function(){window.location.replace("../cultivos");}, 5000);
          },
          error: function (err) {
            alert("Disculpe, ocurrio un error");           
          }
    
        });
      }
    });

}else{
  window.location.replace("../cultivos");
}

});  