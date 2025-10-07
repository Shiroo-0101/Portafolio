<!DOCTYPE html>
<html lang="en">

<head>

    <title>Refugio Santa Virginia || Añadir donacion</title>
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- endinject -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.min.css" />

    <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>

    <script type="text/javascript">
    bkLib.onDomLoaded(function() {
        new nicEditor({
            fullPanel: true
        }).panelInstance('serdes');
    });
    </script>
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
$sertitle=$_POST['sertitle'];
$serdes=$_POST['serdes'];
$cantidad=$_POST['cantidad'];
$propic = $_FILES['propic']['name'];
$propic2 = $_FILES['propic2']['name'];
$propic3 = $_FILES['propic3']['name'];



// Verificar si algún campo está vacío
if (empty($sertitle) || empty($serdes) || empty($propic) || empty($propic2) || empty($propic3)) {
    echo "<script>Swal.fire({ title: 'ERROR', text: 'Todos los campos son obligatorios.', icon: 'error', button: 'Cerrar' });</script>";
} else {
    $extension = substr($propic, strlen($propic) - 4, strlen($propic));
    $allowed_extensions = array(".jpg", ".jpeg", ".png", ".gif", ".JPG", ".PNG", ".JPEG", ".GIF");
    
    $extension2 = substr($propic2, strlen($propic2) - 4, strlen($propic2));
    
    $extension3 = substr($propic3, strlen($propic3) - 4, strlen($propic3));

    // Verificar la extensión del archivo
    if (!in_array($extension, $allowed_extensions) && !in_array($extension2, $allowed_extensions) && !in_array($extension3, $allowed_extensions)) {
        echo "<script>Swal.fire({ title: 'ERROR', text: 'Sólo se admiten archivos JPG, JPEG, GIF y PNG.', icon: 'info', button: 'Cerrar' });</script>";
    } else {
        $propic = md5($propic) . time() . $extension;
        $propic2 = md5($propic2) . time() . $extension2;
        $propic3 = md5($propic3) . time() . $extension3;
        move_uploaded_file($_FILES["propic"]["tmp_name"], "images/" . $propic);
        move_uploaded_file($_FILES["propic2"]["tmp_name"], "images/" . $propic2);
        move_uploaded_file($_FILES["propic3"]["tmp_name"], "images/" . $propic3);

        // Insertar en la base de datos si las validaciones pasan
        $sql = mysqli_query($con, "INSERT INTO proyectos (projecTitle, projectDescription, Image, image2, image3, money) VALUES ('$sertitle', '$serdes', '$propic', '$propic2', '$propic3', '$cantidad')");
        
        // Verificar si la consulta se ejecutó correctamente
        if ($sql) {
            echo "<script>Swal.fire({ title: 'ÉXITO', text: 'Se ha añadido con éxito', icon: 'success', button: 'Cerrar' });</script>";
        } else {
            echo "<script>Swal.fire({ title: 'ERROR', text: 'Error al añadir el producto.', icon: 'error', button: 'Cerrar' });</script>";
        }
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
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Añadir proyectos requeridos</h4>
                                    <p class="card-description">
                                    Añadir proyectos requeridos
                                    </p>
                                    <form class="forms-sample" method="post" enctype="multipart/form-data">

                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Nombre del proyecto</label>
                                            <input id="sertitle" name="sertitle" type="text" class="form-control"
                                                required="true" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Descripción del proyecto</label>
                                            <textarea class="form-control" name="serdes" id="serdes"
                                                rows="5" ></textarea>
                                        </div>
                                        <div class="form-group">
                                           <label for="exampleInputUsername1">Cantidad necesaria para el proyecto</label>
                                           <input id="cantidad" name="cantidad" type="number" class="form-control" required="true" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Foto 1 del proyecto</label>
                                            <input id="propic" name="propic" type="file" class="form-control"
                                                required="true" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Foto 2 del proyecto</label>
                                            <input id="propic" name="propic2" type="file" class="form-control"
                                                required="true" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Foto 3 del proyecto</label>
                                            <input id="propic" name="propic3" type="file" class="form-control"
                                                required="true" value="">
                                        </div>

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