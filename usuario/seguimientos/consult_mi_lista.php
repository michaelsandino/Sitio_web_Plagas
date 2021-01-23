<?php 

include("../../connect.php");

    session_start();
    ob_start();

    $user_email = $_SESSION['user']; 
    $user_rol = $_SESSION['rol'];

    if ($user_rol == 'Admi') {

        $estado="En espera";

        /* se consulta el estado de la solicitud con referencia al cultivo */

        $consult="SELECT * FROM solicitud_proyecto s, cultivo c, usuarioapp u WHERE s.id_cultivofk = c.idCultivo AND c.idUsuCultivo= u.email ORDER BY s.fech_ini ASC";  
        $result = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error1</div>');

        $cultivos = $result->num_rows;

        if ($cultivos>0) {

            while($view = mysqli_fetch_array($result)){

                $idCultivo = $view['idCultivo'];

                /* Consultamos el estado del cultivo para saber si la solicitud hace referencia al cultivo */

                $consult1="SELECT * FROM cultivo c, solicitud_proyecto s WHERE c.idCultivo='$idCultivo' AND s.id_cultivofk='$idCultivo' AND s.evaluador_sp='$user_email'";
                $result1 = mysqli_query($connect,$consult1) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error2</div>');

                $check1 = $result1->num_rows;
                if ($check1) {
                    
                    echo' 
                    <p class="text bg-orange text-white pl-3 mb-2" style="height: 31px;"><strong> <img src="../../icons/calendario-blanco.svg" class="pr-1"  alt="icono_usuario" height="20px"> Fecha de Solicitud: '.$view['fech_ini'].'</strong></p>
                    <p class="text px-3 mb-0"><img src="../../icons/usuario.svg" class="pr-1"  alt="icono_usuario" height="20px"> '.$view['nameUsu'].' '.$view['apellidoUsu'].'
                    <br><img src="../../icons/ecologico.svg" class="pr-1"  alt="icono_cultivo" height="20px"> '.$view['nameRegional'].'</br></p>
                    <hr>
                    <p class="subtitle px-3 mb-2">Estado:</p> 
                    <p class="text px-3"><img src="../../icons/aval.svg" class="pr-1"  alt="icono_usuario" height="20px">'.$view['stado_c'].'</p> 
                    <a href="cultivo.php?cultivo='.$view['idCultivo'].'" class="btn btn-light btn-block">Consultar<img src="../../icons/lupa-2.svg" height="25px" class="pl-2" alt="icono_consultar"></a> 
                    ';

                }else{
                    /* Consultamos el estado del la plaga para saber si la solicitud hace referencia al plaga */

                    $consult2="SELECT * FROM cultivo c, plagas p, solicitud_plaga s WHERE c.idCultivo='$idCultivo' and p.id_cultivo='$idCultivo' and p.id_plagas=s.id_plagaSolict and s.evaluador_plag='$user_email'";
                    $result2 = mysqli_query($connect,$consult2) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error3</div>');

                    $check2 = $result2->num_rows;
                    if ($check2) {
                        
                        echo' 
                        <p class="text bg-orange text-white pl-3 mb-2" style="height: 31px;"><strong> <img src="../../icons/calendario-blanco.svg" class="pr-1"  alt="icono_usuario" height="20px"> Fecha de Solicitud: '.$view['fech_ini'].'</strong></p>
                        <p class="text px-3 mb-0"><img src="../../icons/usuario.svg" class="pr-1"  alt="icono_usuario" height="20px"> '.$view['nameUsu'].' '.$view['apellidoUsu'].'
                        <br><img src="../../icons/ecologico.svg" class="pr-1"  alt="icono_cultivo" height="20px"> '.$view['nameRegional'].'</br></p>
                        <hr>
                        <p class="subtitle px-3 mb-2">Estado:</p> 
                        <p class="text px-3"><img src="../../icons/aval.svg" class="pr-1"  alt="icono_usuario" height="20px">'.$view['stado_c'].'</p> 
                        <a href="cultivo.php?cultivo='.$view['idCultivo'].'" class="btn btn-light btn-block">Consultar<img src="../../icons/lupa-2.svg" height="25px" class="pl-2" alt="icono_consultar"></a> 
                        ';

                    }else{
                        /* Consultamos el estado del tratamiento para saber si la solicitud hace referencia al tratamient */
                
                        $consult3="SELECT * FROM cultivo c, plagas p, tratamiento t, solicitud_tratamiento s WHERE c.idCultivo='$idCultivo' and p.id_cultivo='$idCultivo' and p.id_plagas=t.id_plaga and t.idTratamiento=s.id_tatamientos and s.evaluador_T='$user_email'";
                        $result3 = mysqli_query($connect,$consult3) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error4</div>');

                        $check3 = $result3->num_rows;
                        if ($check3) {
                            
                            echo' 
                            <p class="text bg-orange text-white pl-3 mb-2" style="height: 31px;"><strong> <img src="../../icons/calendario-blanco.svg" class="pr-1"  alt="icono_usuario" height="20px"> Fecha de Solicitud: '.$view['fech_ini'].'</strong></p>
                            <p class="text px-3 mb-0"><img src="../../icons/usuario.svg" class="pr-1"  alt="icono_usuario" height="20px"> '.$view['nameUsu'].' '.$view['apellidoUsu'].'
                            <br><img src="../../icons/ecologico.svg" class="pr-1"  alt="icono_cultivo" height="20px"> '.$view['nameRegional'].'</br></p>
                            <hr>
                            <p class="subtitle px-3 mb-2">Estado:</p> 
                            <p class="text px-3"><img src="../../icons/aval.svg" class="pr-1"  alt="icono_usuario" height="20px">'.$view['stado_c'].'</p> 
                            <a href="cultivo.php?cultivo='.$view['idCultivo'].'" class="btn btn-light btn-block">Consultar<img src="../../icons/lupa-2.svg" height="25px" class="pl-2" alt="icono_consultar"></a> 
                            ';
                        }
                    }
                }
            }
        }

    }else{
        echo "invalid_user";
    }


include("../../disconnect.php");
?>
            