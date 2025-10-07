<?php
include ('includes/config.php');
session_start();
error_reporting(0);

?>
<!doctype html>
<html lang="en">

<head>
    <title>Refugio &mdash;Santa Virginia </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&family=Playfair+Display:wght@400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <link rel="stylesheet" href="css/jquery.fancybox.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css">

    <style>
        .rounded-button {
            display: inline-block;
            width: 250px;
            /* Ancho del botón */
            height: 50px;
            /* Alto del botón */
            border: none;
            border-radius: 25px;
            /* Cambia el valor para ajustar el redondeo */
            background-image: url('images/Davivienda.png');
            /* URL de la imagen de fondo */
            background-size: cover;
            /* Ajusta la imagen para cubrir todo el botón */
            background-position: center;
            /* Centra la imagen de fondo */
            color: white;
            /* Color del texto */
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            line-height: 50px;
            /* Alinea el texto verticalmente */
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .rounded-button:hover {
            background-color: rgba(0, 0, 0, 0.5);
            /* Fondo semi-transparente al pasar el ratón */
        }

        .social-icons a {
            margin: 0 10px;
            color: black;
            font-size: 2em;
            transition: color 0.3s;
        }

        .social-icons a:hover {
            color: gray;
        }

        .rounded-button1 {
            display: inline-block;
            width: 200px;
            /* Ancho del botón */
            height: 50px;
            /* Alto del botón */
            border: none;
            border-radius: 25px;
            /* Cambia el valor para ajustar el redondeo */
            background-image: url('images/paypal.png');
            /* URL de la imagen de fondo */
            background-size: cover;
            /* Ajusta la imagen para cubrir todo el botón */
            background-position: center;
            /* Centra la imagen de fondo */
            color: white;
            /* Color del texto */
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            line-height: 50px;
            /* Alinea el texto verticalmente */
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .rounded-button:hover {
            background-color: rgba(0, 0, 0, 0.5);
            /* Fondo semi-transparente al pasar el ratón */
        }

        /* Estilos para hacer el video responsive */
        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            /* Relación de aspecto 16:9 */
            height: 0;
            overflow: hidden;
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        /* Mejoras para las tarjetas de proyectos */
.project-card {
    border: none;
    transition: transform 0.3s, box-shadow 0.3s;
    margin-bottom: 20px;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.project-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

.project-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 10px;
    /* Añadir borde y sombra */
    border: 5px solid white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.project-card-body {
    padding: 20px;
}

.project-card-title {
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: 10px;
}

.project-card-text {
    font-size: 1rem;
    color: #555;
    margin-bottom: 20px;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
}

    </style>

</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

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

        <?php
        include ('header.php');
        ?>

        <!-- MAIN -->

        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php
                include ('includes/config.php');

                $consulta = "SELECT imagen FROM slides";
                $resultado = mysqli_query($con, $consulta);

                $primer = true;

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
                    echo '<h1 class="heading mb-3"><strong>Donaciones en las que nos puedes ayudar<br> </strong></h1>';
                    echo '<p class="lead text-white mb-5">Refugio de ancianos Santa Virginia</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }

                mysqli_close($con);
                ?>
            </div>

            <ol class="carousel-indicators">
                <?php
                $contador = 0;
                mysqli_data_seek($resultado, 0);
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    echo '<li data-target="#carouselExampleSlidesOnly" data-slide-to="' . $contador . '"';
                    if ($contador == 0) {
                        echo ' class="active"';
                    }
                    echo '></li>';
                    $contador++;
                }
                ?>
            </ol>
        </div>

        <br>

        <section id="cta" class="cta img-bg bg-primary" style="background-size: cover; background-position: center; height: 50vh; position: relative;">
            <div class="container d-flex justify-content-center align-items-center h-100" data-aos="zoom-in">
                <div class="text-center">
                    <h1 class="display-1 fw-bolder" style="color: #FFFFFF; font-size: 3rem;">Proyectos Requeridos</h1>
                </div>
            </div>
        </section>

        <div class="site-section">
            <div class="container">
                <div class="row">
                    <?php
                    include ('includes/config.php');
                    $query = mysqli_query($con, "SELECT * FROM proyectos");
                    while ($row = mysqli_fetch_array($query)) {
                        $p_thumbnail = $row["image"];
                        ?>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card project-card">
                                <img src="admin/images/<?php echo htmlentities($p_thumbnail); ?>" alt="Image" class="card-img-top">
                                <div class="card-body project-card-body">
                                    <h5 class="card-title project-card-title"><?php echo htmlentities($row['projecTitle']); ?></h5>
                                    <p class="card-text project-card-text"><?php echo htmlentities($row['money']); ?></p>
                                    <a href="project_detail.php?id=<?php echo $row['ID']?>" class="btn btn-primary btn-sm btn-icon-text mr-3">Ver <i class="typcn typcn-edit btn-icon-append"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <br>
        <br>

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
        <br>

        <section id="cta" class="cta img-bg bg-primary" style="background-size: cover; background-position: center; height: 50vh; position: relative;">
            <div class="container d-flex justify-content-center align-items-center h-100" data-aos="zoom-in">
                <div class="text-center">
                    <h1 class="display-1 fw-bolder" style="color: #FFFFFF; font-size: 4rem;">UBICACION</h1>
                    <?php
                    include ('includes/config.php');
                    $ret = mysqli_query($con, "SELECT * FROM tblpage WHERE PageType='contactus'");
                    while ($row = mysqli_fetch_array($ret)) {
                        ?>
                        <br>
                        <h5 class="text-white" style="text-align: center;">
                            <?php echo $row['PageDescription']; ?>
                        </h5> <?php } ?>
                </div>
            </div>
        </section>

        <br>

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

    <?php
    include ('footer.php');
    ?>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>
