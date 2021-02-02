<?php

    include("../../connect.php");

    session_start();
    ob_start();

    $user_email = $_SESSION['user']; 
    $user_rol = $_SESSION['rol']; 
    $id_cultivo = $_POST['id_cultivo'];

    if ($user_rol == 'Admi') {

        /* Consultar información del cultivo */
        $consult="SELECT * FROM solicitud_proyecto s, cultivo c WHERE s.id_cultivofk='$id_cultivo' AND c.idCultivo='$id_cultivo' ORDER BY s.id_solicP DESC LIMIT 2";  
        $result = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

        $total = $result->num_rows;

        while($view = mysqli_fetch_array($result)){
            
            echo'
            <p class="text bg-orange text-white pl-3" style="height: 31px; font-size:20px;">'.$view['nameRegional'].'</p>
            <a href="solicitudes_plagas.php?cultivo='.$view['idCultivo'].'" class="btn btn-secondary btn-sm edit position-absolute">Plagas <img src="../../icons/lupa.svg" height="18px" class="pl-2" alt="icono_lupa"></a>

                    <div class="row">
                        <div class="col-11 col-md-5 col-lg-4 pr-0">
                        <img src="../cultivos/'.$view['imagenC'].'" class="w-100 mx-3 mb-2" alt="imagen_cultivo">
                        </div>

                        <div class="col-12 col-md-6 col-lg-7">
                            <p class="text text-left mx-3 mb-0"><strong>Nombre científico: </strong><em>'.$view['nameCientifico'].'</em></p>
                            
                        </div>

                        <div class="col-12">
                            <p class="text mx-3">'.nl2br($view['descripCultivo']). '</p>
                        </div>
                    </div>
            ';

            /* Mostrar registro anterior en caso de haber sido rechazado */
            if ($total>1) {
                $previous=mysqli_fetch_row($result);
                $fecha = $previous[3]; 
                $estado = $previous[4]; 
                $nota = $previous[5]; 
                $evaluador = $previous[6]; 
                
                if (($view['stado_c']!='Rechazado' AND $view['stado_c']!='Activo')  AND $view['evaluador_sp']==$user_email) {
                    echo '
                    <p class="text bg-orange text-white pl-3" style="height: 31px; font-size:20px;">Solicitud anterior</p>
                    <div class="col-12">
            
                        <p class="text px-1 mb-3"><strong>Estado: </strong>'.$estado.'.
                        <br><strong>Nota: </strong>'.$nota.'
                        <br><strong>Evaluador: </strong>'.$evaluador.'
                        <br><strong>Fecha: </strong>'.$fecha.'
                        </p>
                            
                    </div>
                    ';
                }
                
            }
            
            /* Formulario para saber si es el usuario es el encargado */
            if (($view['stado_c']!='Rechazado' AND $view['stado_c']!='Activo')  AND $view['evaluador_sp']==$user_email) {
                    
                echo'
                <p class="text bg-orange text-white pl-3" id="nameR" style="height: 31px; font-size:20px;">Validar información</p>

                            <div class="col-12">

                                <p class="text font-weight-bold">¿El cultivo cumple con la información necesaria para dar el aval?</p>

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
                                <br>
                                <label class="font-weight-bold" for="nota">Nota</label>
                                <textarea class="form-control" id="nota" rows="3" name="nota"></textarea>
                                <div id="message"></div>
                                <button type="submit" class="btn btn-success btn-block mt-4" onclick="seguimiento_cultivo('.$view['id_solicP'].');">Guardar</button>
                                
                            </div>
                ';

            /* Mensaje para los usuarios que no son los encargados pero ya se encuentra en revisión. */
            }else if($view['stado_sp']=='Revisión' AND $view['evaluador_sp']!=$user_email AND $view['evaluador_sp']!=null){

                echo'
                <p class="text bg-orange text-white pl-3" style="height: 31px; font-size:20px;">Solicitud en Revisión</p>
        
                        <div class="col-12">
        
                        <p class="text font-weight-bold">La solicitud se encuentra en revisión.</p>
                        
                        </div>
                ';

            /* Información de cuando ya fue revisado una solicitud */
            }else if($view['stado_c']!='En espera'){

                echo'
                <p class="text bg-orange text-white pl-3" style="height: 31px; font-size:20px;">Información Aval</p>
        
                        <div class="col-12">
        
                        <p class="text px-3 mb-3"><strong>Estado: </strong>'.$view['stado_c'].'.
                        <br><strong>Nota: </strong>'.$view['nota_sp'].'
                        <br><strong>Evaluador: </strong>'.$view['evaluador_sp'].'
                        <br><strong>Fecha: </strong>'.$view['fech_fin'].'
                        </p>
                        </div>
                ';

            /* Mensaje cuando no hay ningun jurado encargado de la solicitud */
            }else if($view['stado_sp']=='En espera'){
                echo'
                <p class="text bg-orange text-white pl-3" style="height: 31px; font-size:20px;">Solicutud sin jurado asignado</p>
        
                        <div class="col-12">
        
                            <p class="text font-weight-bold">La solicitud se encuentra en espera.</p>

                        </div>
                ';
            } 

        }
        
    }else{
        echo'invalid_user';
    }
    

    include("../../disconnect.php");

?>