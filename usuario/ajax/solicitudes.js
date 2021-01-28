url = window.location.pathname;

/* Consultar silicitudes de usuario */
if(url.split('/').reverse()[0] == ""){   

    $.ajax({
      url: 'consult.php',
      type: 'POST',

      beforeSend:function (objeto) {
        $("#progress").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeIn("slow");
      },
      
      success: function(response)
      { 
        $("#progress").html('')

        if(response=='invalid_user'){
            window.location.replace('../inicio');
        }else if(!response) {
            $('#result').html('<p class="subtitle text-center my-4">Actualmente no se encuentra solicitudes en espera.</p>').fadeIn("slow");  
        }else{
            $('#result').html(response).fadeIn("slow");
          }

      },
      error: function (err) {
        alert("Disculpe, ocurrio un error");           
      }
    });

}

/* Consultar información de la solicitud*/
if(url.split('/').reverse()[0] == "info.php"){  

    function solicitudes() {
        /* obtener los valores enviamos por GET */
        var loc = window.location.search;

        if(loc)
        {
            const urlParams  = new URLSearchParams(loc);
            var solicitud = urlParams .get('solicitud');

            var parametro = 
                {
                "solicitud":solicitud,
                };

            $.ajax({
                data: parametro,
                url: 'consult_info.php',
                type: 'POST',
        
                beforeSend:function (objeto) {
                $("#progress").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeIn("slow");
                },
                
                success: function(response)
                { 

                $("#progress").html('')

                if(response=='invalid_user'){
                    window.location.replace('../inicio');
                }else if(response=='solicitud_invalida') {
                    window.location.replace('../solicitudes');
                }else{
                    $('#result').html(response).fadeIn("slow");
                    }
        
                },
                error: function (err) {
                alert("Disculpe, ocurrio un error");           
                }
            });
        
        }
    }
    solicitudes();

    /* Actualizar solicitud de usuario */
    function solicitud(){
        
        var loc = window.location.search
        const urlParams  = new URLSearchParams(loc);
        var solicitud = urlParams .get('solicitud');

        var option1 = document.getElementById('option1').checked;
        var option2 = document.getElementById('option2').checked;
        var nota = document.getElementById('nota').value; 

        /* Mensaje de error */
        var cumplimiento_error = document.getElementById('cumplimiento_error')

        /* Color de alerta */
        var cumplimiento_color = document.getElementsByClassName("cumplimiento_color");

        if (!option1 & !option2) {
        cumplimiento_error.innerHTML = 'Elija alguna de las opciones.'
        $('.cumplimiento_color').addClass('text-danger')
        }else{
        cumplimiento_error.innerHTML = ''
        $('.cumplimiento_color').removeClass('text-danger')
        }

        if (option1 != "" | option2 != ""){


        if(option1) {
            cumplimiento = "Admitido"
        }else if (option2) {
            cumplimiento = "Rechazado"
        }
        
        var parametro = 
        {
            "cumplimiento":cumplimiento,
            "nota":nota,
            "email":solicitud,
        };

        $.ajax({
            url: 'update.php',
            type:'POST',
            data:parametro,
        
            beforeSend:function (objeto) {
            $("#message").html('<div class="progress  mt-2"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeIn("slow");
            },
            success: function(response)
            { 
                $("#message").html(response).fadeIn("slow");
                setTimeout(function(){window.location.replace('../solicitudes');}, 3000);
            },
            error: function (err) {
            alert("Disculpe, ocurrio un error");           
            }  
        });
        }
    }

}
