<?php

include("../connect.php");

    $pagina =$_POST['pagina'];
    $cultivo =$_POST['cultivo'];

    /* Saber la cantidad de resultados */
    if (isset($_POST['filtro_c'])) {
        $filtro = $_POST['filtro_c'];
        $cantidad="SELECT COUNT(*) FROM plagas WHERE stado_p='Activo' AND id_cultivo='$cultivo' AND(tp_plaga LIKE '%$filtro%' OR nombreT_plagas LIKE '%$filtro%' OR nombreC_plagas LIKE '%$filtro%')";  
    }else{
        $cantidad= "SELECT COUNT(*) FROM plagas WHERE stado_p='Activo' AND id_cultivo='$cultivo'";      
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
        $consult="SELECT * FROM plagas WHERE stado_p='Activo' AND id_cultivo='$cultivo' AND(tp_plaga LIKE '%$filtro%' OR nombreT_plagas LIKE '%$filtro%' OR nombreC_plagas LIKE '%$filtro%') LIMIT $iniciar,$terminar";  
    }else{
        $consult= "SELECT * FROM plagas WHERE stado_p='Activo' AND id_cultivo='$cultivo' LIMIT $iniciar,$terminar";  
    }
    $result = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

    /* Imprimimos la información */
    while($view = mysqli_fetch_array($result))
    {
    echo 
    '<div class="col-12 border rounded pt-0 pl-0 pr-0">
        
        <p class="text bg-orange text-white pl-3" style="height: 31px; font-size:20px;">'.$view['nombreT_plagas'].'</p>
    
        <div class="row">

            <div class="col-12">
                <p class="text text-left mx-3"><strong>Tipo:</strong> '.$view['tp_plaga'].' <br>
                <strong>Nombre científico:</strong> <em>'.$view['nombreC_plagas'].'</em></p>
            </div>

            <div class="col-12">
                <p class="text mx-3">'.nl2br($view['Descp_plagas']).'</p>
                
                <button class="btn btn-light border boton" type="button" data-toggle="collapse" data-target="#img'.$view['id_plagas'].'" aria-expanded="false" aria-controls="collapseExample">
                    Ver imagenes
                </button>
                
                <div class="collapse center_container" id="img'.$view['id_plagas'].'">
        
                <img src="'.$view['imagen_u'].'" class="plag_image" alt="imagen_plaga">
                <img src="'.$view['imagen_d'].'" class="plag_image" alt="imagen_plaga">
                <img src="'.$view['imagen_t'].'" class="plag_image" alt="imagen_plaga">
                <img src="'.$view['imagen_c'].'" class="plag_image" alt="imagen_plaga">
        
                </div>
                <a href="tratamientos.html?plaga='.$view['id_plagas'].'&pagina=1" class=" btn btn-light btn-block mt-4 font-weight-bold">Tratamientos<img src="../icons/corazon.svg" height="25px" class="pl-2" alt="icono_plaga"></a>
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
                        <a class="page-link" href="plagas.html?cultivo='.$cultivo.'&pagina='.($pagina-1).'">Anterior</a>
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
                    echo'<li class="page-item"><a class="page-link" href="plagas.html?cultivo='.$cultivo.'&pagina='.$i.'">'.$i.'</a></li>';
                }else{
                    echo'<li class="page-item"><a class="page-link bg-orange text-white" href="plagas.html?cultivo='.$cultivo.'&pagina='.$i.'">'.$i.'</a></li>';
                }
            }

            /* Desactivamos o habilitamos la opción de siguiente segun la pagina actual */
            if ($pagina!=$npage) {
                echo 
                '<li class="page-item">
                    <a class="page-link" href="plagas.html?cultivo='.$cultivo.'&pagina='.($pagina+1).'">Siguiente</a>
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