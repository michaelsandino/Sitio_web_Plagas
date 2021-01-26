<?php

    include("../../connect.php");

    session_start();
    ob_start();

    $user_rol = $_SESSION['rol']; 
    $email = $_POST['solicitud']; 

    if ($user_rol=='Administrador') {

        $consult="SELECT * FROM usuarioapp u,solicitud_cuenta s WHERE u.email='$email' AND s.idSolicitante='$email' AND u.tpUsuario='usuario' AND s.stado_s='Revisión'";  
        $result = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

        /* Permite saber la cantidad de filas afectas por la ultima consulta, delete o update. */
        $check = $connect->affected_rows;

        if($check){

            while($view = mysqli_fetch_array($result))
            {
                echo '
                <div class="col-12 border rounded pt-0 pl-0 pr-0">

                <p class="text bg-orange text-white pl-3 mb-3" style="height: 31px;"><strong>Información Personal</strong></p>

                    <div class="form-group px-3">
                        <p class="d-inline w-100"><img src="../../icons/correo.svg" class="mr-3" alt="icono_correo" width="25px"><div class="d-inline">'.$view['email'].'</div></p>
                        <p class="d-inline w-100"><img src="../../icons/perfil.svg" class="mr-3" alt="icono_perfil" width="25px"><div style="display: inline;">'.$view['nameUsu'].' '.$view['apellidoUsu'].'</div></p>
                        <p class="d-inline w-100"><img src="../../icons/identificacion.svg" class="mr-3" alt="icono_identificacion" width="25"><div class="d-inline">'.$view['tp_id'].' '.$view['identidad'].'</div></p> 
                        <p class="d-inline w-100"><img src="../../icons/calendario-naranja.svg" class="mr-3" alt="icono_fecha" width="25"><div class="d-inline">'.$view['fechanacimiento'].'</div></p> 
                        <p class="d-inline w-100"><img src="../../icons/celular.svg" class="mr-3" alt="icono_celular" width="25"><div class="d-inline">'.$view['telefono'].'</div></p> 
                    </div>

                <p class="text bg-orange text-white pl-3 mt-4 mb-0" style="height: 31px;"><strong>Formación Académica</strong></p>
                </div>
                ';
            }

        
        $consult="SELECT * FROM formacionapp f WHERE id_usu='$email'";  
        $result = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

            while($view = mysqli_fetch_array($result))
            {
                echo '
                <div class="col-12 border rounded pt-2 pb-2">

                <p class="text">
                <strong>Nivel:</strong> '.$view['nivelFormativo'].'<br>
                <strong>Titulo:</strong> '.$view['tituloFormacion'].'<br>
                <strong>Institución:</strong> '.$view['entidadEducativa'].'<br>
                <strong>Fecha de grado:</strong> '.$view['fechaGrado'].'
                </p>
                <a class="text-primary" href="../estudios/estudios_pdf/'.$view['soporte'].'">Soporte...<img src="../../icons/nube-carga.svg" alt="icono_soporte" class="pl-2" height="20px"></a>
                </div>
            
                </div>
                
                ';
            }
        
        echo '

        <button data-toggle="modal" data-target="#modal" class="btn btn-light border btn-block">Validar información<img src="../../icons/jurado.svg" height="20px" class="pl-2" alt="validar"></button>
        
            <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title title pt-0 w-100 text-center" id="exampleModalLabel">Validar Información</h5>
                    <button type="button" class="close position-absolute" data-dismiss="modal" aria-label="Close" style="right: 20px;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="nameR">¿El usuario cumple con la información necesaria para vincularlo como jurado en nuestro sistema?</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="cumplimiento" id="option1" value="si">
                                    <label class="form-check-label cumplimiento_color" for="option1">
                                        Si
                                    </label>
                                    </div>
                                    <div class="form-check">
                                    <input class="form-check-input" type="radio" name="cumplimiento" id="option2" value="no">
                                    <label class="form-check-label cumplimiento_color" for="option2">
                                        No
                                    </label>
                                </div>
                                <small class="form-text text-danger" id="cumplimiento_error"></small>
                            </div>
                            
                            <div class="form-group">
                                <label for="nota">Nota</label>
                                <textarea class="form-control" id="nota" rows="3" name="nota"></textarea>
                            </div>
                            <div id="message"></div>
                            
                            <button type="submit" id="btn_enviar" class="btn btn-success btn-block mt-4" onclick="solicitud();">Guardar</button>
                            
                    </div>
                </div>
                </div>
            </div>
        
        ';

        }else{
            echo'solicitud_invalida';
        }
        
            
        
    }else{
        echo'invalid_user';
    }

    

    include("../../disconnect.php");

?>