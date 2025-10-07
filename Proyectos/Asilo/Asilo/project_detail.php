<!doctype html>
<html lang="en">

<head>
    <title>Refugio &mdash;Santa Virginia </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="build/css/intlTelInput.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.min.css" />
    
    <style>
        .carousel-inner img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .project-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #333;
        }

        .project-money {
            font-family: 'Open Sans', sans-serif;
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #28a745;
        }

        .project-description {
            font-family: 'Open Sans', sans-serif;
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
            color: #555;
        }

        .carousel-item img {
            height: 300px;
            object-fit: cover;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: #000;
            border-radius: 50%;
        }

        .form-group input[type="submit"] {
            font-family: 'Open Sans', sans-serif;
            font-size: 1rem;
            padding: 0.5rem 2rem;
            background-color: #007bff;
            border: none;
            border-radius: 0.25rem;
        }
    </style>
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    <?php
    include ('includes/config.php');
    session_start();
    error_reporting(0);
    ?>

    <div id="overlayer"></div>
    <div class="loader">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    <div class="site-wrap">
        <div class="site-mobile-menu site-navbar-target">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>

        <?php include ('header.php'); ?>

        <!-- MAIN -->
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php
                // Conexión a la base de datos
                include ('includes/config.php');

                // Consulta para obtener las imágenes de la base de datos
                $consulta = "SELECT imagen FROM slides";
                $resultado = mysqli_query($con, $consulta);

                $primer = true; // Variable para controlar el primer elemento del carrusel
                
                // Recorre los resultados y genera el código HTML para cada imagen
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    $imagen = $fila['imagen'];
                    if ($primer) {
                        echo '<div class="carousel-item active">';
                        $primer = false;
                    } else {
                        echo '<div class="carousel-item">';
                    }
                    echo '<div class="slide-item overlay" style="background-image: url(\'/Asilo/Asilo/admin/images/' . $imagen . '\')">';
                    echo '<div class="container">';
                    echo '<div class="row">';
                    echo '<div class="col-lg-6 align-self-center">';
                    echo '<h1 class="heading mb-3"><strong>Proyectos del Refugio  <br> </strong></h1>';
                    echo '<p class="lead text-white mb-5">Refugio de ancianos Santa Virginia</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }

                // Cierra la conexión a la base de datos
                mysqli_close($con);
                ?>
            </div>

            <!-- Indicadores -->
            <ol class="carousel-indicators">
                <?php
                // Contador para los indicadores
                $contador = 0;
                // Volver a obtener los resultados
                mysqli_data_seek($resultado, 0);
                // Recorrer los resultados para generar los indicadores
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    echo '<li data-target="#carouselExampleSlidesOnly" data-slide-to="' . $contador . '"';
                    // Si es el primer elemento, añadir la clase active
                    if ($contador == 0) {
                        echo ' class="active"';
                    }
                    echo '></li>';
                    $contador++;
                }
                ?>
            </ol>
        </div>

        <script>
            $('#mensaje_ayuda').text('20 carácteres restantes');
            $('#message').keydown(function () {
                var max = 20;
                var len = $(this).val().length;
                if (len >= max) {
                    $('#mensaje_ayuda').text('Has llegado al límite');// Aquí enviamos el mensaje a mostrar          
                    $('#mensaje_ayuda').addClass('text-danger');
                    $('#message').addClass('is-invalid');
                    $('#inputsubmit').addClass('disabled');
                    document.getElementById('inputsubmit').disabled = true;
                }
                else {
                    var ch = max - len;
                    $('#mensaje_ayuda').text(ch + ' carácteres restantes');
                    $('#mensaje_ayuda').removeClass('text-danger');
                    $('#message').removeClass('is-invalid');
                    $('#inputsubmit').removeClass('disabled');
                    document.getElementById('inputsubmit').disabled = false;
                }
            });  
        </script>

        <?php
        include ('includes/config.php');
        $start_id = 1;
        $end_id = 4;
        ?>

        </br>

        <div class="site-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mb-5">
                        <form class="forms-sample" method="post">
                            <?php
                            $id = intval($_GET['id']);
                            $query = mysqli_query($con, "SELECT * FROM proyectos WHERE proyectos.ID='$id'");

                            while ($row = mysqli_fetch_array($query)) {
                            ?>
                            <div class="form-group">
                                <h1 class="project-title">
                                    <?php echo htmlentities($row['projecTitle']); ?>
                                </h1>
                            </div>

                            <!-- Carrusel de imágenes -->
                            <div id="projectCarousel" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="admin/images/<?php echo htmlentities($row['image']); ?>" class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="admin/images/<?php echo htmlentities($row['image2']); ?>" class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="admin/images/<?php echo htmlentities($row['image3']); ?>" class="d-block w-100" alt="...">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#projectCarousel" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#projectCarousel" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                            <!-- Fin del carrusel de imágenes -->
                            </br>
                            <div class="form-group">
                                <h2 class="project-money">Cantidad necesaria $<?php echo htmlentities($row['money']); ?></h2>
                            </div>
                            <div class="form-group">
                                <p class="project-description"><?php echo htmlentities($row['projectDescription']); ?></p>
                            </div>
                            <?php } ?>
                        </form>
                    </div>

                    <?php
                    // Conexión a la base de datos
                    include ('includes/config.php');

                    $sql = "SELECT * FROM tblpage WHERE PageType = 'contactus'";
                    $result = $con->query($sql);

                    // Verificar si hay resultados
                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-lg-3 ml-auto">
                        <p class="mb-0 font-weight-bold text-black mr-2">REFUGIO SANTA VIRGINIA</p>
                        <img src="Refugio_Logo.png" alt="Imagen del refugio" class="img-fluid" style="width: 50px; height: auto;">
                        <br><br>
                        <p class="mb-0 font-weight-bold text-black">Ubicación</p>
                        <p class="mb-4"><?php echo $row["PageDescription"]; ?></p>
                        <p class="mb-0 font-weight-bold text-black">Correo Electrónico</p>
                        <p class="mb-4"><?php echo $row["Email"]; ?></p>
                        <p class="mb-0 font-weight-bold text-black">Número de Teléfono</p>
                        <p class="mb-4">+503 <?php echo $row["MobileNumber"]; ?></p>
                    </div>
                    <?php
                        }
                    } else {
                        echo "0 resultados";
                    }
                    $con->close();
                    ?>
                </div>
            </div>
        </div>

        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/jquery-ui.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/jquery.easing.1.3.js"></script>
        <script src="js/aos.js"></script>
        <script src="js/jquery.waypoints.min.js"></script>
        <script src="js/jquery.animateNumber.min.js"></script>
        <script src="js/jquery.fancybox.min.js"></script>
        <script src="js/jquery.sticky.js"></script>
        <script src="js/isotope.pkgd.min.js"></script>
        <script src="build/js/intlTelInput.js"></script>
        <script src="js/jquery.countdown.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <style>
            .form-group-row {
                display: flex;
                flex-wrap: wrap;
                margin: -10px;
            }

            .form-group-col-md-12 {
                flex: 0 0 100%;
                max-width: 100%;
                padding: 10px;
            }

            .hola {
                width: 730%;
                max-width: 730px;
                box-sizing: border-box;
            }
        </style>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
        <style>
            .map-container {
                position: relative;
                width: 100%;
                padding-bottom: 26.25%;
                /* 16:9 aspect ratio */
            }

            .map-container iframe {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
            }
        </style>
        <section id="cta" class="cta img-bg bg-primary" style=" background-size: cover; background-position: center; height: 50vh; position: relative;">
            <div class="container d-flex justify-content-center align-items-center h-100" data-aos="zoom-in">
                <div class="text-center">
                    <h1 class="display-1 fw-bolder" style="color: #FFFFFF; font-size: 4rem;">UBICACION</h1>
                    <?php
                    include ('includes/config.php');
                    $ret = mysqli_query($con, "SELECT * FROM tblpage WHERE PageType='contactus'");
                    while ($row = mysqli_fetch_array($ret)) {
                        ?>
                        </br>
                        <h5 class="text-white" style="text-align: center;">
                            <?php echo $row['PageDescription']; ?>
                        </h5> <?php } ?>
                </div>
            </div>
        </section><!-- End Cta Section -->
        </br>

        <div class="map-container">
            <?php
            include ('includes/config.php');
            $ret = mysqli_query($con, "SELECT * FROM socialmedialinks WHERE Pagetype='Links'");
            while ($row = mysqli_fetch_array($ret)) {
                ?>
                <iframe src="<?php echo $row['GoogleMaps']; ?>" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <?php } ?>
        </div>
    </div>

    <?php include ('footer.php'); ?>

    <script src="js/main.js"></script>
</body>

</html>
