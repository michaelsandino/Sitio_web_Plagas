<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta Tags -->
    <meta name="title" content="Plagas APP">
    <meta name="description" content="Aplicación para la detección de plagas en cultivos, Desarrollado por SENNOVA.">

    <meta name="og:title" content="Usuario | Plagas APP">
    <meta name="og:description" content="Panel de control de usuarios logueados">
    <meta name="og:type" content="website">
    <meta name="og:url" content="https://plagas-app.netlify.app/usuario/cultivos">
    <meta name="og:image" content="../../img/logo.jpg">
    <meta name="og:site_name" content="Plagas APP - Detector de plagas">
   
    <!-- Tipografia -->
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,400&family=Open+Sans:wght@700&display=swap" rel="stylesheet" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="../../css/style.css" />
    <link rel="stylesheet" href="../../css/bootstrap.css" />
    
    <!-- Icono -->
    <link rel="icon" type="image/svg" href="../../img/logo.svg">

    <style>
        @media screen and (min-width:0px){
            .plag_image{
                width: 100%;
                padding-top: 15px; 
            }
        }

        @media screen and (min-width:576px){
            .plag_image{
                height: 250px;
                width: 250px;
                object-fit: cover;
            }
        }
        @media screen and (min-width:768px){
            .plag_image{
                height: 335px;
                width: 335px;
                object-fit: cover;
            }
        }

        @media screen and (min-width:992px){
            .plag_image{
                height: 228px;
                width: 228px;
                object-fit: cover;
            }
        }

        @media screen and (min-width:1200px){
            .plag_image{
                height: 272px;
                width: 272px;
                object-fit: cover;
            }

        }
        .center_container{
            text-align: center;
            justify-content: center;
        }

        .boton{
            display:block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
    
    <title>Plagas | Plagas APP</title>

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
                <h1 class="text-center h4 title">Plagas</h1>
                <h1 class="text-center h5 subtitle" id="planta_name"></h1>
                <div id="success-message"></div>
                <div id="progress"></div>
            </div>

            <div class="col-12 border rounded py-2 px-3 bg-white shadow-sm" style="position: -webkit-sticky; position: sticky; top: 61px; z-index: 1;"> 
                <img src="../../icons/plaga-2.svg" alt="icono_estudios" height="35px" class="pt-1 pr-2">
                <button class="btn btn-secondary float-right"  data-toggle="modal" data-target="#modal"><img src="../../icons/suma-blanco.svg" alt="icono_mas" height="15px" class="pb-1 px-1"></button>
                <div id="eliminado"></div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title title pt-0 w-100 text-center" id="exampleModalLabel">registrar Plagas</h5>
                    <button type="button" class="close position-absolute" data-dismiss="modal" aria-label="Close" style="right: 20px;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form name="register" id="p_register" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="tipoPlaga">Tipo de enfermedad o plaga</label>
                                <input type="text" class="form-control tipoPlaga_color" id="tipoPlaga" name="tipoPlaga">
                                <small class="form-text text-danger" id="tipoPlaga_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="nameT">Nombre Tradicional</label>
                                <input type="text" class="form-control nameT_color" id="nameT" name="nameT">
                                <small class="form-text text-danger" id="nameT_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="nameC">Nombre científico</label>
                                <input type="text" class="form-control nameC_color" id="nameC" name="nameC">
                                <small class="form-text text-danger" id="nameC_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="descrip">Descripción</label>
                                <textarea class="form-control descrip_color" id="descrip" rows="4" name="descrip"></textarea>
                                <small class="form-text text-danger" id="descrip_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="photoA">Cargar Imagen 1</label><br>
                                <input type="file" name="photoA" id="photoA" class="photoA_color">
                                <small class="form-text text-danger" id="photoA_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="photoB">Cargar Imagen 2</label><br>
                                <input type="file" name="photoB" id="photoB" class="photoB_color">
                                <small class="form-text text-danger" id="photoB_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="photoC">Cargar Imagen 3</label><br>
                                <input type="file" name="photoC" id="photoC" class="photoC_color">
                                <small class="form-text text-danger" id="photoC_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="photoD">Cargar Imagen 4</label><br>
                                <input type="file" name="photoD" id="photoD" class="photoD_color">
                                <small class="form-text text-danger" id="photoD_error"></small>
                            </div>

                            <button type="submit" class="btn btn-success btn-block mt-4">Guardar</button>
                            <div id="message"></div>
                            </form>
                    </div>
                </div>
                </div>
            </div>

            <section id="result" class="w-100">
            

            </section>

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
    <script src="../ajax/plagas.js"></script>
    
    
</body>
</html>
