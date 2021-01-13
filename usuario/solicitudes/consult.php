<?php

    include("../../connect.php");

    session_start();
    ob_start();

    $user_rol = $_SESSION['rol']; 

    if ($user_rol=='Administrador') {

        $consult="SELECT * FROM solicitud_cuenta s,usuarioapp u WHERE s.idSolicitante=u.email AND s.stado_s='Revisión'";  
        $result = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

            while($view = mysqli_fetch_array($result))
            {
            echo '
                <div class="col-12 border rounded pt-0 pl-0 pr-0">
                
                <p class="text bg-orange text-white pl-3 mb-2" style="height: 31px;"><strong> <img src="../../icons/usuario-blanco.svg" class="pr-2"  alt="icono_usuario" height="20px">'.$view['nameUsu'].' '.$view['apellidoUsu'].'</strong></p>

                        <div class="row pb-0 mb-0">

                            <div class="col-12">    
                                <p class="text px-3 mb-0"><img src="../../icons/email.svg" class="pr-1"  alt="icono_email" height="20px"> '.$view['email'].'</p>
                                <hr> 
                                <a type="submit" class="btn btn-light btn-block" href="info.php?solicitud='.$view['email'].'">Verificar información<img src="../../icons/lupa-2.svg" height="25px" class="pl-2" alt="icono_consultar"></a>
                            </div>

                        </div>

                </div>
                ';
            }
        
    }else{
        echo'invalid_user';
    }

    

    include("../../disconnect.php");

?>