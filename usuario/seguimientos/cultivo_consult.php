<?php

    include("../../connect.php");

    session_start();
    ob_start();

    $user_email = $_SESSION['user']; 
    $user_rol = $_SESSION['rol']; 
    $id_cultivo = $_POST['id_cultivo'];

    if ($user_rol == 'Admi') {

        $consult="SELECT * FROM solicitud_proyecto s, cultivo c WHERE s.id_cultivofk='$id_cultivo' AND c.idCultivo='$id_cultivo'";  
        $result = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

        while($view = mysqli_fetch_array($result)){
            
            echo'
            <p class="text bg-orange text-white pl-3" style="height: 31px; font-size:20px;">'.$view['nameRegional'].'</p>
            <a href="solicitudes_plagas.php?cultivo='.$view['idCultivo'].'" class="btn btn-secondary btn-sm edit position-absolute">Plagas <img src="../../icons/lupa.svg" height="18px" class="pl-2" alt="icono_lupa"></a>

                    <div class="row">
                        <div class="col-11 col-md-5 col-lg-4 pr-0">
                        <img src="../cultivos/cultivos_img/'.$view['imagenC'].'" class="w-100 mx-3 mb-2" alt="imagen_cultivo">
                        </div>

                        <div class="col-12 col-md-6 col-lg-7">
                            <p class="text text-left mx-3 mb-0"><strong>Nombre científico: </strong><em>'.$view['nameCientifico'].'</em></p>
                            
                        </div>

                        <div class="col-12">
                            <p class="text mx-3">'.nl2br($view['descripCultivo']).'</p>
                        </div>
                    </div>
            ';

            if ($view['stado_c']=='En espera' AND $view['evaluador_sp']==$user_email) {
                    
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

                                <button type="submit" class="btn btn-success btn-block mt-4" onclick="seguimiento_cultivo();">Guardar</button>
                                
                            </div>
                ';

            }else if($view['stado_c']=='En espera' AND $view['evaluador_sp']!=$user_email AND $view['evaluador_sp']!=null){

                echo'
                <p class="text bg-orange text-white pl-3" style="height: 31px; font-size:20px;">Solicitud en espera</p>
        
                        <div class="col-12">
        
                        <p class="text font-weight-bold">La solicitud se encuentra en revisión.</p>
                        
                        </div>
                ';
                
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
                
            }else{
                echo'
                <p class="text bg-orange text-white pl-3" style="height: 31px; font-size:20px;">Solicutud sin jurado asignado</p>
        
                        <div class="col-12">
        
                            <p class="text font-weight-bold">La solicitud aun no se encuentra en revisión.</p>

                        </div>
                ';
            } 

        }
        
    }else{
        echo'invalid_user';
    }
    

    include("../../disconnect.php");

?>