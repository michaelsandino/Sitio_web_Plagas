/* Consultar estudios */
function estudios() {
  firebase.auth().onAuthStateChanged(function(user) {
    if (user) {
      message(user)
      var email = user.email;

      var parametro = 
      {
        "email":email
      };
  
      $.ajax({
        data: parametro,
        url: 'consult.php',
        type: 'POST',
        
        beforeSend:function (objeto) {
          $("#progress").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeOut("slow");
        },
        success: function(response)
        {
          $('#result').html(response);
        },
        error: function (err) {
          alert("Disculpe, ocurrio un error");           
        }

      });
    }
  });
}
  estudios();
  setInterval(estudios, 3000);

/* Eliminar estudios */
function eliminar(id){

  if (confirm("Esta seguro que desea eliminar este estudio?"))
  {
    var parametro = 
    {
      "id":id
    };
  
    $.ajax({
      data: parametro,
      url: 'delete.php',
      type:'POST',

      beforeSend:function (objeto) {
        $("#eliminado").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeOut("slow");
      },
      success: function(response)
      {
        console.log(response)
        $('#eliminado').html(response).fadeIn("slow");
      },
      error: function (err) {
        alert("Disculpe, ocurrio un error");           
      }
  
    });
  }
  
}
  
/* Registrar de estudios*/
$("#e_register").submit(function(e){
  e.preventDefault();

  var nvformativo = document.getElementById('nvformativo').value;
  var titulo = document.getElementById('titulo').value;
  var entidadEdu = document.getElementById('entidadEdu').value;
  var fechGrado = document.getElementById('fechGrado').value;
 
  firebase.auth().onAuthStateChanged(function(user) {
    if (user) {
      message(user)
      var email = user.email;
      var ideUsu = email;

      var parametro = 
      {
        "nvformativo":nvformativo,
        "titulo":titulo,
        "entidadEdu":entidadEdu,
        "fechGrado":fechGrado,
        "ideUsu":ideUsu
      };

      $.ajax({
          url:'register.php',
          type:'POST',
          data:parametro,

          beforeSend:function (objeto) {
            $("#message").html('<div class="progress mt-3"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeOut("slow");
        },
          success: function(response)
          {    
            $("#message").html(response).fadeIn("slow");
            document.getElementById("e_register").reset();     
          },
          error: function (err) {
            alert("Disculpe, ocurrio un error");           
        }
      });
    }
  });

});   
