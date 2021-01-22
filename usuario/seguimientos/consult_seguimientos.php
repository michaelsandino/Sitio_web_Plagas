<?php 

include("../../connect.php");

    session_start();
    ob_start();

    $user_email = $_SESSION['user']; 
    $user_rol = $_SESSION['rol'];

    if ($user_rol == 'Admi') {

        $estado="En espera";

        /* se consulta el estado de la solicitud con referencia al cultivo */

        $consult="SELECT * FROM solicitud_proyecto s, cultivo c, usuarioapp u WHERE s.id_cultivofk = c.idCultivo AND c.idUsuCultivo= u.email AND c.idUsuCultivo!='$user_email' AND s.stado_sp='$estado' ORDER BY s.fech_ini DESC";  
        $result = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

        $cultivos = $result->num_rows;

        if ($cultivos>0) {

            while($view = mysqli_fetch_array($result)){

                echo' 
                <p class="text bg-orange text-white pl-3 mb-2" style="height: 31px;"><strong> <img src="../../icons/calendario-blanco.svg" class="pr-1"  alt="icono_usuario" height="20px"> Fecha de Solicitud: '.$view['fech_ini'].'</strong></p>

                <p class="text px-3 mb-0"><img src="../../icons/usuario.svg" class="pr-1"  alt="icono_usuario" height="20px"> '.$view['nameUsu'].' '.$view['apellidoUsu'].'
                <br><img src="../../icons/ecologico.svg" class="pr-1"  alt="icono_usuario" height="20px"> '.$view['nameRegional'].'</br></p> 
                <hr>
                <p class="subtitle px-3 mb-2">Tipo de solicitud:</p> 
                ';

                $idCultivo = $view['idCultivo'];

                /* Consultamos el estado del cultivo para saber si la solicitud hace referencia al cultivo */

                $consult1="SELECT * FROM cultivo WHERE idCultivo='$idCultivo' and stado_c='$estado'";
                $result1 = mysqli_query($connect,$consult1) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

                $check1 = $result1->num_rows;
                if ($check1) {
                    echo'<p class="text px-3 mb-1"><img src="../../icons/ecologico.svg" class="pr-1"  alt="icono_usuario" height="20px">Cultivo</p>';
                }

                /* Consultamos el estado del la plaga para saber si la solicitud hace referencia al plaga */

                $consult2="SELECT * FROM cultivo c, plagas p WHERE c.idCultivo=p.id_cultivo and c.idCultivo='$idCultivo' and p.stado_p='$estado'";
                $result2 = mysqli_query($connect,$consult2) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

                $check2 = $result2->num_rows;
                if ($check2) {
                    if ($check2>1) {
                        echo'<p class="text px-3 mb-1"><img src="../../icons/plaga-2.svg" class="pr-1"  alt="icono_usuario" height="20px">Plaga | '.$check2.'</p>';
                    }else{
                        echo'<p class="text px-3 mb-1"><img src="../../icons/plaga-2.svg" class="pr-1"  alt="icono_usuario" height="20px">Plaga</p>';
                    }      
                }

                /* Consultamos el estado del tratamiento para saber si la solicitud hace referencia al tratamient */
                
                $consult3="SELECT * FROM cultivo c, plagas p, tratamiento t WHERE c.idCultivo=p.id_cultivo and c.idCultivo='$idCultivo' and p.id_plagas=t.id_plaga and t.stado_t='$estado'";
                $result3 = mysqli_query($connect,$consult3) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

                $check3 = $result3->num_rows;
                if ($check3) {
                    if ($check3>1) {
                        echo'<p class="text px-3 mb-1"><img src="../../icons/corazon.svg" class="pr-1"  alt="icono_usuario" height="20px">Tratamiento | '.$check3.'</p>';
                    }else{
                        echo'<p class="text px-3 mb-1"><img src="../../icons/corazon.svg" class="pr-1"  alt="icono_usuario" height="20px">Tratamiento</p>';
                    }
                }

                echo'<button type="submit" class="btn btn-light btn-block mt-2" onclick="añadir('.$idCultivo.')">Añadir a mi lista<img src="../../icons/agregar.svg" height="25px" class="pl-2" alt="icono_añadir"></button>';

            }
        }

        
    }else{
        echo "invalid_user";
    }

 

include("../../disconnect.php");
?>
            