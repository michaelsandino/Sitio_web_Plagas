<?php

include("../connect.php");

    $pagina =$_POST['pagina'];

    /* Saber la cantidad de resultados */
    if (isset($_POST['filtro_c'])) {
        $filtro = $_POST['filtro_c'];
        $cantidad="SELECT COUNT(*) FROM cultivo WHERE stado_c='Activo' AND (nameRegional LIKE '%$filtro%' OR nameCientifico LIKE '%$filtro%')";  
    }else{
        $cantidad= "SELECT COUNT(*) FROM cultivo WHERE stado_c='Activo'";      
    }
    /* realizamos la consulta */
    $cantidad = mysqli_query($connect,$cantidad) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');
    $total=mysqli_fetch_row($cantidad);
    $total = $total[0];

    /* Segun la cantidad de resultados dividimos por la cantidad de registros por paginas (5 en este caso) */
    $npage = ceil($total/5);
    /* Marcamos segun la pagina en que se encuentre el usuario mostrar los registros respectivos */
    $iniciar = ($pagina-1)*5; 
    $terminar = $iniciar+5;

    /* limitar los registros que se muestran segun la pagina */
    if (isset($_POST['filtro_c'])) {
        $filtro = $_POST['filtro_c'];
        $consult="SELECT * FROM cultivo WHERE stado_c='Activo' AND (nameRegional LIKE '%$filtro%' OR nameCientifico LIKE '%$filtro%') LIMIT $iniciar,$terminar";  
    }else{
        $consult= "SELECT * FROM cultivo WHERE stado_c='Activo' LIMIT $iniciar,$terminar";  
    }
    $result = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

    /* Imprimimos la información */
    while($view = mysqli_fetch_array($result))
    {
    echo 
    '<div class="col-12 border rounded pt-0 pl-0 pr-0">

        <p class="text bg-orange text-white pl-3" style="height: 31px; font-size:20px;">'.$view['nameRegional'].'</p>
        

        <div class="row">
            <div class="col-11 col-md-5 col-lg-4 pr-0">
                <img src="../usuario/cultivos/'.$view['imagenC'].'" class="w-100 mx-3 mb-2" alt="imagen_cultivo">
            </div>

            <div class="col-12 col-md-7 col-lg-8">
                <p class="text text-left mx-3"><strong>Nombre científico: </strong> <em>'.$view['nameCientifico'].'</em> </p>
            </div>

            <button class="btn btn-light btn-block mx-3 mt-2" type="button" data-toggle="collapse" data-target="#ver_detalles_'.$view['idCultivo'].'" aria-expanded="false" aria-controls="ver_detalles_'.$view['idCultivo'].'">Ver Detalles<img src="../icons/lupa-2.svg" height="25px" class="pl-2" alt="icono_consultar"></button>

            <div class="col-12 collapse " id="ver_detalles_'.$view['idCultivo'].'">
                <p class="text mt-3 mx-3">'.nl2br($view['descripCultivo']).'</p>
                <a href="plagas.html?cultivo='.$view['idCultivo'].'&pagina=1" class=" btn btn-light btn-block font-weight-bold">Plagas y enfermedades<img src="../icons/plaga-2.svg" height="25px" class="pl-2" alt="icono_plaga"></a> 
            </div>
            

        </div>
        
    </div>'; 
    }

    /* Realizamos la enumeración */
    if ($total>5) {  
    echo
    '<section class="row">
        <div class="col-auto mx-auto mt-5">
            <ul class="pagination ">';
                
                /* Desactivamos o habilitamos la opción de anterior segun la pagina actual */
                if ($pagina!=1) {
                    echo 
                    '<li class="page-item">
                        <a class="page-link" href="?pagina='.($pagina-1).'">Anterior</a>
                    </li>';
                }else{
                    echo 
                    '<li class="page-item disabled">
                        <a class="page-link">Anterior</a>
                    </li>';
                }

                echo'
                ';

            /* Mostrar la cantidad de paginas generadas segun la cantidad de registro, marcando cual es la pagina en que se encuentra */
            for ($i=1; $i <= $npage ; $i++) { 
                if ($pagina!=$i) {
                    echo'<li class="page-item"><a class="page-link" href="?pagina='.$i.'">'.$i.'</a></li>';
                }else{
                    echo'<li class="page-item"><a class="page-link bg-orange text-white" href="?pagina='.$i.'">'.$i.'</a></li>';
                }
            }

            /* Desactivamos o habilitamos la opción de siguiente segun la pagina actual */
            if ($pagina!=$npage) {
                echo 
                '<li class="page-item">
                    <a class="page-link" href="?pagina='.($pagina+1).'">Siguiente</a>
                </li>';
            }else{
                echo 
                '<li class="page-item disabled">
                    <a class="page-link">Siguiente</a>
                </li>';
            }

    echo 
            '</ul>
        </div>
    </section>';
    }
    

    


include("../disconnect.php");


?>