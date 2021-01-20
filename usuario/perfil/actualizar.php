<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta Tags -->
    <meta name="title" content="Plagas APP">
    <meta name="description" content="Aplicación para la detección de plagas en cultivos, Desarrollado por SENNOVA.">

    <meta name="og:title" content="Actualizar | Plagas APP">
    <meta name="og:description" content="Panel de control de usuarios logueados">
    <meta name="og:type" content="website">
    <meta name="og:url" content="https://plagas-app.netlify.app/usuario/Actualizar">
    <meta name="og:image" content="../../img/logo.jpg">
    <meta name="og:site_name" content="Plagas APP - Detector de plagas">
   
    <!-- Tipografia -->
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,400&family=Open+Sans:wght@700&display=swap" rel="stylesheet" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="../../css/style.css" />
    <link rel="stylesheet" href="../../css/bootstrap.css" />
    
    <!-- Icono -->
    <link rel="icon" type="image/svg" href="../../img/logo.svg">

    <title>Perfil | Plagas APP</title>

</head>
<body>

    <header class="container-fluit fixed-top">
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand subtitle" href="#">
                <img src="../../img/logo.svg" height="35px" alt="logo" loading="lazy">
                Plagas APP</a>
            <?php
            include '../menu.php';
            ?>
        </nav>
    </header>


    <div class="container">

        <section class="row">
            
            <div class="col-12">
                <h1 class="text-center h4 title">Actualizar</h1>
                <div id="success-message"></div>
            </div>

            <div class="col-sm-12 col-md-8 col-lg-6 mx-auto">

                <div id="progress"></div>
                
                <form name="update" id="p_update">
                    <div class="form-group">
                        <label for="email">Correo</label>
                        <input type="text" class="form-control" id="email" name="email" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombres</label>
                        <input type="text" class="form-control nombre_color" id="nombre" name="nombre">
                        <small class="form-text text-danger" id="nombre_error"></small>
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellidos</label>
                        <input type="text" class="form-control apellido_color" id="apellido" name="apellido">
                        <small class="form-text text-danger" id="apellido_error"></small>
                    </div>
                    <div class="form-group">
                        <label for="ti">Tipo de Identificación</label>
                        <select class="form-control ti-color" id="ti" name="ti">
                        <option>CC</option>
                        <option>TI</option>
                        </select>
                        <small class="form-text text-danger" id="ti_error"></small>
                    </div>
                    <div class="form-group">
                        <label for="ni">Numero de identidad</label>
                        <input type="text" class="form-control ni_color" id="ni" name="ni">
                        <small class="form-text text-danger" id="ni_error"></small>
                    </div>
                    <div class="form-group">
                        <label for="fechanacimiento">Fecha de nacimiento</label>
                        <input type="date" class="form-control fechanacimiento_color" id="fechanacimiento" name="fechanacimiento">
                        <small class="form-text text-danger" id="fechanacimiento_error"></small>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Número Telefonico</label>
                        <input type="text" class="form-control telefono_color" id="telefono" name="telefono">
                        <small class="form-text text-danger" id="telefono_error"></small>
                    </div>

                    <a href="../perfil" class="btn btn-secondary mt-2" style="width: 49%;">cancelar</a>
                    <button type="submit" class="btn btn-success mt-2 float-right" style="width: 49%;">Actualizar</button>
  
                </form>

                <div id="message"></div>
            </div>

        </section>

    </div>


     <!-- FOOTER - PIE DE PAGINA -->
    <footer class="footer">
        <div class="container">

            <section class="row">

                <div class="col-7 col-sm-6 col-md-4  pb-3">
                    ENLACES RAPIDOS
                    <ul class="text-left">
                        <li><a href="https://www.sena.edu.co/es-co/Paginas/default.aspx" target="_blank" >SENA</a></li>
                        <li><a href="https://www.sena.edu.co/es-co/formacion/Paginas/tecnologia-innovacion.aspx" target="_blank">SENNOVA</a></li>
                        <li><a href="../../identidad_visual">Identidad Visual</a></li>
                    </ul>  
                </div>

                <div class="col-12 col-sm-6 col-md-4 pb-3">
                    DESCARGAR APP
                    <a href="#"><img src="../../img/google-play.png" alt="Insignia_Google-Play" class="download-app"></a>
                </div>

                <div class="col-12 col-md-4">
                    <img src="../../img/sena_sennova-white.svg" alt="logo_Sena&Sennova" class="center-img" style="width: 217px;">
                </div>

                <div class="col-12">
                    <hr class="bg-gray">
                    <!-- REDES SOCIALES -->
                    <!-- <a href="#" class=""><img src="icons/planeta.svg" alt="#" class="icon-social-media "></a>
                    <a href="#" class=""><img src="icons/planeta.svg" alt="#" class="icon-social-media "></a>
                    <a href="#" class=""><img src="icons/planeta.svg" alt="#" class="icon-social-media "></a> -->
                    <p class="attributions">
                        Iconos diseñados por <a href="https://www.flaticon.es/autores/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.es/" title="Flaticon">www.flaticon.es</a>
                        <br>Sitio Web hecho con: <a href="https://getbootstrap.com/"  target="_blank">Bootstrap V4.5</a>
                    </p>
                </div>

            </section>
        </div>
    </footer>

    <!-- <a href="#" class="go-up"> <img src="../icons/flecha-boton.svg" alt="flecha_boton" class="arrow white-icon"> </a> -->

    <script src="../../js/jquery-3.5.1.slim.min.js"></script>
    <script src="../../js/popper.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>

    <!-- Firebase  -->
    <script src="https://www.gstatic.com/firebasejs/7.22.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.22.0/firebase-firestore.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.22.0/firebase-analytics.js"></script>

    <!-- Sistema de autenticación -->
    <script src="https://www.gstatic.com/firebasejs/7.22.0/firebase-auth.js"></script>

    <!-- Credenciales de firebase -->
    <script src="../../js/firebase.js"></script>

    <!-- Autenticación -->
    <script src="../../js/observer.js"></script>

    <!-- AJAX -->
    <script src="../ajax/jquery-3.5.1.min.js"></script>
    <script src="../ajax/perfil.js"></script>

</body>
</html>