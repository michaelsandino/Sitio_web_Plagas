url = window.location.pathname;


/* ------------ CONSULTA PARA CULTIVOS ------------ */

if(url.split('/').reverse()[0] == ""){   

$(cultivos());

  function cultivos(filtro) {

    var loc = window.location.search;
    
    if(loc)
    {
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
            $("#progress").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeIn("slow");
        },
        success: function(response)
        {
            $("#progress").html('')

            if (!response) {
                $('#result').html('<p class="subtitle text-center my-4">No se han encontrado resultados.</p').fadeIn("slow");
            }else{
                $('#result').html(response).fadeIn("slow");
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

  /* Filtro para consulta */
    $(document).on('keyup', '#filtro', function()
    {
        var valorFiltro=$(this).val();
        if (valorFiltro!="") {
            history.pushState(null, "", "?pagina=1");
            cultivos(valorFiltro);
        }else{
            cultivos();
        }

    });
  
}


/* ------------ CONSULTA PARA PLAGAS ------------ */ 

if(url.split('/').reverse()[0] == "plagas.html"){ 

    /* ------ consultar el nombre cultivo ------- */
    var loc = window.location.search;
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
        $("#progress").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeIn("slow");
    },
    success: function(response)
    {
        $("#progress").html('')

        if (!response) {
            $('#cultivo').html('El cultivo no se encuentra avalado.').fadeIn("slow");
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

    /* ------ Consultar plagas ------ */ 
    $(plagas());

    function plagas(filtro) {

        var loc = window.location.search;
        
        if(loc)
        {
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
                $("#progress").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeIn("slow");
            },
            success: function(response)
            {
                $("#progress").html('')

                if (!response) {
                    $('#result').html('<p class="subtitle text-center my-4">No se han encontrado resultados.</p').fadeIn("slow");
                }else{
                    $('#result').html(response).fadeIn("slow");
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

    /* Filtro para consulta */
    $(document).on('keyup', '#filtro', function()
    {
        var valorFiltro=$(this).val();
        if (valorFiltro!="") {
            history.pushState(null, "", '?cultivo='+cultivo+'&pagina=1');
            plagas(valorFiltro);
        }else{
            plagas();
        }

    }); 
}


/* ------------ CONSULTAR TRATAMIENTOS ------------ */

if(url.split('/').reverse()[0] == "tratamientos.html"){ 

    /* ------ consultar nombre de la plaga ------- */
    var loc = window.location.search;
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
        $("#progress").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeIn("slow");
    },
    success: function(response)
    {
        $("#progress").html('')

        if (!response) {
            $('#plaga').html('La plaga no se encuentra avalado.').fadeIn("slow");
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

    /* ------ Consulta de tratamientos ------ */
    $(tratamientos());

    function tratamientos(filtro) {

        var loc = window.location.search;
        
        if(loc)
        {
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
                $("#progress").html('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>').fadeIn("slow");
            },
            success: function(response)
            {
                $("#progress").html('')

                if (!response) {
                    $('#result').html('<p class="subtitle text-center my-4">No se han encontrado resultados.</p').fadeIn("slow");
                }else{
                    $('#result').html(response).fadeIn("slow");
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

    /* Filtro para consulta */
    $(document).on('keyup', '#filtro', function()
    {
        var valorFiltro=$(this).val();
        if (valorFiltro!="") {
            history.pushState(null, "", '?plaga='+plaga+'&pagina=1');
            tratamientos(valorFiltro);
        }else{
            tratamientos();
        }

    });  

}