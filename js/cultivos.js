url = window.location.pathname;

/* Consultar */
if(url.split('/').reverse()[0] == "cultivo.html"){   

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
        url: 'consult.php',
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
        window.location.replace('cultivo.html?pagina=1');
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

}

if(url.split('/').reverse()[0] == "tratamientos.html"){ 

}