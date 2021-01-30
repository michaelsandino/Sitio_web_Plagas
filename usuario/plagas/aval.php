<?php 

    include("../../connect.php");

    session_start();
    ob_start();

    $idUsuCultivo = $_SESSION['user'];

    $id_plagas = $_POST['id_plagas'];
    $id_cultivo = $_POST['id_cultivo'];
    date_default_timezone_set("America/Bogota");
    $fechaActual = date('d-m-Y');

    /* Consultar si el cultivo al que pertenece ya cuenta con una solicitud */ 
    $review="SELECT * FROM solicitud_proyecto s, cultivo c, plagas p WHERE s.id_cultivofk='$id_cultivo' AND c.idCultivo='$id_cultivo' AND p.id_cultivo='$id_cultivo' AND p.id_plagas='$id_plagas' AND c.idUsuCultivo='$idUsuCultivo' ORDER BY s.id_SolicP DESC LIMIT 1";    
    $review = mysqli_query($connect,$review) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

    /* Permite saber cuantas filas tiene la consulta*/
    $check=mysqli_fetch_row($review);
    
    if (!$check) {
        echo '<div class="alert alert-danger text-center mt-3" role="alert">
        La solicitud no ha sido enviada debido a que el cultivo al que pertenece la plaga seleccionada requiere de tener una solicitud de aval.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>'; 

    }else{

        $estado = $check[4];

        if ($estado=='Revisión') {
            echo '<div class="alert alert-danger text-center mt-3" role="alert">
            La solicitud no ha sido enviada debido a que el cultivo al que pertenece la plaga seleccionada cuenta con una solicitud en revisión, debe esperar a que esta sea procesada.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>'; 
        }else if($estado=='Rechazado'){
            echo '<div class="alert alert-danger text-center mt-3" role="alert">
            La solicitud no ha sido enviada debido a que el cultivo al que pertenece la plaga seleccionada cuenta con una solicitud que ha sido rechazada, debe enviar nuevamente una solicitud de aval del cultivo.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>'; 
        }else{
            $id_solicitud_cultivo = $check[0];

            /* Actualizar el estado de la solicitud del cultivo al que pertenecen */
            $cultivo_update="UPDATE solicitud_proyecto SET stado_sp='En espera' WHERE id_cultivofk='$id_cultivo' AND id_solicP='$id_solicitud_cultivo'";
            $cultivo_update = mysqli_query($connect,$cultivo_update) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error.</div>');

            /* Actualizar el estado de la plaga */
            $update = "UPDATE plagas SET stado_p='En espera' WHERE id_plagas='$id_plagas'";
            $update = mysqli_query($connect,$update) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error.</div>');

            /* Registrar la solicitud */
            $insert = "INSERT INTO solicitud_plaga value(null,'$id_plagas','$fechaActual',null,'En espera',null,null)";
            $result = mysqli_query($connect,$insert) or die ('<div class="alert alert-danger text-center mt-3" role="alert">Ha ocurrido un error.</div>');
            
            if($result){
                echo '<div class="alert alert-success text-center mt-3" role="alert">
                Solicitud de aval con éxito - Se actualizara dentro un momento el listado de Plagas. 
                </div>';
            }
            

        }

        
  
    }

    include("../../disconnect.php");

?>