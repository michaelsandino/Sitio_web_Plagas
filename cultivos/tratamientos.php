<?php

include("../connect.php");

    $pagina =$_POST['pagina'];
    $plaga =$_POST['plaga'];

    /* SABER CANTIDAD DE RESULTADOS */
    if (isset($_POST['filtro_c'])) {
        $filtro = $_POST['filtro_c'];
        $cantidad="SELECT COUNT(*) FROM tratamiento WHERE stado_t='Activo' AND id_plaga='$plaga' AND(tipoTratamiento LIKE '%$filtro%' OR nameTrata LIKE '%$filtro%')";  
    }else{
        $cantidad= "SELECT COUNT(*) FROM tratamiento WHERE stado_t='Activo' AND id_plaga='$plaga'";      
    }
    $cantidad = mysqli_query($connect,$cantidad) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');
    $total=mysqli_fetch_row($cantidad);
    $total = $total[0];

    $npage = ceil($total/5);

    $iniciar = ($pagina-1)*5; 
    $terminar = $iniciar+5;

    /* LIMITAR LA INFORMACIÓN */
    if (isset($_POST['filtro_c'])) {
        $filtro = $_POST['filtro_c'];
        $consult="SELECT * FROM tratamiento WHERE stado_t='Activo' AND id_plaga='$plaga' AND(tipoTratamiento LIKE '%$filtro%' OR nameTrata LIKE '%$filtro%') LIMIT $iniciar,$terminar";  
    }else{
        $consult= "SELECT * FROM tratamiento WHERE stado_t='Activo' AND id_plaga='$plaga' LIMIT $iniciar,$terminar";  
    }
    $result = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

    while($view = mysqli_fetch_array($result))
    {
    echo 
    '<div class="col-12 border rounded pt-0 pb-2 pl-0 pr-0">
 
        <p class="text bg-orange text-white pl-3" style="height: 31px; font-size:20px;">'.$view['nameTrata'].'</p>

            <div class="row">

                <div class="col-12">
                    <p class="text text-left mx-3"><strong>Tipo de tratamiento</strong>: <br>'.$view['tipoTratamiento'].' <a href="" target="_blank" class="btn R_A">R/A <img src="../icons/realidad-aumentada.svg" height="30px" class="pl-2" alt="icono_plaga"></a></p>
                </div>

                <div class="col-12">
                    <p class="text mx-3"><strong>Pasos a seguir</strong>: <br>'.nl2br($view['pasosTratamiento']).'</p>
                </div>    

            </div>
        
    </div>'; 
    }
    
    if ($total>5) {  
    echo
    '<section class="row">
        <div class="col-auto mx-auto mt-5">
            <ul class="pagination ">';
                
                if ($pagina!=1) {
                    echo 
                    '<li class="page-item">
                        <a class="page-link" href="cultivo.html?pagina='.($pagina-1).'">Anterior</a>
                    </li>';
                }else{
                    echo 
                    '<li class="page-item disabled">
                        <a class="page-link">Anterior</a>
                    </li>';
                }

                echo'
                ';

            for ($i=1; $i <= $npage ; $i++) { 
                if ($pagina!=$i) {
                    echo'<li class="page-item"><a class="page-link" href="cultivo.html?pagina='.$i.'">'.$i.'</a></li>';
                }else{
                    echo'<li class="page-item"><a class="page-link bg-orange text-white" href="cultivo.html?pagina='.$i.'">'.$i.'</a></li>';
                }
            }

            if ($pagina!=$npage) {
                echo 
                '<li class="page-item">
                    <a class="page-link" href="cultivo.html?pagina='.($pagina+1).'">Siguiente</a>
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