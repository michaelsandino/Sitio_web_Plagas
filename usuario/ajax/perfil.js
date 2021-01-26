url = window.location.pathname;

/* Consutar perfil */
if(url.split('/').reverse()[0] == ""){   
  firebase.auth().onAuthStateChanged(function(user) {
      if (user) {
        var photoURL = user.photoURL;

        var img = document.getElementById('img')
        img.innerHTML = `<img src="${photoURL}" alt="" class="mb-4 img-thumbnail center-img" width="120px">`;

        $.ajax({
          url: 'consult.php',
          type: 'POST',
          
          beforeSend:function (objeto) {
            $("#progress").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeIn("slow");
          },
          success: function(data)
          {
            $("#progress").html('')

            var objeto = JSON.parse(data);

            email = objeto.email; 
            name = objeto.nameUsu; 
            apellido = objeto.apellidoUsu; 
            tp_id = objeto.tp_id; 
            identidad = objeto.identidad; 
            fechanacimiento = objeto.fechanacimiento; 
            telefono = objeto.telefono; 

            var text_email = document.getElementById('text_email')
            text_email.innerHTML = email;

            var text_perfil = document.getElementById('text_perfil')
            text_perfil.innerHTML = `${name} ${apellido}`;

            var text_perfil = document.getElementById('text_identificacion')
            text_perfil.innerHTML = `${tp_id} ${identidad}`;

            var text_perfil = document.getElementById('text_fecha')
            text_perfil.innerHTML = `${fechanacimiento}`;

            var text_perfil = document.getElementById('text_telefono')
            text_perfil.innerHTML = `${telefono}`;         
          },
          error: function (err) {
            alert("Disculpe, ocurrio un error");           
          }

        });
      }
  });
}

/* Consulta para actualizar */
if(url.split('/').reverse()[0] == "actualizar.php"){   
  
  $.ajax({
    url: '../perfil/consult.php',
    type: 'POST',
    
    beforeSend:function (objeto) {
      $("#progress").html('<div class="progress my-2"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeIn("slow");
    },
    success: function(data)
    {
      $("#progress").html('')

      var objeto = JSON.parse(data);

      email = objeto.email; 
      name = objeto.nameUsu; 
      apellido = objeto.apellidoUsu; 
      tp_id = objeto.tp_id; 
      identidad = objeto.identidad; 
      fechanacimiento = objeto.fechanacimiento; 
      telefono = objeto.telefono; 

      document.update.email.value = email;
      document.update.nombre.value = name;
      document.update.apellido.value = apellido;
      document.update.ti.value = tp_id;
      document.update.ni.value = identidad;
      document.update.fechanacimiento.value = fechanacimiento;      
      document.update.telefono.value = telefono;      
    },
    error: function (err) {
      alert("Disculpe, ocurrio un error");           
    }

  });
    
}


/* Actualizar Perfil */
$("#p_update").submit(function(e){
  e.preventDefault();

  var nombre = document.getElementById('nombre').value;
  var apellido = document.getElementById('apellido').value;
  var ti = document.getElementById('ti').value;
  var ni = document.getElementById('ni').value;
  var fechanacimiento = document.getElementById('fechanacimiento').value;
  var telefono = document.getElementById('telefono').value;

  /* Mensaje de error */
  var nombre_error = document.getElementById('nombre_error')
  var apellido_error = document.getElementById('apellido_error')
  var ti_error = document.getElementById('ti_error')
  var ni_error = document.getElementById('ni_error')
  var fechanacimiento_error = document.getElementById('fechanacimiento_error')
  var telefono_error = document.getElementById('telefono_error')

  /* Color de alerta */
  var nombre_color = document.getElementsByClassName("nombre_color");
  var apellido_color = document.getElementsByClassName("apellido_color");
  var ti_color = document.getElementsByClassName("ti_color");
  var ni_color = document.getElementsByClassName("ni_color");
  var fechanacimiento_color = document.getElementsByClassName("fechanacimiento_color");
  var telefono_color = document.getElementsByClassName("telefono_color");

  if (!nombre) {
    nombre_error.innerHTML = 'Campo obligatorio.'
    $('.nombre_color').addClass('border-danger')
  }else{
    nombre_error.innerHTML = ''
    $('.nombre_color').removeClass('border-danger')
  }

  if (!apellido) {
    apellido_error.innerHTML = 'Campo obligatorio.'
    $('.apellido_color').addClass('border-danger')
  }else{
    apellido_error.innerHTML = ''
    $('.apellido_color').removeClass('border-danger')
  }

  if (!ti) {
    ti_error.innerHTML = 'Campo obligatorio.'
    $('.ti-color').addClass('border-danger')
  }else if(ti != "CC" & ti != "TI"){
    ti_error.innerHTML = 'Tipo de identificación invalida'
    $('.ti-color').addClass('border-danger')
  }
  else{
    ti_error.innerHTML = ''
    $('.ti-color').removeClass('border-danger')
  }

  if (!ni) {
    ni_error.innerHTML = 'Campo obligatorio.'
    $('.ni_color').addClass('border-danger')
  }else if( isNaN(ni) ) {
    ni_error.innerHTML = 'Este campo debe contener solo numeros.'
    $('.ni_color').addClass('border-danger')
  }else if( ni.length > 10) {
    ni_error.innerHTML = 'Máximo 10 digitos.'
    $('.ni_color').addClass('border-danger')
  }else{
    ni_error.innerHTML = ''
    $('.ni_color').removeClass('border-danger')
  }

  if (!fechanacimiento) {
    fechanacimiento_error.innerHTML = 'Campo obligatorio.'
    $('.fechanacimiento_color').addClass('border-danger')
  }else{
    fechanacimiento_error.innerHTML = ''
    $('.fechanacimiento_color').removeClass('border-danger')
  }

  if (!telefono) {
    telefono_error.innerHTML = 'Campo obligatorio.'
    $('.telefono_color').addClass('border-danger')
  }else if(isNaN(telefono) ) {
    telefono_error.innerHTML = 'Este campo debe contener solo numeros.'
    $('.telefono_color').addClass('border-danger')
  }else if( telefono.length < 10 | telefono.length > 10) {
    telefono_error.innerHTML = 'El telefono debe tener 10 digitos.'
    $('.telefono_color').addClass('border-danger')
  }else{
    telefono_error.innerHTML = ''
    $('.telefono_color').removeClass('border-danger')
  }

  if (nombre != "" & apellido != ""  & ti != "" & (ti == "CC" | ti == "TI") & ni != "" & isNaN(ni)==false & ni.length<=10 & fechanacimiento != "" & telefono != "" & isNaN(telefono)==false & telefono.length==10) {

    var parametro = 
    {
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
          $("#message").html('<div class="progress mt-3"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeIn("slow");
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
  }
     
});   
