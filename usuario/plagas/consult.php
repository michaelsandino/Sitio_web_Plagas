<?php

include("../../connect.php");

$id_cultivo = $_POST['id_cultivo'];
$idUsuCultivo = $_POST['idUsuCultivo'];

$consult="SELECT * FROM cultivo c,plagas p WHERE c.idUsuCultivo='$idUsuCultivo' AND c.idcultivo='$id_cultivo' AND p.id_cultivo='$id_cultivo'";
$result = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

while($view = mysqli_fetch_array($result))
{
    echo 
    '<div class="col-12 border rounded pt-0 pb-2 pl-0 pr-0">

        <p class="text bg-orange text-white pl-3" style="height: 31px; font-size:20px;">'.$view['nombreT_plagas'].'</p>

        <div class="row">

            <div class="col-12">
                <p class="text text-left mx-3"><strong>Tipo:</strong> '.$view['tp_plaga'].' <br> 
                <strong>Nombre científico:</strong> '.$view['nombreC_plagas'].'</p>
            </div>

            <div class="col-12">
                <p class="text mx-3">'.$view['Descp_plagas'].'</p>
                
                <button class="btn btn-light border boton" type="button" data-toggle="collapse" data-target="#img'.$view['id_plagas'].'" aria-expanded="false" aria-controls="collapseExample">
                    Ver imagenes
                </button>
                
                <div class="collapse center_container" id="img'.$view['id_plagas'].'">
          
                <img src="plagas_img/'.$view['imagen_u'].'" class="plag_image" alt="imagen_plaga">
                <img src="plagas_img/'.$view['imagen_d'].'" class="plag_image" alt="imagen_plaga">
                <img src="plagas_img/'.$view['imagen_t'].'" class="plag_image" alt="imagen_plaga">
                <img src="plagas_img/'.$view['imagen_c'].'" class="plag_image" alt="imagen_plaga">
        
                </div>
            </div>

        </div>


        <div class="btn-group edit position-absolute">
        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Opciones
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="actualizar.html?plaga='.$view['id_plagas'].'"><img src="../../icons/flechas-circulares.svg" alt="icono_borrar" class="pr-2" height="20px">Actualizar</a>
            <button class="dropdown-item" onclick="eliminar('.$view['id_plagas'].');"><img src="../../icons/borrar.svg" alt="icono_borrar" class="pr-1" height="20px"> Eliminar</button>
            <a class="dropdown-item" href="../tratamientos/?plaga='.$view['id_plagas'].'"><img src="../../icons/corazon.svg" alt="icono_tratamiento" class="pr-2" height="20px">Tratamientos</a>
        </div>
        </div>

    </div>';
}

include("../../disconnect.php");


?>