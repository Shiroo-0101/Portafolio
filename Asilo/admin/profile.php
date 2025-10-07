<!DOCTYPE html>
<html lang="en">

<head>

    <title>Refugio Santa Virginia || Perfil</title>
    <!-- base:css -->
    <link rel="stylesheet" href="vendors/typicons/typicons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="vendors/select2/select2.min.css">
    <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    <!-- endinject -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.min.css" />

    <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>

    <?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['aid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {
    $adminid=$_SESSION['aid'];
    $aname=$_POST['adminname'];
  $mobno=$_POST['contactnumber'];
  
     $query=mysqli_query($con, "update tbladmin set AdminName ='$aname', MobileNumber='$mobno' where ID='$adminid'");
    if ($query) {
      echo "<p><script>Swal.fire({ title: 'ÉXITO', text: 'Se ha actualizado el perfil del administrador.', icon: 'success', button: 'Cerrar' });</script>";

  }
  else
    {
      

      echo "<script>Swal.fire({ title: 'ERROR', text: 'Algo ha ido mal. Vuelva a intentarlo', icon: 'info', button: 'Cerrar' });</script>";
    }
  }
  ?>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->

        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex justify-content-center">
                <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
                    <a class="navbar-brand brand-logo" href="index.html"><img src="images/logo.svg" alt="logo" /></a>
                    <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo-mini.svg"
                            alt="logo" /></a>
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-toggle="minimize">
                        <span class="typcn typcn-th-menu"></span>
                    </button>
                </div>
            </div>
            <?php include_once('includes/header.php');?>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->

            <?php include_once('includes/sidebar.php');?>
            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->

            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Perfil de Admin</h4>
                                    <p class="card-description">
                                        Actualización de información
                                    </p>
                                    <form class="forms-sample" method="post">
                                        <?php
$adminid=$_SESSION['aid'];
$ret=mysqli_query($con,"select * from tbladmin where ID='$adminid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Nombre del administrador</label>
                                            <input type="text" class="form-control" name="adminname" id="adminname"
                                                value="<?php  echo $row['AdminName'];?>" required='true' />
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nombre de usuario administrador</label>
                                            <input type="text" class="form-control" name="username" id="username"
                                                value="<?php  echo $row['UserName'];?>" readonly="true" />
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Número de contacto</label>
                                            <input type="text" class="form-control" id="contactnumber"
                                                name="contactnumber" value="<?php  echo $row['MobileNumber'];?>"
                                                required='true' maxlength='10' patter='[0-9]+' />
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputConfirmPassword1">Dirección de correo
                                                electrónico</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                class="form-control" value="<?php  echo $row['Email'];?>"
                                                readonly='true' />
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputConfirmPassword1">Fecha de inscripción</label>
                                            <input type="text" class="form-control"
                                                value="<?php  echo $row['AdminRegdate'];?>" readonly="true" />
                                        </div><?php } ?>
                                        <button type="submit" class="btn btn-primary mr-2"
                                            name="submit">Guardar</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- content-wrapper ends -->
                <?php include_once('includes/footer.php');?>
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
    <!-- plugin js for this page -->
    <script src="vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <script src="vendors/select2/select2.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- Custom js for this page-->
    <script src="js/file-upload.js"></script>
    <script src="js/typeahead.js"></script>
    <script src="js/select2.js"></script>
    <!-- End custom js for this page-->
</body>

</html>
<?php } ?>