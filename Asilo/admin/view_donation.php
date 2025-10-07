<?php session_start();
// Conexión a la base de datos
include('includes/config.php');
// Validación de sesión
if(strlen($_SESSION['aid'])==0)
{ 
    header('location:index.php');
}
else
{
    $vid=$_GET['viewid'];
    $isread=1;
    $query=mysqli_query($con, "update tblDoncontact set IsRead ='$isread' where ID='$vid'");
?>
<!DOCTYPE html>
<html lang="es">

<head>
  
  <title>Refugio Santa Virginia|| Ver Consulta</title>
  <!-- base:css -->
  <link rel="stylesheet" href="vendors/typicons/typicons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php include_once('includes/header.php');?>
    <!-- partial -->
    <nav class="navbar-breadcrumb col-xl-12 col-12 d-flex flex-row p-0">
      <div class="navbar-links-wrapper d-flex align-items-stretch">
        <div class="nav-link">
          <a href="javascript:;"><i class="typcn typcn-calendar-outline"></i></a>
        </div>
        <div class="nav-link">
          <a href="javascript:;"><i class="typcn typcn-mail"></i></a>
        </div>
        <div class="nav-link">
          <a href="javascript:;"><i class="typcn typcn-folder"></i></a>
        </div>
        <div class="nav-link">
          <a href="javascript:;"><i class="typcn typcn-document-text"></i></a>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item ml-0">
            <h4 class="mb-0">Ver Consulta de Producto</h4>
          </li>
          <li class="nav-item">
            <div class="d-flex align-items-baseline">
              <p class="mb-0">Inicio</p>
              <i class="typcn typcn-chevron-right"></i>
              <p class="mb-0">Ver Consulta de Producto</p>
            </div>
          </li>
        </ul>
       
      </div>
    </nav>
    <div class="container-fluid page-body-wrapper">
  
      <!-- partial:partials/_sidebar.html -->
     <?php include_once('includes/sidebar.php');?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">


          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <h4 class="card-title" style="padding-left: 20px; padding-top: 20px;">Ver Consulta de Producto</h4>
                  <p class="card-description" style="padding-left: 20px;"> 
                    ¡La consulta ha sido marcada como leída!
                  </p>
                <div class="table-responsive pt-3">
                  
                <div class="card-body">
    <?php
    $ret = mysqli_query($con, "SELECT * FROM tblDoncontact WHERE ID=$vid");
    if ($ret && mysqli_num_rows($ret) > 0) {
        $cnt = 1;
        while ($row = mysqli_fetch_array($ret)) {
          $p_thumbnail = $row["Imagen"];
    ?>
          <table class="table table-bordered mg-b-0" style="font-size: 20px;">
    <tr>
        <td colspan="6" style="text-align: center;">
            <h1><?php echo $row['Producto']; ?></h1>
            <img src="../admin/images/<?php echo $p_thumbnail; ?>" class="img-fluid" style="height: 200px; width: 200px;">
        </td>
    </tr>
    <tr>
        <th style="font-size: 15px; text-align: center;">Nombre</th>
        <td colspan="2" style="text-align: center;"><?php echo $row['FirstName']; ?> <?php echo $row['LastName']; ?></td>
        <th style="font-size: 15px; text-align: center;">Email</th>
        <td colspan="2" style="text-align: center;"><?php echo $row['Email']; ?></td>
    </tr>
    <tr>
        <th style="font-size: 15px; text-align: center;">Número de Contacto</th>
        <td colspan="5" style="text-align: center;"><?php echo $row['Phone']; ?></td>
       
    </tr>
    <tr>
        <th style="font-size: 15px; text-align: center;">Mensaje</th>
        <td colspan="5" style="text-align: center; font-size: 18px; font-weight: bold;"><?php echo $row['Message']; ?></td>
    </tr>
</table>


    <?php
            $cnt = $cnt + 1;
        }
    } else {
        echo "No hay datos para mostrar.";
    }
    ?>
</div>

                </div>
                
              </div>
            </div>
          </div>

        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <?php include_once('includes/footer.php');?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- base:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <!-- End custom js for this page-->
</body>

</html>

</html>
<?php } ?>
