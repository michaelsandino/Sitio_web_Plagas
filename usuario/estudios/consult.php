<?php

    include("../../connect.php");

    $id_usu = $_POST['id_usu'];

    $consult="SELECT * FROM formacionapp WHERE id_usu='$id_usu'";  
    $result = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

    while($view = mysqli_fetch_array($result))
    {
        echo 
        '<div class="col-12 border rounded pt-2 pb-2">
        <p class="text">
        Nivel: '.$view['nivelFormativo'].'<br>
        Titulo: '.$view['tituloFormacion'].'<br>
        Institución: '.$view['entidadEducativa'].'<br>
        Fecha de grado: '.$view['fechaGrado'].'
        </p>
        <a class="text-primary" href="./estudios_pdf/'.$view['soporte'].'">Soporte...<img src="../../icons/nube-carga.svg" alt="icono_soporte" class="pl-2" height="20px"></a>

        <a href="actualizar.html?estudio='.$view['idFormacion'].'" class="btn btn-success btn-sm edit position-absolute mt-2 mr-3"><img src="../../icons/ajustes-blanco.svg" alt="icono_editar" height="25px" class="py-1 px-1"></a>
        <button class="btn btn-danger btn-sm clear position-absolute mb-2 mr-3" onclick="eliminar('.$view['idFormacion'].');"><img src="../../icons/borrar-blanco.svg" alt="icono_borrar" height="25px" class="py-1 pl-1"></button>
        </div>';
    }
    include("../../disconnect.php");

?>