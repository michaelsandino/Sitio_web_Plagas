<?php

include("../../connect.php");

    session_start();
    ob_start();

    $user_email = $_SESSION['user']; 
    $user_rol = $_SESSION['rol']; 

    $id_cultivo = $_POST['id_cultivo'];
    
    if ($user_rol == 'Admi') {

        /* consultar las solicitudes de plagas */
        $consult="SELECT * FROM plagas p, solicitud_plaga s WHERE p.id_cultivo='$id_cultivo' AND p.id_plagas=s.id_plagaSolict GROUP BY s.id_plagaSolict ORDER BY s.fech_iniPlag ASC";
        $result = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');
        
        while($view = mysqli_fetch_array($result))
        {
            $id_plaga=$view['id_plagaSolict'];

            /* Consultamos la información del la ultima solicitud de la plaga */
            $information="SELECT * FROM plagas p, solicitud_plaga s WHERE p.id_plagas='$id_plaga' AND s.id_plagaSolict='$id_plaga' ORDER BY s.id_solicPlag DESC LIMIT 1";
            $information = mysqli_query($connect,$information) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

            while($info = mysqli_fetch_array($information))
            {
                echo 
                '<p class="text bg-orange text-white pl-3 mb-2" style="height: 31px;"><strong> <img src="../../icons/calendario-blanco.svg" class="pr-1"  alt="icono_usuario" height="20px"> Fecha de Solicitud: '.$info['fech_iniPlag'].'</strong></p>
                <p class="text px-3 mb-0"><img src="../../icons/plaga-2.svg" class="pr-1"  alt="icono_usuario" height="20px"> '.$info['nombreT_plagas'].'</br></p>
                <hr>
                <p class="subtitle px-3 mb-2">Estado:</p> 
                <p class="text px-3"><img src="../../icons/aval.svg" class="pr-1"  alt="icono_usuario" height="20px">'.$info['stado_plag'].' 
                ';

                if ($info['evaluador_plag']==$user_email) {
                    echo '- <em class="text-success">En mi lista.</em> </p>';
                }else{
                    echo '</p>';
                }

                echo '<a href="plaga.php?plaga='.$info['id_plagas'].'" class="btn btn-light btn-block">Consultar<img src="../../icons/lupa-2.svg" height="25px" class="pl-2" alt="icono_consultar"></a>';
            }
            
        }
        
    }else{

        echo 'invalid_user';

    }


include("../../disconnect.php");


?>
