<!DOCTYPE html>
<html lang="en">

<head>

    <title>Refugio Santa Virginia || Actualizar imagenes </title>
    <!-- base:css -->
    <link rel="stylesheet" href="vendors/typicons/typicons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="vendors/select2/select2.min.css">
    <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    <!-- endinject -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.min.css" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>

</head>

<body>
    <?php session_start();
error_reporting(0);
include_once('includes/config.php');
if (strlen($_SESSION['aid']==0)) {
  header('location:logout.php');
  } else{
if(isset($_POST['submit']))
{
$propic=$_FILES["propic"]["name"];
$extension = substr($propic,strlen($propic)-4,strlen($propic));
$allowed_extensions = array(".jpg","jpeg",".PNG",".gif",".png",".JPG",".JPEG",".GIF");
if(!in_array($extension,$allowed_extensions))
{
  echo "<script>Swal.fire({ title: 'ERROR', text: 'Sólo se admiten archivos JPG, JPEG GIF y PNG.', icon: 'info', button: 'Cerrar' });</script>";
}
else
{

$propic=md5($propic).time().$extension;
 move_uploaded_file($_FILES["propic"]["tmp_name"],"images/".$propic);
$id=intval($_GET['id']);
$sql=mysqli_query($con,"update tblservices set ProfilePic='$propic' where ID='$id'");
echo "<p><script>Swal.fire({ title: 'ÉXITO', text: 'Actualizado exitosamente', icon: 'success', button: 'Cerrar' }).then(() => { window.location.href = 'manage-services.php'; });</script></p>";
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
                                    <h4 class="card-title">Actualizar detalles </h4>
                                    <p class="card-description">
                                        Actualizar detalles
                                    </p>
                                    <form class="forms-sample" method="post" enctype="multipart/form-data">
                                        <?php
                    $id=intval($_GET['id']);
                         $query=mysqli_query($con,"select * from tblservices where tblservices.ID='$id'");

while($row=mysqli_fetch_array($query))
{
?>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Nombre del servicio </label>
                                            <input id="namesc" name="namesc" type="text" class="form-control"
                                                readonly="true" value="<?php echo htmlentities($row['ServiceTitle']);?>">
                                        </div>




                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Antigua foto </label>
</br>
                                            <img src="images/<?php echo htmlentities($row['ProfilePic']);?>"
                                                width="250">

                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nueva foto  </label>
                                            <input id="propic" name="propic" type="file" class="form-control"
                                                required="true" value="">
                                        </div>
                                        <?php } ?>
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