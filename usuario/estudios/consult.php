<?php

    include("../../connect.php");

    session_start();
    ob_start();

    $user_rol = $_SESSION['rol'];
    $id_usu = $_POST['id_usu'];

    if ($user_rol=='Admi' OR $user_rol=='usuario'){

        $consult="SELECT * FROM formacionapp WHERE id_usu='$id_usu'";  
        $result = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');
    
        while($view = mysqli_fetch_array($result))
        {
            echo 
            '<div class="col-12 border rounded pt-2 pb-2">
            <p class="text">
            <strong>Nivel:</strong> '.$view['nivelFormativo'].'<br>
            <strong>Titulo:</strong> '.$view['tituloFormacion'].'<br>
            <strong>Institución:</strong> '.$view['entidadEducativa'].'<br>
            <strong>Fecha de grado:</strong> '.$view['fechaGrado'].'
            </p>
            <a class="text-primary" href="./estudios_pdf/'.$view['soporte'].'">Soporte...<img src="../../icons/nube-carga.svg" alt="icono_soporte" class="pl-2" height="20px"></a>
    
            <a href="actualizar.php?estudio='.$view['idFormacion'].'" class="btn btn-success btn-sm edit position-absolute mt-2 mr-3"><img src="../../icons/ajustes-blanco.svg" alt="icono_editar" height="25px" class="py-1 px-1"></a>
            <button class="btn btn-danger btn-sm clear position-absolute mb-2 mr-3" onclick="eliminar('.$view['idFormacion'].');"><img src="../../icons/borrar-blanco.svg" alt="icono_borrar" height="25px" class="py-1 pl-1"></button>
            </div>';
        }

    }else{
    echo'invalid_user';
    }



    include("../../disconnect.php");

?>