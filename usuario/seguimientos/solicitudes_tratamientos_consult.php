<?php

include("../../connect.php");

    session_start();
    ob_start();

    $user_email = $_SESSION['user']; 
    $user_rol = $_SESSION['rol']; 

    $id_plaga = $_POST['id_plaga'];
    

    if ($user_rol == 'Admi') {

        /* consultar las solicitudes de tratamientos */
        $consult="SELECT * FROM tratamiento t, solicitud_tratamiento s WHERE t.id_plaga='$id_plaga' AND t.idTratamiento=s.id_tatamientos GROUP BY s.id_tatamientos ORDER BY s.fech_iniT ASC";
        $result = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');
        
        while($view = mysqli_fetch_array($result))
        {
            $id_tratamiento=$view['id_tatamientos'];
            
            /* Consultamos la información del la ultima solicitud del tratamiento */
            $information="SELECT * FROM tratamiento t, solicitud_tratamiento s WHERE t.idTratamiento='$id_tratamiento' AND s.id_tatamientos='$id_tratamiento' ORDER BY s.id_solicT DESC LIMIT 1";
            $information = mysqli_query($connect,$information) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

            while($info = mysqli_fetch_array($information))
            {
                echo 
                '<p class="text bg-orange text-white pl-3 mb-2" style="height: 31px;"><strong> <img src="../../icons/calendario-blanco.svg" class="pr-1"  alt="icono_usuario" height="20px"> Fecha de Solicitud: '.$info['fech_iniT'].'</strong></p>
                <p class="text px-3 mb-0"><img src="../../icons/corazon.svg" class="pr-1"  alt="icono_usuario" height="20px"> '.$info['nameTrata'].'</br></p>
                <hr>
                <p class="subtitle px-3 mb-2">Estado:</p> 
                <p class="text px-3"><img src="../../icons/aval.svg" class="pr-1"  alt="icono_usuario" height="20px">'.$info['stado_T'].'
                ';

                if ($info['evaluador_T']==$user_email) {
                    echo '- <em class="text-success">En mi lista.</em> </p>';
                }else{
                    echo '</p>';
                }

                echo '<a href="tratamiento.php?tratamiento='.$info['idTratamiento'].'" class="btn btn-light btn-block">Consultar<img src="../../icons/lupa-2.svg" height="25px" class="pl-2" alt="icono_consultar"></a> ';
            }
        }
        
    }else{

        echo 'invalid_user';

    }


include("../../disconnect.php");


?>
