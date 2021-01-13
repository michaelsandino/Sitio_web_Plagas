<?php

    include("../../connect.php");

    session_start();
    ob_start();

    $user_rol = $_SESSION['rol'];
    $email = $_POST['email'];

    if ($user_rol=='Admi' OR $user_rol=='usuario'){

        $consult="SELECT * FROM solicitud_cuenta WHERE idSolicitante='$email'";  
        $result = mysqli_query($connect,$consult) or die ('<div class="alert mt-3 alert-danger text-center" role="alert">Ha ocurrido un error</div>');

        $check=mysqli_fetch_row($result);
        if (!$check) {
            echo'
            <p class="subtitle h5 text-center text-orange">¿Quieres ser parte del equipo de jurados?</p>
            <p class="text text-center">Es fácil, selecciona la opción quiero ser jurado.</p>
            <hr>
            <p class="subtitle text-orange">Pasos a tener en cuenta:</p>
            <p class="text"><img src="../../icons/verificacion.svg" height="20px" alt="icono_verificado" class="pr-2">Antes de enviar la solicitud verifica que tienes correcta la información del perfil.</p>
            <p class="text"><img src="../../icons/verificacion.svg" height="20px" alt="icono_verificado" class="pr-2">Cuenta con el registro académico debidamente soportado.</p>
            <hr>
            <p class="subtitle text-orange">Respuesta por parte de nuestro equipo:</p>
            <p class="text">Una vez verificada la información de su cuenta, esta pasara hacer de tipo administrativo y podras avalar la información de diversas investigaciones relacionadas a cultivos, plagas, enfermedades y tratamientos.</p>
            <div id="#progress-jurado"></div>
            <button type="submit" class="btn btn-success btn-block mt-4" onclick="jurado()"><img src="../../icons/jurado-blanco.svg" height="20px" class="pr-2" alt=""> QUIERO SER JURADO</button>
            ';
        }else{
            $stado_s = $check[2]; 
            if ($stado_s=="Revisión") {
                echo'
                <p class="subtitle h5 text-center text-orange">Solicitud en revisión</p>
                <img src="../../img/revision.svg" alt="ilustración_revición" class="center-img w-75">
                <p class="text text-center">Cordial saludo querido usuario, su solicitud se encuentra en proceso, esperamos dar solución cuanto antes a su requerimiento.</p>
                ';
            }
            if ($stado_s=="Rechazado") {
                $Nota_s = $check[3];
                echo'
                <p class="subtitle h5 text-center text-orange">Solicitud denegada</p>
                <hr>
                <p class="subtitle text-orange">Pasos a tener en cuenta:</p>
                <p class="text"><img src="../../icons/verificacion.svg" height="20px" alt="icono_verificado" class="pr-2">Antes de enviar la solicitud nuevamente verifica que tienes correcta la información del perfil.</p>
                <p class="text"><img src="../../icons/verificacion.svg" height="20px" alt="icono_verificado" class="pr-2">Verifica que cuenta con el registro académico debidamente soportado.</p>
                <hr>
                <p class="subtitle text-orange">Reporte:</p>
                <p class="text">'.nl2br($Nota_s).'</p>
                <div id="#progress-jurado"></div>
                <button type="submit" class="btn btn-success btn-block mt-4" onclick="repeat_jurado()"><img src="../../icons/jurado-blanco.svg" height="20px" class="pr-2" alt=""> QUIERO SER JURADO</button>
                ';
            }
            if ($stado_s=="Admitido") {
                $Nota_s = $check[3];
                echo'
                <p class="subtitle h5 text-center text-orange">Felicitaciones su cuenta fue validada con éxito</p>
                <p class="text text-center ">Ahora haces parte de nuestro equipo de jurados.</p>
                <hr>
                <p class="subtitle text-orange">Recuerda:</p>
                <p class="text"><img src="../../icons/verificacion.svg" height="20px" alt="icono_verificado" class="pr-2">Para iniciar el proceso de verificación de información de los investigadores deben ir a la opción "Seguimientos" la cual hace parte del menú. 
                <br> <strong>En caso de no visualizar la opción de seguimientos en el menu, cierre sesión e ingrese nuevamente.</strong></p>
                <p class="text"><img src="../../icons/verificacion.svg" height="20px" alt="icono_verificado" class="pr-2">Solo se puede realizar un seguimiento por investigación al tiempo.</p>
                <p class="text"><img src="../../icons/verificacion.svg" height="20px" alt="icono_verificado" class="pr-2">Recuerda que la información que valides podra ser vista por todos los usuarios que tengan instalada la App y que tu eres el representante del aval, mas no la app.</p>
                
                <p class="subtitle text-orange">Nota:</p>
                <p class="text">'.nl2br($Nota_s).'</p>
            
                <hr>
                <p class="text text-center"> <img src="../../icons/felicitaciones.svg" height="20px" alt="icono_verificado" class="pr-2"> Gracias por confiar en nosotros <img src="../../icons/felicitaciones.svg" height="20px" alt="icono_verificado" class="pl-2"></p>
                ';
            }
        }
    }else{
        echo'invalid_user';
    }

    


    include("../../disconnect.php");

?>