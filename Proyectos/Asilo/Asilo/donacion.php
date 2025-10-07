<?php
include('includes/config.php');
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
    padding-bottom: 56.25%; /* Relación de aspecto 16:9 */
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
    // Conexión a la base de datos
    include('includes/config.php');

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
      echo '<div class="slide-item overlay" style="background-image: url(\'/Asilo/Asilo/admin/images/'.$imagen.'\')">';
      echo '<div class="container">';
      echo '<div class="row">';
      echo '<div class="col-lg-6 align-self-center">';
      echo '<h1 class="heading mb-3"><strong>Donacion  <br> </strong></h1>';
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
      echo '<li data-target="#carouselExampleSlidesOnly" data-slide-to="'.$contador.'"';
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

</br>

        <section id="cta" class="cta img-bg    bg-primary"
        style=" background-size: cover; background-position: center; height: 50vh; position: relative;">
        <div class="container d-flex justify-content-center align-items-center h-100" data-aos="zoom-in">
            <div class="text-center">
                <h1 class="display-1 fw-bolder" style="color: #FFFFFF; font-size: 3rem;">METODOS DE DONACION</h1>

            </div>
        </div>

    </section><!-- End Cta Section -->




    <div class="site-section elegant-section">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                
            <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <div class="d-block d-flex custom-media align-items-stretch">
                                <div class="text text-left">
                                    <h3>Wompi</h3>
                                    <p class="mb-4">Donación por medio de la aplicación Wompi El Salvador.</p>
                                    <p>
                                    <div class="wompi_button_widget"
                                        data-url-pago="https://pagos.wompi.sv/IntentoPago/Redirect?id=f75a7979-f819-4704-af09-5c39a4f22b51&esWidget=1"
                                        data-render="widget"></div>
                                    <script src="https://pagos.wompi.sv/js/wompi.pagos.js"></script>
                                    </p>
                                </div>
                                <div class="img-bg" style="background-image: url('images/Captura1.jpg')"></div>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-4">
                            <div class="d-block d-flex custom-media align-items-stretch">
                                <div class="text text-left">
                                    <h3>Paypal</h3>
                                    <p class="mb-4">Donación por medio de Paypal.</p>
                                    <p>
                                        <a href="https://www.paypal.com/donate?token=qCnXNXQeiJUDN8gLt64IXnVizoBr4_2LbjiGbUH5HSy7EKIAXAJnbBtroXKVpCnAwWhkPL2DfapClWya&locale.x=ES"
                                            class="rounded-button1" onclick="openPopup(event)"></a>
                                    </p>
                                </div>
                                <div class="img-bg" style="background-image: url('images/paypal.jpg')"></div>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-4">
                            <div class="d-block d-flex custom-media1 align-items-stretch">
                                <div class="text text-left">
                                    <h3>Banco Davivienda</h3>
                                    <p class="mb-4 text-white">Donación por medio de Davivienda.</p>
                                    <p>
                                        <a href="https://www.davivienda.com.sv/#/personas" class="rounded-button"
                                            onclick="openPopup(event)"></a>
                                    </p>
                                </div>
                                <div class="img-bg" style="background-image: url('images/davi.jpg')"></div>
                            </div>
                        </div>
                    </div>
                    <div class="img-overlay"></div> <!-- Overlay para efecto oscuro -->
                </div>
                
            <!-- Inicio -->
            <div class="col-lg-6">
                    <div class="section-heading">


                        <?php
                    include('includes/config.php');
                    $ret = mysqli_query($con, "SELECT * FROM tblpage WHERE PageType='donacion'");
                    $cnt=1;
                    while ($row=mysqli_fetch_array($ret)) {
                    ?>
                        <h2 class="section-title text-black"><strong><?php echo $row['PageTitle'];?></strong></h2>
                        </br>
                        <p class="section-description"><?php echo $row['Donacioninfo'];?>.</p>


                        <?php } ?>
                    </div>
                </div>
                <!-- fin -->
                
             </div>
        </div>
    </div>


        <?php
include('includes/config.php');
$start_id = 1;
$end_id = 4;
?>

        <div class="site-section bg-primary count-numbers">
            <div class="container">
                <div class="row">
                    <?php
