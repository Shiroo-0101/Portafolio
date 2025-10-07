<?php session_start();
// Database Connection
include('includes/config.php');
//Validating Session
if(strlen($_SESSION['aid'])==0)
  { 
header('location:index.php');
}
else{ ?>
<!DOCTYPE html>
<html lang="en">

<head>
  
  <title>Refugio Santa Virginia || Tablero</title>
  <!-- base:css -->
  <link rel="stylesheet" href="vendors/typicons/typicons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>@media (max-width: 767px) {
    /* Estilos para dispositivos móviles */
    .navbar-breadcrumb {
        flex-direction: column;
        align-items: flex-start !important;
    }
    .navbar-menu-wrapper {
        justify-content: flex-start !important;
    }
    .icon-xl {
        font-size: 2rem;
    }
    .chart-container {
    position: relative;
    height: 60vh; /* Ajusta la altura según tus necesidades */
    width: 100%;
}
}</style>
</head>
<body>
  
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php include_once('includes/header.php');?>
    <!-- partial -->
    <nav class="navbar-breadcrumb col-xl-12 col-12 d-flex flex-row p-0">
&nbsp;
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end" align="right">
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item ml-0">
            <h4 class="mb-0">Tablero</h4>
          </li>
          <li class="nav-item">
            <div class="d-flex align-items-baseline">
              <p class="mb-0">Inicio</p>
              <i class="typcn typcn-chevron-right"></i>
              <p class="mb-0">Tablero principal</p>
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
          <div class="col-12 col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between justify-content-md-center justify-content-xl-between flex-wrap mb-4">
                    <div>
                      <?php $query1=mysqli_query($con,"select ID from tblservices");
$totservices=mysqli_num_rows($query1);
?>
                      <h5 class="mb-0" style="color: blue;">Todos los servicios</h5>
                      <h1 class="mb-0"><?php echo $totservices;?></h1>
                    </div>
                    <i class="typcn typcn-briefcase icon-xl text-secondary"></i>
                  </div>
                  
                  <a href="manage-services.php" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between justify-content-md-center justify-content-xl-between flex-wrap mb-4">
                    <div>
                       <?php $query2=mysqli_query($con,"select ID from tblseniorcitizen");
$totsccount=mysqli_num_rows($query2);
?>
                      <h5 class="mb-0" style="color: blue;">Personas Registradas</h5>
                      <h1 class="mb-0"><?php echo $totsccount;?></h1>
                    </div>
                    <i class="typcn typcn-user icon-xl text-secondary"></i>
                  </div>
                  <a href="manage-scdetails.php" class="small-box-footer">Más información <i class="fas fa-users-circle-right"></i></a>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between justify-content-md-center justify-content-xl-between flex-wrap mb-4">
                    <div>
                       <?php $query3=mysqli_query($con,"select ID from tblcontact where IsRead is null");
$totunreadenq=mysqli_num_rows($query3);
?>
                      <h5 class="mb-0" style="color: blue;">Consulta no leída</h5>
                      <h1 class="mb-0"><?php echo $totunreadenq;?></h1>
                    </div>
                    <i class="typcn typcn-clipboard icon-xl text-secondary"></i>
                  </div>
                  <a href="unreadenq.php" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between justify-content-md-center justify-content-xl-between flex-wrap mb-4">
                    <div>
                      <?php $query4=mysqli_query($con,"select ID from tblcontact where IsRead='1'");
$totreadenq=mysqli_num_rows($query4);
?>
                      <h5 class="mb-0" style="color: blue;">Leer consulta</h5>
                      <h1 class="mb-0"><?php echo $totreadenq;?></h1>
                    </div>
                    <i class="typcn typcn-clipboard icon-xl text-secondary"></i>
                  </div>
                   <a href="readenq.php" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Agregar la gráfica de barras -->
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
              <div class="chart-container">
    <canvas id="myChart"></canvas>
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



<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Servicios', 'Personas Registradas', 'Consultas no leídas', 'Consultas leídas'],
        datasets: [{
            label: 'Estadísticas',
            data: [<?php echo max(0, $totservices); ?>, <?php echo max(0, $totsccount); ?>, <?php echo max(0, $totunreadenq); ?>, <?php echo max(0, $totreadenq); ?>],
            backgroundColor: [
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)'
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                precision: 0
            }
        }
    }
});
</script>  <script src="js/dashboard.js"></script>
  <!-- End custom js for this page-->
</body>

</html>
<?php } ?>
