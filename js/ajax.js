$("#register").submit(function(e){
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
          $("#message").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeOut("slow");
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

$("#update").submit(function(e){
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
      url:'actualizar.php',
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

  