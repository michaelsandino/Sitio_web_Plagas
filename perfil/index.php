<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta Tags -->
    <meta name="title" content="Plagas APP">
    <meta name="description" content="Aplicación para la detección de plagas en cultivos, Desarrollado por SENNOVA.">

    <meta name="og:title" content="Perfil | Plagas APP">
    <meta name="og:description" content="Panel de control de usuarios logueados">
    <meta name="og:type" content="website">
    <meta name="og:url" content="https://plagas-app.netlify.app/perfil">
    <meta name="og:image" content="../img/logo.jpg">
    <meta name="og:site_name" content="Plagas APP - Detector de plagas">
   
    <!-- Tipografia -->
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,400&family=Open+Sans:wght@700&display=swap" rel="stylesheet" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/bootstrap.css" />
    
    <!-- Icono -->
    <link rel="icon" type="image/svg" href="../img/logo.svg">

    <title>Perfil | Plagas APP</title>

</head>
<body>

    <header class="container-fluit fixed-top">
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand subtitle" href="#">
                <img src="../img/logo.svg" height="35px" alt="logo" loading="lazy">
                Perfil | Plagas APP</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="menu">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <hr class="menu-divider">
                        <a class="nav-link active" href="../usuario"><img src="../icons/casa.svg" class="pr-2"  alt="icono_casa" height="20px">Inicio</a>
                    </li>
                    <li class="nav-item" id="perfil">
        
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><img src="../icons/estudio.svg" class="pr-2"  alt="icono_estudio" height="20px">Formación Académica</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="../cultivos"><img src="../icons/ecologico.svg" class="pr-2"  alt="icono_cultivo" height="20px">Cultivos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="../"><img src="../icons/flecha.svg" class="pl-1"  alt="icono_flecha" height="20px" style="transform: rotate(180deg);">Salir</a>
                    </li>
                    <li class="nav-item" id="exit">
                        
                    </li>
                </ul>
            </div>
        </nav>
    </header>


    <div class="container">

        <section class="row">
            
            <div class="col-12">
                <h1 class="text-center h4 title">Perfil</h1>
                <br>
                <div id="success-message"></div>
                <br>
                
            </div>

            <div class="col-auto mx-auto">
 
                <?php
                $search = $_GET['search'];
                include("../connect.php");

                $consulta = "SELECT * FROM user WHERE email='$search'";      
                
                $resultado = mysqli_query($connect,$consulta);
                
                include("../disconnect.php");

                foreach ($resultado as $consulta) {
                
                ?>
                    <img src="../img/logo.jpg" alt="" class="mb-4 img-thumbnail">
                    <div class="form-group">
                        <p><img src="../icons/correo.svg" class="mr-3" alt="" width="25px"><?php echo $consulta["email"]?></p>
                    </div>
                    <div class="form-group">
                        <p><img src="../icons/perfil.svg" class="mr-3" alt="" width="25px"><?php echo $consulta["name"]?> <?php echo $consulta["apellido"]?></p>
                    </div>
                    <div class="form-group">
                        <p><img src="../icons/identificacion.svg" class="mr-3" alt="" width="25"><?php echo $consulta["ti"]?> <?php echo $consulta["ni"]?></p> 
                    </div>
                    <div class="form-group">
                        <p><img src="../icons/fecha.svg" class="mr-3" alt="" width="25"><?php echo $consulta["fechanacimiento"]?></p> 
                    </div>
                    <div class="form-group">
                        <p><img src="../icons/celular.svg" class="mr-3" alt="" width="25"><?php echo $consulta["telefono"]?></p> 
                    </div>
                    <a class="btn btn-info btn-block mt-4" href="update.php?update=<?php echo $consulta["email"] ?>">Editar</a>
                <?php
                }
                ?>

            
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
                        <li><a href="../identidad_visual">Identidad Visual</a></li>
                    </ul>  
                </div>

                <div class="col-12 col-sm-6 col-md-4 pb-3">
                    DESCARGAR APP
                    <a href="#"><img src="../img/google-play.png" alt="Insignia_Google-Play" class="download-app"></a>
                </div>

                <div class="col-12 col-md-4">
                    <img src="../img/sena_sennova-white.svg" alt="logo_Sena&Sennova" class="center-img" style="width: 217px;">
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

    <script src="../js/jquery-3.5.1.slim.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

    <!-- Firebase  -->
    <script src="https://www.gstatic.com/firebasejs/7.22.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.22.0/firebase-firestore.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.22.0/firebase-analytics.js"></script>

    <!-- Sistema de autenticación -->
    <script src="https://www.gstatic.com/firebasejs/7.22.0/firebase-auth.js"></script>

    <!-- Credenciales de firebase -->
    <script src="../js/firebase.js"></script>

    <!-- Autenticación -->
    <script src="../js/observer.js"></script>

</body>
</html>