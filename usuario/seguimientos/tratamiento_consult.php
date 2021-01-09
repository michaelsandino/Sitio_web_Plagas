<?php

    include("../../connect.php");

    session_start();
    ob_start();

    $user_email = $_SESSION['user']; 
    $user_rol = $_SESSION['rol']; 
    $idTratamiento = $_POST['idTratamiento'];

    $consult="SELECT * FROM solicitud_tratamiento s, tratamiento t WHERE s.evaluador_T='$user_email' AND s.id_tatamientos='$idTratamiento' AND t.idTratamiento='$idTratamiento'";  
    $result = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

    $check = $connect->affected_rows;

    if ($check AND $user_rol == 'Admi') {

        while($view = mysqli_fetch_array($result)){
            
            echo'
            <p class="text bg-orange text-white pl-3" style="height: 31px; font-size:20px;">'.$view['nameTrata'].'</p>

                    <div class="row">

                    <div class="col-12">
                        <p class="text text-left mx-3"><strong>Tipo de tratamiento</strong>: <br>'.$view['tipoTratamiento'].'</p>
                    </div>

                    <div class="col-12">
                        <p class="text mx-3"><strong>Pasos a seguir</strong>: <br>'.nl2br($view['pasosTratamiento']).'</p>
                    </div>    
                    </div>
            ';

            if ($view['stado_t']=='En espera') {
                    
                echo'
                <p class="text bg-orange text-white pl-3" id="nameR" style="height: 31px; font-size:20px;">Validar información</p>

                            <div class="col-12">

                                <p class="text font-weight-bold">¿El tratamiento cumple con la información necesaria para dar el aval?</p>

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
                                <textarea class="form-control nota_color" id="nota" rows="3" name="nota"></textarea>
                                <small class="form-text text-danger" id="nota_error"></small>

                                <button type="submit" class="btn btn-success btn-block mt-4" onclick="seguimiento_tratamiento();">Guardar</button>
                                
                            </div>
                ';

            }else{
                echo'
                <p class="text bg-orange text-white pl-3" style="height: 31px; font-size:20px;">Información Aval</p>
        
                        <div class="col-12">
        
                        <p class="text px-3 mb-3"><strong>Estado: </strong>'.$view['stado_T'].'.
                        <br><strong>Nota: </strong>'.$view['nota_T'].'
                        <br><strong>Evaluador: </strong>'.$view['evaluador_T'].'
                        <br><strong>Fecha: </strong>'.$view['fech_finT'].'
                        </p>
                        </div>
                ';
            } 

        }
        
    }else{
        echo'invalid_user';
    }
    

    include("../../disconnect.php");

?>