for ($id = $start_id; $id <= $end_id; $id++) {
    // Preparar la declaración SQL
    $stmt = $con->prepare("SELECT * FROM tblestadis WHERE id = ?");
    $stmt->bind_param("i", $id); // "i" indica que el parámetro es un entero
    $stmt->execute();
    $result = $stmt->get_result();
    $data = [];

    // Inicializar el array para almacenar los datos
    if ($result->num_rows > 0) {
        // Almacenar el dato específico en la variable $data
        $data = $result->fetch_assoc();
    } else {
        $data = null;
    }
    ?>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                        <div class="counter-wrap text-center">
                            <strong class="counter d-block">
                                <?php if ($id == 2): ?>
                                <span>$</span>
                                <?php endif; ?>
                                <span class="number"
                                    data-number="<?php echo htmlspecialchars($data['cantidad']); ?>"></span>
                            </strong>
                            <strong> <span data="<?php echo htmlspecialchars($data['nombre']); ?>">
                                    <?php echo htmlspecialchars($data['nombre']); ?></strong>
                            </span>
                        </div>
                    </div>
                    <?php
    $stmt->close();
}
?>
                </div>
            </div>
        </div>
    </div>

    </br> </br>







    <div class="site-section elegant-section">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <?php
              include('includes/config.php');
          $ret=mysqli_query($con,"select * from tblpage where PageType='donacion'");
          $cnt=1;
          while ($row=mysqli_fetch_array($ret)) {
          ?>
                        <h2 class="section-title"><strong><?php echo $row['PageTitle'];?></strong></h2>
                        <p class="section-description"><?php echo $row['PageDescription'];?>.</p>
                        <?php } ?>

                    </div>

                </div>

                <div class="col-lg-6">
                    <div class="d-block custom-media align-items-stretch">
                        <?php
                            include('includes/config.php');
          $ret=mysqli_query($con,"SELECT * FROM socialmedialinks WHERE Pagetype='Links'");
          while ($row=mysqli_fetch_array($ret)) {
          ?>
                       <div class="video-container">
    <iframe width="500" height="300" src="<?php echo $row['Youtubeee'];?>"
        title="YouTube video player" frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
</div>
                        <?php } ?>
                        <?php
                    include('includes/config.php');
          $ret=mysqli_query($con,"SELECT * FROM tbldifferentimgs WHERE Fototype='Donatephoto'");
          while ($row=mysqli_fetch_array($ret)) {
            $Imagenphrase = $row['ProfilePic'];
          ?>
                        <img src="/Asilo/Asilo/admin/images/<?php echo $Imagenphrase; ?>" alt="Image"
                            class="img-bg elegant-img-bg" style="background-image;">
                        <?php } ?>
                        <div class="img-overlay"></div> <!-- Overlay para efecto oscuro -->

                        <!-- No es necesario el elemento img, solo el background -->
                    </div>
                    </br>
                    <div class="text-center social-icons">
                        <?php
                            include('includes/config.php');
          $ret=mysqli_query($con,"SELECT * FROM socialmedialinks WHERE Pagetype='Links'");
          while ($row=mysqli_fetch_array($ret)) {
          ?>
                        <a href="<?php echo $row['Facebook'];?>" target="_blank"><i class="fab fa-facebook"></i></a>
                        <a href="<?php echo $row['Instagram'];?>" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="<?php echo $row['Twitter'];?>" target="_blank"><i class="fab fa-twitter"></i></a>
                        <?php } ?>
                    </div>
                    </br>

                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    </br>



    <section id="cta" class="cta img-bg    bg-primary"
        style=" background-size: cover; background-position: center; height: 50vh; position: relative;">
        <div class="container d-flex justify-content-center align-items-center h-100" data-aos="zoom-in">
            <div class="text-center">
                <h1 class="display-1 fw-bolder" style="color: #FFFFFF; font-size: 4rem;">SERVICIOS</h1>

            </div>
        </div>

    </section><!-- End Cta Section -->

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <br>

                    <div class="row">
                        <?php
                        include('includes/config.php');
                $query = mysqli_query($con, "select * from tblservices");
                $num = mysqli_num_rows($query);
              
                if ($num > 0) {
                    while ($row = mysqli_fetch_array($query)) {
                          $serviceImage = $row['ProfilePic'];
                ?>
                        <div class="col-12 col-sm-6 col-md-4 mb-4">
                            <div class="service-content">
                                <a class="d-block">

                                    <img src="/Asilo/Asilo/admin/images/<?php echo $serviceImage; ?>"
                                        class="img-fluid service-image">
                                </a>
                                </br>
                                <h2 class="mb-3 title" style="font-size: 25px;"><a href="#"
                                        class="text-dark"><?php echo htmlentities($row['ServiceTitle']); ?></a>
                                </h2>
                                </br>
                                <a href="services.php" class="btn btn-sm btn-primary btn-toggle-description"
                                    style="font-size: 14px;"><strong>Ver mas</strong></a>



                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<div class='col-12'><p>No hay servicios disponibles en este momento.</p></div>";
                }
                ?>
                    </div>
                </div>
            </div>
        </div>

        <style>
        .service-content {
            border: 1px solid #ddd;
            padding: 20px;
            background-color: #f8f9fa;
            height: 100%;
            flex: 1 1 300px;
            /* Ajusta este valor para controlar el tamaño mínimo y máximo */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            max-width: 350px;
            /* Ajusta este valor para controlar el ancho máximo */
            margin: 0 auto;
        }

        .service-image {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .service-description {
            display: none;
            margin-top: 10px;
        }

        .btn-toggle-description {
            align-self: flex-end;
            /* Alinea el botón al final del contenedor */
            font-size: 14px;
            margin-top: auto;
            /* Empuja el botón hacia abajo */
        }
        </style>
        </br>
        </br>
        </br>
        </br>
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
        </br>
        <section id="cta" class="cta img-bg    bg-primary"
            style=" background-size: cover; background-position: center; height: 50vh; position: relative;">
            <div class="container d-flex justify-content-center align-items-center h-100" data-aos="zoom-in">
                <div class="text-center">
                    <h1 class="display-1 fw-bolder" style="color: #FFFFFF; font-size: 4rem;">UBICACION</h1>
                    <?php
                    include('includes/config.php');
          $ret=mysqli_query($con,"SELECT * FROM tblpage WHERE PageType='contactus'");
          while ($row=mysqli_fetch_array($ret)) {
          ?>
                    </br>
                    <h5 class="text-white" style="text-align: center;">
                        <?php echo $row['PageDescription']; ?>
                    </h5> <?php } ?>
                </div>
            </div>

        </section><!-- End Cta Section --> </br>


        <div class="map-container">
            <?php
                            include('includes/config.php');
          $ret=mysqli_query($con,"SELECT * FROM socialmedialinks WHERE Pagetype='Links'");
          while ($row=mysqli_fetch_array($ret)) {
          ?>
            <iframe src="<?php echo $row['GoogleMaps']; ?>" width="600" height="450" style="border:0;"
                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <?php } ?>
        </div>
    </div>

    <script>
    function openPopup(event) {
        event.preventDefault(); // Evita que el enlace se abra en la misma pestaña
        var popupWidth = 800;
        var popupHeight = 600;
        var left = (screen.width / 2) - (popupWidth / 2);
        var top = (screen.height / 2) - (popupHeight / 2);
        window.open(event.currentTarget.href, "PayPalElSalvador", "width=" + popupWidth + ", height=" +
            popupHeight +
            ", top=" + top + ", left=" + left);
    }
    </script>
    <script>
    function openPopup(event) {
        event.preventDefault(); // Evita que el enlace se abra en la misma pestaña
        var popupWidth = 800;
        var popupHeight = 600;
        var left = (screen.width / 2) - (popupWidth / 2);
        var top = (screen.height / 2) - (popupHeight / 2);
        window.open(event.currentTarget.href, "Davivienda", "width=" + popupWidth + ", height=" + popupHeight +
            ", top=" +
            top + ", left=" + left);
    }
    </script>




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