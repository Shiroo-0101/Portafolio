<?php
include('includes/config.php');
session_start();
error_reporting(0);

  ?>
<!doctype html>
<html lang="en">

<head>
<title>Refugio  &mdash;Santa Virginia </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&family=Playfair+Display:wght@400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <link rel="stylesheet" href="css/jquery.fancybox.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css">
 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">


    <div id="overlayer"></div>
    <div class="loader">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Cargando...</span>
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
      echo '<h1 class="heading mb-3"><strong>Bienvenidos  <br> </strong></h1>';
      echo '<p class="lead text-white mb-5"><strong>Refugio Santa Virginia </strong></p>';
      echo '<p><a href="index.php" class="btn btn-primary">Ver más</a></p>';
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



        <style>
              .social-icons a {
            margin: 0 10px;
            color: black;
            font-size: 2em;
            transition: color 0.3s;
        }
        .social-icons a:hover {
            color: gray;
        }
        .carousel-control-prev,
        .carousel-control-next {
            width: auto;
            font-size: 30px;
            color: #6c757d;
            background-color: transparent;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
        }

        .carousel-control-prev {
            left: 0;
        }

        .carousel-control-next {
            right: 0;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            padding: 10px;
        }

        .carousel-control-prev-icon:hover,
        .carousel-control-next-icon:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }
        </style>
        </br>

        <div class="site-section">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-lg-5">
                        <div class="d-block custom-media align-items-stretch">
                            <div class="img-bg"
                                style=" border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); overflow: hidden; width: 100%; height: 100%;">
                                <div style="position: relative; width: 100%; height: 100%;">
                                <?php
                            include('includes/config.php');
          $ret=mysqli_query($con,"SELECT * FROM socialmedialinks WHERE Pagetype='Links'");
          while ($row=mysqli_fetch_array($ret)) {
          ?>
                                    <iframe width="560" height="315"
                                        src="<?php echo $row['Youtube'];?>"
                                        title="YouTube video player" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                    <!-- Ajuste del tamaño y efectos -->
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="section-heading text-center">
                            <?php
                            include('includes/config.php');
          $ret=mysqli_query($con,"SELECT * FROM tblpage WHERE PageType='SantaVirginiainfo'");
          while ($row=mysqli_fetch_array($ret)) {
          ?>
                            <h2 style="font-size: 2.5em;"><strong><?php echo $row['PageTitle'];?></strong></h2>
                            </br>
                            <p style="font-size: 1.5em; text-align: center;"><?php echo $row['PageDescription'];?>
                            </p>
                            <?php } ?>
                        </div> 
                    </div>
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
                </div>
            </div>
        </div>

    </div>
    <br>
    <script>
window.addEventListener('mouseover', initLandbot, { once: true });
window.addEventListener('touchstart', initLandbot, { once: true });
var myLandbot;
function initLandbot() {
  if (!myLandbot) {
    var s = document.createElement('script');s.type = 'text/javascript';s.async = true;
    s.addEventListener('load', function() {
      var myLandbot = new Landbot.Livechat({
        configUrl: 'https://storage.googleapis.com/landbot.site/v3/H-2524931-LPV43315EMGCN6TK/index.json',
      });
    });
    s.src = 'https://cdn.landbot.io/landbot-3/landbot-3.0.0.js';
    var x = document.getElementsByTagName('script')[0];
    x.parentNode.insertBefore(s, x);
  }
}
</script>

    <section id="cta" class="cta img-bg"
        style="background-image: url('images/Refugiopic.png'); background-size: cover; background-position: center; height: 50vh; position: relative;">
        <div class="container d-flex justify-content-center align-items-center h-100" data-aos="zoom-in">
            <div class="text-center">
                <h1 class="display-1 fw-bolder" style="color: #FFFFFF; font-size: 4rem;"><strong>SERVICIOS</strong></h1>
            </div>
        </div>
        <div class="overlay"
            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.1);">
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

                    <img src="/Asilo/Asilo/admin/images/<?php echo $serviceImage; ?>" class="img-fluid service-image">
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
                <span class="number" data-number="<?php echo htmlspecialchars($data['cantidad']); ?>"></span>
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



        </br>
        <div class="site-section">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-lg-5">
                        <div class="d-block custom-media align-items-stretch">
                            <div class="img-bg"
                                style=" border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); overflow: hidden; width: 100%; height: 100%;">
                                <div style="position: relative; width: 100%; height: 100%;">
                                <?php
                            include('includes/config.php');
          $ret=mysqli_query($con,"SELECT * FROM socialmedialinks WHERE Pagetype='Links'");
          while ($row=mysqli_fetch_array($ret)) {
          ?>
                                    <iframe width="560" height="315"
                                        src="<?php echo $row['Youtubee'];?>"
                                        title="YouTube video player" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                    <!-- Ajuste del tamaño y efectos -->
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="section-heading text-center">
                            <?php
          $ret=mysqli_query($con,"SELECT * FROM tblpage WHERE PageType='eligibility'");
          while ($row=mysqli_fetch_array($ret)) {
          ?>
                            <h2 style="font-size: 2.5em;"><strong><?php echo $row['PageTitle'];?></strong></h2>
                            </br>
                            <p style="font-size: 1.5em; text-align: center;"><?php echo $row['PageDescription'];?>
                            </p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </br>






    </br>
    </br>
    </br>
    
    <style>
        /* Establecer un tamaño fijo para todas las imágenes del portafolio */
        .portfolio-item img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }
    </style>

<section id="cta" class="cta img-bg    bg-primary"
        style=" background-size: cover; background-position: center; height: 50vh; position: relative;">
        <div class="container d-flex justify-content-center align-items-center h-100" data-aos="zoom-in">
            <div class="text-center">
                <h1 class="display-1 fw-bolder" style="color: #FFFFFF; font-size: 3rem;">PROGRESO DEL PROYECTO</h1>
                </br>
                <h5 class="text-white" style=" text-align: center; font-size: 0.9rem; ">Aunque a paso más lento que lo deseado, el proyecto continúa avanzando. Estas fotos muestran el terreno que pensamos comprar, y estaremos contactando universidades para que nos ayuden que el diseño arquitectónico, estudios de suelos, y todo lo necesario para llevar este sueño a la realidad.</h5>
            </div>
        </div>

    </section><!-- End Cta Section -->

    </br>
<!-- Portfolio Grid -->
<section class="page-section " id="portfolio">
        <div class="container">
            <div class="text-center">
            </div>
            <div class="row">
                <?php
             
include('includes/config.php');

                // Obtener datos de la tabla `portafolio`
                $sql = "SELECT nombre, photo FROM portafolio";
                $result = $con->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '
                        <div class="col-lg-4 col-sm-6 mb-4">
                            <div class="portfolio-item">
                                <a class="portfolio-link" data-bs-toggle="modal" ' . $row["id"] . '">
                                    <div class="portfolio-hover">
                                        <div class="portfolio-hover-content"><i class=""></i></div>
                                    </div>
                                    <img class="img-fluid" src="/Asilo/Asilo/admin/images/' . $row["photo"] . '" alt="..." />
                                </a>
                                <div class="portfolio-caption">
                                   
                                    <div class="portfolio-caption-subheading text-muted"></div>
                                </div>
                            </div>
                        </div>';
                    }
                } else {
                    echo "<p>No hay resultados</p>";
                }

                // Cerrar la conexión
                $con->close();
                ?>
            </div>
        </div>
    </section>


    </br>
    </br>
    <div class="site-section bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-6 mb-5 mb-md-0">

                <?php
                    include('includes/config.php');
          $ret=mysqli_query($con,"SELECT * FROM tbldifferentimgs WHERE Fototype='Newsphoto'");
          while ($row=mysqli_fetch_array($ret)) {
            $Image = $row['ProfilePic'];
          ?>
                <img src="/Asilo/Asilo/admin/images/<?php echo $Image; ?>" alt="Image" class="img-fluid">

                    <?php } ?>
                </div>
                <div class="col-md-6 col-lg-5 ml-auto">
                    <div class="section-heading">
                    <?php
                    include('includes/config.php');
          $ret=mysqli_query($con,"SELECT * FROM tblpage WHERE PageType='noticia'");
          while ($row=mysqli_fetch_array($ret)) {
          ?>
                        <h2 class="heading mb-3 text-white"><?php echo $row['PageTitle'];?></h2>
 
                        <p class="text-white"><?php echo $row['PageDescription'];?></p>
                       
                        <p class="text-white mb-5"><strong class="h3">&ldquo;<?php echo $row['Email'];?>&rdquo;</strong>
                        </p>
                        <p><a href="post.php" class="btn btn-white">Ver Noticias</a></p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </br>



    </br>

    <div class="site-section">
    <div class="container">
      <div class="row mb-5 justify-content-center">
        <div class="col-7 text-center">
          <div class="heading">
            <h2 class="text-black">Donaciones a Refugio Santa Virginia</h2>
          </div>
          <p>Donaciones parciales serán incluidas en
                    un fondo general y asignadas a cualquier parte del proyecto según sea necesario.</p>
        </div>
      </div>

            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="d-block d-flex   custom-media algin-items-stretch">
                        <div class="text text-left  ">
                            <h3>Wompi</h3>
                            <p class="mb-4">Donacion por medio de la aplicacion Wompi El Salvador.
                            </p>
                            <p><a href="donacion.php" class="btn btn-outline-white">Donar</a></p>
                        </div>
                        <div class="img-bg" style="background-image: url('images/Captura1.jpg')"></div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="d-block d-flex custom-media algin-items-stretch">
                        <div class="text text-left  ">
                            <h3>Paypal</h3>
                            <p class="mb-4">Donacion por medio de Paypal.
                            </p>
                            <p><a href="donacion.php" class="btn btn-outline-white">Donar</a></p>
                        </div>
                        <div class="img-bg" style="background-image: url('images/paypal.jpg')"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    .text-white {
    color: #ffffff !important;
}

    </style>
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
                <h5 style="text-align: center; color: white;">
    <?php echo $row['PageDescription']; ?>
</h5>      <?php } ?>
            </div>
        </div>

    </section><!-- End Cta Section -->
    </br>

    <div class="map-container">
    <?php
                            include('includes/config.php');
          $ret=mysqli_query($con,"SELECT * FROM socialmedialinks WHERE Pagetype='Links'");
          while ($row=mysqli_fetch_array($ret)) {
          ?>
        <iframe src="<?php echo $row['GoogleMaps']; ?>" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <?php } ?>
        </div>
    </div>

    </br>


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

    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>



</body>

</html>