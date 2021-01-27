url = window.location.pathname;
if(url.split('/').reverse()[1] == "jurado"){ 

    /* Consulta del estado de la solicitud */
    $.ajax({
    url: 'consult.php',
    type: 'POST',
    
    beforeSend:function (objeto) {
        $("#result").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeIn("slow");
    },
    success: function(response)
    {
        if (response!='invalid_user'){
            $('#result').html(response).fadeIn("slow");
        }else{
            window.location.replace('../inicio');
        }
    },
    error: function (err) {
        alert("Disculpe, ocurrio un error");           
    }

    });

    /* Solicitar ser jurado */
    function jurado(){
        if (confirm("¿Seguro que quieres ser parte del equipo de jurados?")){     
            $.ajax({
                url: 'jurado.php',
                type:'POST',

                beforeSend:function (objeto) {
                $("#progress-jurado").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeIn("slow");
                },
                success: function(response)
                {
                $("#progress-jurado").html('')
                window.location.reload();

                },
                error: function (err) {
                alert("Disculpe, ocurrio un error");           
                }
            
            });
        }
    }

    /* Solicitar ser jurado nuevamente */
    function repeat_jurado(){
        if (confirm("¿Seguro que quieres ser parte del equipo de jurados?")){ 

            $.ajax({
                url: 'repeat_jurado.php',
                type:'POST',

                beforeSend:function (objeto) {
                $("#progress-jurado").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeIn("slow");
                },
                success: function(response)
                {
                $("#progress-jurado").html('')
                window.location.reload();

                },
                error: function (err) {
                alert("Disculpe, ocurrio un error");           
                }
            
            });
        }
    }

  

}