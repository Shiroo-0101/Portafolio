<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refugio Santa Virginia || Añadir detalles</title>
    <!-- base:css -->
    <link rel="stylesheet" href="vendors/typicons/typicons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- endinject -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.min.css" />
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="vendors/select2/select2.min.css">
    <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    <!-- endinject -->
    <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
</head>
 
<body>
    <?php
    session_start();
    //error_reporting(0);
    include_once('includes/config.php');
    if (strlen($_SESSION['aid']==0)) {
        header('location:logout.php');
    } else {
        if(isset($_POST['submit'])) {
            $namesc = $_POST['namesc'];
            $propic = $_FILES["propic"]["name"];
            $extension = substr($propic, strlen($propic) - 4, strlen($propic));
            $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif", ".JPG", ".PNG", ".JPEG", ".GIF");
 
            if(!in_array($extension, $allowed_extensions)) {
                echo "<script>Swal.fire({ title: 'ERROR', text: 'Sólo se admiten archivos JPG, JPEG, GIF y PNG.', icon: 'info', button: 'Cerrar' });</script>";
            } else {
                $temp_path = $_FILES["propic"]["tmp_name"];
                list($width, $height) = getimagesize($temp_path);
 
                if($width !== 500 || $height !== 400) {
                    echo "<script>Swal.fire({ title: 'ERROR', text: 'Sólo se admiten imágenes de tamaño 500x400.', icon: 'info', button: 'Cerrar' });</script>";
                } else {
                    $propic = md5($propic) . time() . $extension;
                    move_uploaded_file($temp_path, "images/" . $propic);
                    $sql = mysqli_query($con, "INSERT INTO portafolio(nombre, photo) VALUES('$namesc', '$propic')");
                    echo "<script>Swal.fire({ title: 'ÉXITO', text: 'Imagen de portafolio registrada exitosamente', icon: 'success',  button: 'Cerrar' }).then(() => { window.location.href = 'Addportafolio.php'; });</script>";
                }
            }
        }
    ?>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex justify-content-center">
                <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
                    <a class="navbar-brand brand-logo" href="index.html"><img src="images/logo.svg" alt="logo" /></a>
                    <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo-mini.svg" alt="logo" /></a>
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
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
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Registro de portafolio</h4>
                                    <p class="card-description">
                                        Añadir imágenes
                                    </p>
                                    <form class="forms-sample" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="namesc">Nombre del evento de la imagen</label>
                                            <input id="namesc" name="namesc" type="text" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="propic">Foto</label>
                                            <input id="propic" name="propic" type="file" class="form-control" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2" name="submit">Añadir</button>
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