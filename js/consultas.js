url = window.location.pathname;

/* Consultar */
if(url.split('/').reverse()[0] == ""){   

$(cultivos());

  /* Consultar cultivos */
  function cultivos(filtro) {

    var loc = window.location.search;
    
    if(loc)
    {
        /* Buscar en los valores el nombre del campo y obtener su valor*/
        const urlParams  = new URLSearchParams(loc);
        var pagina = urlParams .get('pagina');

        var parametro = 
        {
            "filtro_c":filtro,      
            "pagina":pagina,      
        };

        $.ajax({
        url: 'cultivos.php',
        type: 'POST',
        dataType:'html',
        data:parametro,

        beforeSend:function (objeto) {
            $("#progress").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeOut("slow");
        },
        success: function(response)
        {
            console.log(response)
            if (!response) {
                $('#result').html('<p class="subtitle text-center my-4">No se han encontrado resultados.</p');
            }else{
                $('#result').html(response);
            } 
            
        },
        error: function (err) {
            alert("Disculpe, ocurrio un error");           
        }

        });

    }else{
        window.location.replace('?pagina=1');
    }  
        
  }

    $(document).on('keyup', '#filtro', function()
    {
        var valorFiltro=$(this).val();
        if (valorFiltro!="") {
            cultivos(valorFiltro);
        }else{
            cultivos();
        }

    });
  
}


/* Consulta para actualizar cultivos */
if(url.split('/').reverse()[0] == "plagas.html"){ 

$(plagas());

/* Consultar cultivos */
function plagas(filtro) {

    var loc = window.location.search;
    
    if(loc)
    {
        /* Buscar en los valores el nombre del campo y obtener su valor*/
        const urlParams  = new URLSearchParams(loc);
        var pagina = urlParams .get('pagina');
        var cultivo = urlParams .get('cultivo');

        var parametro = 
        {
            "filtro_c":filtro,      
            "pagina":pagina,      
            "cultivo":cultivo,      
        };

        $.ajax({
        url: 'plagas.php',
        type: 'POST',
        dataType:'html',
        data:parametro,

        beforeSend:function (objeto) {
            $("#progress").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeOut("slow");
        },
        success: function(response)
        {
            if (!response) {
                $('#result').html('<p class="subtitle text-center my-4">No se han encontrado resultados.</p');
            }else{
                $('#result').html(response);
            } 
            
        },
        error: function (err) {
            alert("Disculpe, ocurrio un error");           
        }

        });

    }else{
        window.location.replace('../cultivos');
    }  
        
}

    $(document).on('keyup', '#filtro', function()
    {
        var valorFiltro=$(this).val();
        if (valorFiltro!="") {
            plagas(valorFiltro);
        }else{
            plagas();
        }

    });


    /* ------ NOMBRE DEL CULTIVO ------- */

    var loc = window.location.search;
    /* Buscar en los valores el nombre del campo y obtener su valor*/
    const urlParams  = new URLSearchParams(loc);
    var cultivo = urlParams .get('cultivo');

    var parametro = 
    {      
        "cultivo":cultivo,      
    };

    $.ajax({
    url: 'cultivo.php',
    type: 'POST',
    data:parametro,

    beforeSend:function (objeto) {
        $("#progress").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeOut("slow");
    },
    success: function(response)
    {
        console.log(response)
        if (!response) {
            $('#cultivo').html('El cultivo no se encuentra avalado.');
        }else{
            var objeto = JSON.parse(response);
            nameRegional = objeto.nameRegional;
            
            var cultivo = document.getElementById('cultivo')
            cultivo.innerHTML = nameRegional 
        } 
        
    },
    error: function (err) {
        alert("Disculpe, ocurrio un error");           
    }

    });     
    
}



if(url.split('/').reverse()[0] == "tratamientos.html"){ 

$(tratamientos());

/* Consultar cultivos */
function tratamientos(filtro) {

    var loc = window.location.search;
    
    if(loc)
    {
        /* Buscar en los valores el nombre del campo y obtener su valor*/
        const urlParams  = new URLSearchParams(loc);
        var pagina = urlParams .get('pagina');
        var plaga = urlParams .get('plaga');

        var parametro = 
        {
            "filtro_c":filtro,      
            "pagina":pagina,      
            "plaga":plaga,      
        };

        $.ajax({
        url: 'tratamientos.php',
        type: 'POST',
        dataType:'html',
        data:parametro,

        beforeSend:function (objeto) {
            $("#progress").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeOut("slow");
        },
        success: function(response)
        {
            if (!response) {
                $('#result').html('<p class="subtitle text-center my-4">No se han encontrado resultados.</p');
            }else{
                $('#result').html(response);
            } 
            
        },
        error: function (err) {
            alert("Disculpe, ocurrio un error");           
        }

        });

    }else{
        window.location.replace('../cultivos');
    }  
        
}

    $(document).on('keyup', '#filtro', function()
    {
        var valorFiltro=$(this).val();
        if (valorFiltro!="") {
            tratamientos(valorFiltro);
        }else{
            tratamientos();
        }

    });


    /* ------ NOMBRE DEL CULTIVO ------- */

    var loc = window.location.search;
    /* Buscar en los valores el nombre del campo y obtener su valor*/
    const urlParams  = new URLSearchParams(loc);
    var plaga = urlParams .get('plaga');

    var parametro = 
    {      
        "plaga":plaga,      
    };

    $.ajax({
    url: 'plaga.php',
    type: 'POST',
    data:parametro,

    beforeSend:function (objeto) {
        $("#progress").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeOut("slow");
    },
    success: function(response)
    {
        if (!response) {
            $('#plaga').html('La plaga no se encuentra avalado.');
        }else{
            var objeto = JSON.parse(response);
            nombreC_plagas = objeto.nombreT_plagas;
            
            var plaga = document.getElementById('plaga')
            plaga.innerHTML = nombreC_plagas 
        } 
        
    },
    error: function (err) {
        alert("Disculpe, ocurrio un error");           
    }

    });     
        

}