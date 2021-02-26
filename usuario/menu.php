           <?php
         
            session_start();
            ob_start();
        
            $user_email = $_SESSION['user'];
            $user_rol = $_SESSION['rol'];
            /* echo $_SESSION['user']; */
            

            /* 
            Administrador es el general
            Admi  es el que avala info
            usuario  
            */
            if ($user_rol == 'usuario') {
                ?>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="menu">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <hr class="menu-divider">
                            <a class="nav-link active" href="../inicio"><img src="../../icons/casa.svg" class="pr-2"  alt="icono_casa" height="20px">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="../perfil"><img src="../../icons/usuario.svg" class="pr-2"  alt="icono_usuario" height="20px">Perfil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="../estudios"><img src="../../icons/estudio.svg" class="pr-2"  alt="icono_estudio" height="20px">Formación Académica</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="../cultivos"><img src="../../icons/ecologico.svg" class="pr-2"  alt="icono_cultivo" height="20px">Cultivos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="../jurado"><img src="../../icons/jurado.svg" class="pr-2"  alt="icono_cultivo" height="20px">Jurado</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="../../"><img src="../../icons/flecha.svg" class="pl-1"  alt="icono_flecha" height="20px" style="transform: rotate(180deg);">Salir</a>
                        </li>
                        <li class="nav-item" id="exit">
                            <hr class="menu-divider"> 
                            <button class="nav-link active btn btn-link" onclick="exit()"><img src="../../icons/salida.svg" class="pr-2"  alt="icono_salir" height="20px">Cerrar Sesión</button>
                        </li>
                    </ul>
                </div>

                <?php
            }else if($user_rol == 'Admi'){
                ?>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="menu">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <hr class="menu-divider">
                            <a class="nav-link active" href="../inicio"><img src="../../icons/casa.svg" class="pr-2"  alt="icono_casa" height="20px">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="../perfil"><img src="../../icons/usuario.svg" class="pr-2"  alt="icono_usuario" height="20px">Perfil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="../estudios"><img src="../../icons/estudio.svg" class="pr-2"  alt="icono_estudio" height="20px">Formación Académica</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="../cultivos"><img src="../../icons/ecologico.svg" class="pr-2"  alt="icono_cultivo" height="20px">Cultivos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="../jurado"><img src="../../icons/jurado.svg" class="pr-2"  alt="icono_cultivo" height="20px">Jurado</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="../seguimientos"><img src="../../icons/aval.svg" class="pr-2"  alt="icono_cultivo" height="20px">Seguimientos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="../../"><img src="../../icons/flecha.svg" class="pl-1"  alt="icono_flecha" height="20px" style="transform: rotate(180deg);">Salir</a>
                        </li>
                        <li class="nav-item" id="exit">
                            <hr class="menu-divider"> 
                            <button class="nav-link active btn btn-link" onclick="exit()"><img src="../../icons/salida.svg" class="pr-2"  alt="icono_salir" height="20px">Cerrar Sesión</button>
                        </li>
                    </ul>
                </div>

                <?php
            }else if($user_rol == 'Administrador'){
                ?>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="menu">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <hr class="menu-divider">
                            <a class="nav-link active" href="../inicio"><img src="../../icons/casa.svg" class="pr-2"  alt="icono_casa" height="20px">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="../perfil"><img src="../../icons/usuario.svg" class="pr-2"  alt="icono_usuario" height="20px">Perfil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="../solicitudes"><img src="../../icons/jurado.svg" class="pr-2"  alt="icono_cultivo" height="20px">Validar Solicitudes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="../../"><img src="../../icons/flecha.svg" class="pl-1"  alt="icono_flecha" height="20px" style="transform: rotate(180deg);">Salir</a>
                        </li>
                        <li class="nav-item" id="exit">
                            <hr class="menu-divider"> 
                            <button class="nav-link active btn btn-link" onclick="exit()"><img src="../../icons/salida.svg" class="pr-2"  alt="icono_salir" height="20px">Cerrar Sesión</button>
                        </li>
                    </ul>
                </div>

                <?php
            }else if (!$user_rol) {
                ?>
                <p class="nav-link m-0 py-0">Redireccionado, por favor espere.</p>
                
                <script src="../ajax/jquery-3.5.1.min.js"></script>
                <script>
                    $(document).ready(function(){
                        exit();
                    });
                </script>

                <?php
            }
           ?>
           
            