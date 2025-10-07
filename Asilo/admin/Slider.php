
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Refugio Santa Virginia || Acerca de nosotros</title>
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.min.css" />


    <!-- endinject -->
</head>
<body>
<?php
session_start();
error_reporting(0);
include_once('includes/config.php');

if (strlen($_SESSION['aid']) == 0) {
    header('location:logout.php');
} else {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        

        $nombre = $_POST['nombre'];
        $img = $_FILES['foto'];
        $name = $img['name'];
        $tmpname = $img['tmp_name'];
        $fecha = date("YmdHis");
        $foto = $fecha . ".jpg";
        $destino = "/Asilo/Asilo/admin/images/" . $foto;
    
        $imgName = $_FILES['foto']['name'];
        $imgTmp = $_FILES['foto']['tmp_name'];
        $imgSize = $_FILES['foto']['size'];
    
        list($width, $height) = getimagesize($imgTmp);
        if ($width !== 1920 || $height !== 1080) {
            $errorMsg = "La imagen debe tener la resolucion 1920x1080";
            echo "<p><script>Swal.fire({
                title: 'Error',
                text: 'La imagen debe tener la resolucion 1920x1080',
                icon: 'warning',
                button: 'Cerrar',
            });</script></p>";
        }
    
        $query = mysqli_query($con, "SELECT COUNT(*) as total FROM slides");
        $row = mysqli_fetch_assoc($query);
        $totalSlides = $row['total'];
    
        if ($totalSlides >= 5) {
            $errorMsg = "Sólo se permiten (5) imágenes.";
            echo "<p><script>Swal.fire({
                title: 'Error',
                text: 'Sólo se permiten (5) imágenes.',
                icon: 'warning',
                button: 'Cerrar',
            });</script></p>";
        }
    
        if ($imgName) {
            $imgExt = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));
            $allowExt = array('jpeg', 'jpg', 'png', 'gif');
            $userPic = time() . '_' . rand(1000, 9999) . '.' . $imgExt;
            if (in_array($imgExt, $allowExt)) {
                if ($imgSize < 5000000) {
                    if (file_exists($_SERVER['DOCUMENT_ROOT'] . $destino)) {
                        unlink($_SERVER['DOCUMENT_ROOT'] . $destino);
                    }
                    move_uploaded_file($imgTmp, $_SERVER['DOCUMENT_ROOT'] . $destino);
                } else {
                    $errorMsg = "Imagen demasiado grande";
                    echo "<p><script>Swal.fire({
                        title: 'Error',
                        text: 'Imagen demasiado grande',
                        icon: 'warning',
                        button: 'Cerrar',
                    });</script></p>";
                }
            } else {
                $errorMsg = "Invalid image format";
                echo "<p><script>Swal.fire({
                    title: 'Error',
                    text: 'Formato de imagen invalido',
                    icon: 'warning',
                    button: 'Cerrar',
                });</script></p>";
            }
        } else {
            $userPic = $row['foto'];
        }
    
        if (!isset($errorMsg)) {
            $query = mysqli_query($con, "INSERT INTO slides(nombre, imagen) VALUES ('$nombre', '$foto')");
            if ($query) {
                echo "<p><script>Swal.fire({
                    title: 'Exitoso',
                    text: 'Imagen añadida exitosamente',
                    icon: 'success',
                    button: 'Cerrar',
                }).then(() => {
                    window.location.href = 'Slider.php';
                });</script></p>";
                if (move_uploaded_file($tmpname, $_SERVER['DOCUMENT_ROOT'] . $destino)) {
    
                }
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
                <a class="navbar-brand brand-logo" href="index.html"><img src="images/logo.svg" alt="logo"/></a>
                <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo-mini.svg"
                                                                               alt="logo"/></a>
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="typcn typcn-th-menu"></span>
                </button>
            </div>
        </div>
        <?php include_once('includes/header.php'); ?>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_settings-panel.html -->
        <?php include_once('includes/sidebar.php'); ?>
        <!-- partial -->
        <!-- partial:partials/_sidebar.html -->
        <div class="main-panel">
            <div class="container mb-5">
                <div class="pt-5">
                    <div class="card login-form mb-0">
                        <div class="card-body pt-3 shadow">
                            <h4 class="text-center mb-4">Añadir imagen</h4>
                            <!-- Form -->
                            <form method="POST" enctype="multipart/form-data"
                                  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                                <!-- Category Selection -->

                                <!-- Post Heading -->
                                <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input id="nombre" required="required" class="form-control" type="text" name="nombre" placeholder="Nombre de la imagen"
                                    required>
                                </div>
                                <!-- Post Description (CKEditor) -->
                                <div class="form-group">

                                <!-- Thumbnail Upload -->
                                <div class="form-group">
                                  
                                    <div class="custom-file">
                                    <label for="imagen">Imagen</label>
                                <input type="file" class="form-control" name="foto" required>                                    </div>
                                    <?php echo $thumbnail_err; ?>
                                    <!-- Thumbnail Preview (optional) -->
                                    <img id="thumbnail-preview" src="#" alt="Thumbnail Preview"
                                         style="display: none; max-width: 100px; margin-top: 10px;">
                                </div>
                                <!-- Submit Button -->
                                <div class="form-group">
                                <button class="btn btn-primary" id="submit" type="submit"  value="submit"
                        name="submit">Registrar</button>                                </div>
                            </form>
                        </div>
                        <!-- CKEditor Initialization -->
                        <script src="include/ckeditor/ckeditor.js"></script>
                        <script>
                            CKEDITOR.replace('editor');
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelector('input[name="thumbnail"]').addEventListener('change', function(e) {
        const preview = document.getElementById('thumbnail-preview');
        const file = e.target.files[0];
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    });
</script>

</body>
  <!-- container-scroller -->
    
<script src="js/jquery.superslides.min.js"></script>

    <!-- base:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <script src="vendors/select2/select2.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="js/file-upload.js"></script>
    <script src="js/select2.js"></script>
    <!-- End custom js for this page-->
</html>
