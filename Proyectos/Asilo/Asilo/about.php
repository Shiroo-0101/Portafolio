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

  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
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


  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

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
      echo '<h1 class="heading mb-3"><strong>Acerca de nosotros  <br> </strong></h1>';
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



  <div class="site-section elegant-section">
  <div class="container">
    <div class="row justify-content-between align-items-center">
      <div class="col-lg-6">
        <div class="section-heading">
          <?php
              include('includes/config.php');
          $ret=mysqli_query($con,"select * from tblpage where PageType='aboutus'");
          $cnt=1;
          while ($row=mysqli_fetch_array($ret)) {
          ?>
          <h2 class="section-title"><?php echo $row['PageTitle'];?></h2>
          <p class="section-description"><?php echo $row['PageDescription'];?>.</p>
          <?php } ?>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="d-block custom-media align-items-stretch">
        <?php
                    include('includes/config.php');
          $ret=mysqli_query($con,"SELECT * FROM tbldifferentimgs WHERE Fototype='Aboutphoto'");
          while ($row=mysqli_fetch_array($ret)) {
            $Imagen = $row['ProfilePic'];
          ?>
          <img src="/Asilo/Asilo/admin/images/<?php echo $Imagen; ?>" alt="Image" class="img-bg elegant-img-bg"    style="background-image;">
          <?php } ?>
            <div class="img-overlay"></div> <!-- Overlay para efecto oscuro -->

            <!-- No es necesario el elemento img, solo el background -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>




<style>
    /* Custom Styles */
    .section-heading h2 {
        font-size: 32px;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
    }

    .section-heading p {
        font-size: 18px;
        color: #666;
        margin-bottom: 30px;
    }

    .popup-window {
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .popup-window img {
        width: 100%;
        border-radius: 10px;
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 12px 24px;
        font-size: 18px;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>
<section id="cta" class="cta img-bg    bg-primary"
        style=" background-size: cover; background-position: center; height: 50vh; position: relative;">
        <div class="container d-flex justify-content-center align-items-center h-100" data-aos="zoom-in">
            <div class="text-center">
                <h1 class="display-1 fw-bolder" style="color: #FFFFFF; font-size: 4rem;">REGLAS</h1>
                </br>
            </div>
        </div>

    </section><!-- End Cta Section --><div class="site-section bg-white">
    <div class="container">
        <div class="row align-items-center">
            <?php
                include('includes/config.php');
            $ret=mysqli_query($con,"SELECT * FROM tblpage WHERE PageType='rules'");
            while ($row=mysqli_fetch_array($ret)) {
            ?>
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="section-heading text-center text-lg-left">
                    <h2 class="heading mb-4"><?php echo $row['PageTitle']; ?></h2>
                    <p class="text-muted mb-4"><?php echo $row['PageDescription']; ?></p>
                    <p class="mb-4"><?php echo $row['PageContent']; ?></p>
           
                </div>
            </div>
            <div class="col-lg-6 order-lg-2">
            <?php
                    include('includes/config.php');
          $ret=mysqli_query($con,"SELECT * FROM tbldifferentimgs WHERE Fototype='Rulesphoto'");
          while ($row=mysqli_fetch_array($ret)) {
            $Imagenrules = $row['ProfilePic'];
          ?>
                <div class="popup-window rounded shadow-lg">
                <img src="/Asilo/Asilo/admin/images/<?php echo $Imagenrules; ?>" alt="Image" class="img-fluid rounded">

                </div>
            </div>
            <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>

  <style>
    .map-container {
        position: relative;
        width: 100%;
        padding-bottom: 26.25%; /* 16:9 aspect ratio */
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

    </section><!-- End Cta Section -->  </br>


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