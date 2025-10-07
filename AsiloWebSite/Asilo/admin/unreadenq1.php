<?php session_start();
error_reporting(0);
// Conexión a la base de datos
include ('includes/config.php');
// Validación de sesión
if (strlen($_SESSION['aid']) == 0) {
  header('location:index.php');
} else {
  ?>
  <!DOCTYPE html>
  <html lang="es">

  <head>

    <title>Refugio Santa Virginia || Consulta sin leer</title>
    <!-- base:css -->
    <link rel="stylesheet" href="vendors/typicons/typicons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- endinject -->

  </head>

  <body>

    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <?php include_once ('includes/header.php'); ?>
      <!-- partial -->
      <nav class="navbar-breadcrumb col-xl-12 col-12 d-flex flex-row p-0">
        &nbsp;
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
          <ul class="navbar-nav mr-lg-2">
            <li class="nav-item ml-0">
              <h4 class="mb-0">Consulta sin leer</h4>
            </li>
            <li class="nav-item">
              <div class="d-flex align-items-baseline">
                <p class="mb-0">Inicio</p>
                <i class="typcn typcn-chevron-right"></i>
                <p class="mb-0">Consulta sin leer</p>
              </div>
            </li>
          </ul>

        </div>
      </nav>
      <div class="container-fluid page-body-wrapper">

        <!-- partial:partials/_sidebar.html -->
        <?php include_once ('includes/sidebar.php'); ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">


            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <h4 class="card-title" style="padding-left: 20px; padding-top: 20px;">Consulta sin leer</h4>
                  <p class="card-description" style="padding-left: 20px;">
                    ¡Se ha recibido una consulta sin leer!
                  </p>
                  <div class="table-responsive pt-3">

                    <table class="table table-striped project-orders-table">
                      <thead>
                        <tr>
                          <th>N°</th>
                          <th>Producto</th>
                          <th>Imagen</th>
                          <th>Nombre</th>

                          <th>Email</th>
                          <th>Fecha de Consulta</th>
                          <th>Acción</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $ret = mysqli_query($con, "select * from tblDoncontact where IsRead is null");
                        $cnt = 1;
                        while ($row = mysqli_fetch_array($ret)) {
                          $p_thumbnail = $row["Imagen"];
                          ?>
                          <tr class="gradeX">
                            <td><?php echo $cnt; ?></td>
                            <td><?php echo $row['Producto']; ?></td>
                            <td><img src="../admin/images/<?php echo $p_thumbnail; ?>" class="img-fluid"
                                style="max-height: 70px;"></td>
                            <td><?php echo $row['FirstName']; ?>     <?php echo $row['LastName']; ?></td>
                            <td><?php echo $row['Email']; ?></td>
                            <td>
                              <span class="badge badge-primary"><?php echo $row['EnquiryDate']; ?></span>
                            </td>
                            <td>
                              <a href="view_donation.php?viewid=<?php echo $row['ID']; ?>"
                                class="btn btn-success btn-sm btn-icon-text mr-3">Ver <i
                                  class="typcn typcn-eye btn-icon-append"></i> </a>
                            </td>
                          </tr><?php $cnt = $cnt + 1;
                        } ?>

                      </tbody>
                    </table>


                  </div>

                </div>
              </div>
            </div>

          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <?php include_once ('includes/footer.php'); ?>
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