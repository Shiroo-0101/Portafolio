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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
      echo '<h1 class="heading mb-3"><strong>Nuestros Servicios  <br> </strong></h1>';
      echo '<p class="lead text-white mb-5">Refugio Santa Virginia</p>';
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

        <style>
        /* Custom Styles */
        .service-image {
            width: 100%;
            height: auto;
            border-radius: 10px 10px 0 0;
        }

        .service-content {
            background-color: #B0E0E6;
            padding: 20px;
            border-radius: 10px;
            transition: box-shadow 0.3s ease, border-color 0.3s ease;
            border: 1px solid #e9ecef;
        }

        .service-content:hover {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-color: #ced4da;
        }

        .post-meta span {
            margin-right: 10px;
            color: #6c757d;
        }

        .service-description {
            display: none;
            margin-top: 20px;
            color: #495057;
            font-size: 14px;
            line-height: 1.6;
            transition: opacity 0.3s ease;
        }

        .btn-toggle-description {
            margin-top: 10px;
            font-size: 14px;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: auto;
            font-size: 30px;
            color: #6c757d;
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
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <br>
                    <br>
                    <div class="text-center">
                        <h1 class="text-black">Nuestros Servicios</h1>
                    </div>
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
                                <a href="#" class="d-block">

                                <img src="/Asilo/Asilo/admin/images/<?php echo $serviceImage; ?>" class="img-fluid service-image">
                                </a>
                                </br>
                                <h2 class="mb-3 title" style="font-size: 18px;"><a href="#"
                                        class="text-dark"><?php echo htmlentities($row['ServiceTitle']); ?></a></h2>
                                </br>
                                <button class="btn btn-sm btn-primary btn-toggle-description"
                                    onclick="toggleDescription(this)" style="font-size: 14px;">Mostrar
                                    Descripción</button>

                                <div class="service-description" style="display: none;">
                                    <?php echo $row['ServiceDescription']; ?>
                                </div>
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
            /* Ensures each item takes at least 300px and flexibly grows */


            flex-direction: column;
            justify-content: space-between;
            max-width: 350px;
            /* Ajusta este valor para aumentar ligeramente el ancho */
            margin: 0 auto;
        }

        .service-image {
            max-width: 100%;
            height: auto;
        }

        .service-description {
            margin-top: 1rem;
        }

        .btn-toggle-description {
            margin-top: auto;
            /* Pushes the button to the bottom */
        }
        </style>

        <script>
        function toggleDescription(button) {
            const description = button.nextElementSibling;
            const content = button.parentElement;
            const isExpanded = description.style.display === 'block';

            if (isExpanded) {
                description.style.display = 'none';
                content.style.height = '100%';
            } else {
                description.style.display = 'block';
                content.style.height = content.scrollHeight + 'px';
            }
        }
        </script>


        <script>
        function toggleDescription(button) {
            var description = button.parentElement.querySelector('.service-description');
            if (description.style.display === "none" || description.style.display === "") {
                description.style.display = "block";
                button.textContent = "Ocultar Descripción";
            } else {
                description.style.display = "none";
                button.textContent = "Mostrar Descripción";
            }
        }
        </script>



        </br>




        <?php include_once('includes/footer.php');?>
        <script type="text/javascript">
        $(document).ready(function() {
            $().UItoTop({
                easingType: 'easeOutQuart'
            });
        });
        </script>
        <a href="#home" id="toTop" class="scroll" style="display: block;"> <span id="toTopHover" style="opacity: 1;">
            </span></a>

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
    </h5>                <?php } ?>
            </div>
        </div>

    </section><!-- End Cta Section -->    </br>



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
    
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>

    <script src="js/main.js"></script>


</body>

</html>