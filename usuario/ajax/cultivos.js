/* Consultar cultivos */
function cultivos() {
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
  cultivos();
  setInterval(cultivos, 3000);


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
        $('#eliminado').html(response).fadeIn("slow");
      },
      error: function (err) {
        alert("Disculpe, ocurrio un error");           
      }
  
    });
  }
  
}

$("#c_register").submit(function(e){
  e.preventDefault();

  var nameR = document.getElementById('nameR').value;
  var nameC = document.getElementById('nameC').value;
  var descrip = document.getElementById('descrip').value;
 
  firebase.auth().onAuthStateChanged(function(user) {
    if (user) {
      message(user)
      var email = user.email;
      var id = email;

      var parametro = 
      {
        "nameR":nameR,
        "nameC":nameC,
        "descrip":descrip,
        "id":id,
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
            document.getElementById("c_register").reset();     
          },
          error: function (err) {
            alert("Disculpe, ocurrio un error");           
        }
      });
    }
  });

});   