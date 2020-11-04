<?php

include("../../connect.php");

$email = $_POST['email'];

$consult="SELECT * FROM cultivo WHERE idUsuCultivo='$email'";  
$result = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

while($view = mysqli_fetch_array($result))
{
    echo 
    '<div class="col-12 border rounded pt-0 pb-2 pl-0 pr-0">

        <p class="text bg-orange text-white pl-3" style="height: 31px; font-size:20px;">'.$view['nameRegional'].'</p>

        <div class="row">
            <div class="col-5 col-lg-4 pr-0">
                <img src="plagas_img/cultivo.jpg" class="w-100 ml-3" alt="imagen_cultivo">
            </div>

            <div class="col-6 col-lg-7">
                <p class="text text-left mx-3">Nombre científicio: <br>'.$view['nameCientifico'].'</p>
            </div>

            <div class="col-12">
                <p class="text mx-3">'.$view['descripCultivo'].'</p>
            </div>

        </div>

        <div class="dropdown edit position-absolute">
        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Opciones
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="actualizar.html?estudio='.$view['idCultivo'].'"><img src="../../icons/flechas-circulares.svg" alt="icono_borrar" class="pr-2" height="20px">Actualizar</a>
            <button class="dropdown-item" onclick="eliminar('.$view['idCultivo'].');"><img src="../../icons/borrar.svg" alt="icono_borrar" class="pr-1" height="20px"> Eliminar</button>
            <a class="dropdown-item" href="plagas.html?estudio='.$view['idCultivo'].'"><img src="../../icons/plaga-2.svg" alt="icono_borrar" class="pr-2" height="20px">Plagas</a>
        </div>
        </div>

        

    </div>';
}
include("../../disconnect.php");





?>