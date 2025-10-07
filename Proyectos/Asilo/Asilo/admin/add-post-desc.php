
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Refugio Santa Virginia || Acerca de nosotros</title>
    <!-- base:css -->
    <link rel="stylesheet" href="vendors/typicons/typicons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="vendors/select2/select2.min.css">
    <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    <style> 
    #thumbnail-preview {
    max-width: 100%;
    height: auto;
}
    
    @media (max-width: 767px) {
    /* Estilos para dispositivos móviles */
    .form-group label {
        font-size: 14px;
    }
    
    .custom-file-label {
        font-size: 12px;
    }
    
    /* Otros estilos para ajustar el diseño */
}</style>
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
    if (isset($_POST['submit'])) {
        $pagetitle = $_POST['pagetitle'];
        $pagedes = $_POST['pagedes'];
        $query = mysqli_query($con, "update tblpage set PageTitle='$pagetitle',PageDescription='$pagedes' where  PageType='aboutus'");
        if ($query) {


            echo "<script>Swal.fire({ title: '¡Éxito!', text: '¡La página Acerca de nosotros ha sido actualizada!', icon: 'success', button: 'Cerrar' });</script>";

        } else {
            echo "<script>Swal.fire({ title: 'Error', text: '¡Algo salió mal. Por favor, inténtalo de nuevo!', icon: 'info', button: 'Cerrar' });</script>";
        }
    }
}
// Verificar si se ha enviado el formulario y procesar la imagen
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Resto del código de validación

    if (!empty($category) && !empty($editor) && !empty($p_heading) && !empty($thumbnail_name)) {
        if (move_uploaded_file($thumbnail_temp_loc, $location)) {
            // El archivo se ha movido correctamente, ahora puedes insertar los datos en la base de datos
        } else {
            $thumbnail_err = "<p style='color:red'>Error al mover el archivo. Por favor, intenta de nuevo.</p>";
        }
    }
}

// Database connection
require_once "include/connection.php";
// Definir las alertas
$successAlert = "<script>Swal.fire({ title: '¡Éxito!', text: 'El registro ha sido un exitoso', icon: 'success', button: 'Cerrar' });</script>";
$errorAlert = "<script>Swal.fire({ title: 'Error', text: '¡Algo salió mal. Por favor, inténtalo de nuevo!', icon: 'info', button: 'Cerrar' });</script>";
$errorAlert1 = "<script>Swal.fire({ title: 'Error', text: 'No deje espacios en blanco', icon: 'info', button: 'Cerrar' });</script>";

$category_err = $p_heading_err = $editor_err = $thumbnail_err = "";
$category = $p_heading = $editor = $thumbnail_name = "";
$t = 1;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_REQUEST["p_category"])) {
        echo $errorAlert1;
        } else {
        $category = $_REQUEST["p_category"];
    }

    if (empty($_REQUEST["p_heading"])) {
        echo $errorAlert1;
        } else {
        $p_heading = $_REQUEST["p_heading"];
    }

    if (empty($_REQUEST["editor"])) {
        echo $errorAlert1;
        } else {
        $editor = $_REQUEST["editor"];
    }

    if (empty($_FILES["thumbnail"]["name"])) {
        echo $errorAlert1;
        } else {
        $thumbnail_name = $_FILES["thumbnail"]["name"];
        $thumbnail_temp_loc = $_FILES["thumbnail"]["tmp_name"];

        $temp_extension = explode(".", $thumbnail_name);
        $thumbnail_extension = strtolower(end($temp_extension));
        $isallowed = array("jpg", "png", "jpeg");

        if (in_array($thumbnail_extension, $isallowed)) {
            $new_file_name = uniqid("", true) . "." . $thumbnail_extension;
            $thumbnail_location = "upload/thumbnail/" . $new_file_name;
            $carousel_location = "upload/carousel/" . $new_file_name;

            // Move uploaded file to thumbnail folder
            if (move_uploaded_file($thumbnail_temp_loc, $thumbnail_location)) {
                // Copy uploaded file to carousel folder
                if (copy($thumbnail_location, $carousel_location)) {
                    // Both files uploaded successfully, now insert data into database
                    $add_post_description = "INSERT INTO post_description (p_heading, p_description, p_thumbnail, p_category, p_carousel) VALUES ('$p_heading', '$editor', '$new_file_name', '$category', '$new_file_name')";
                    $result_add_desc = mysqli_query($conn, $add_post_description);

                    if ($result_add_desc) {
                        $category = $p_heading = $editor = "";
                       
                            echo $successAlert;
                    } else {
                        echo $errorAlert;
                    }
                } else {
                    echo "<script>Swal.fire({ title: 'ERROR', text: 'No se ha podido copiar el archivo cargado en la carpeta del proyecto.', icon: 'info', button: 'Cerrar' });</script>";

                  
                }
            } else {
                echo "<script>Swal.fire({ title: 'ERROR', text: 'No se ha podido mover el archivo cargado a la carpeta.', icon: 'info', button: 'Cerrar' });</script>";

               
            }
        } else {
            echo "<script>Swal.fire({ title: 'ERROR', text: 'Sólo se admiten archivos JPG, JPEG y PNG.', icon: 'info', button: 'Cerrar' });</script>";
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
                            <h4 class="text-center mb-4">Añadir noticias</h4>
                            <!-- Form -->
                            <form method="POST" enctype="multipart/form-data"
                                  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                                <!-- Category Selection -->

                                <!-- Post Heading -->
                                <div class="form-group">
                                    <label>Título de la noticia:</label>
                                    <input type="text" class="form-control" value="<?php echo $p_heading; ?>"
                                           name="p_heading">
                                    <?php echo $p_heading_err; ?>
                                </div>
                                <!-- Post Description (CKEditor) -->
                                <div class="form-group">
                                   
                                <div class="form-group">
                                    <label>Descripcion de la noticia:</label>
                                    <textarea name="editor" id="editor" rows="4"><?php echo $editor; ?></textarea>
                                    <?php echo $editor_err; ?>
                                </div>
                                <!-- Thumbnail Upload -->
                                <div class="form-group">
                                    <label>Agregar imagen:</label>
                                    <div class="custom-file">
                                        <input type="file" name="thumbnail" class="custom-file-input">
                                        <label class="custom-file-label" for="thumbnail">Selecciona el archivo</label>
                                    </div>
                                    <?php echo $thumbnail_err; ?>
                                    <!-- Thumbnail Preview (optional) -->
                                    <img id="thumbnail-preview" src="#" alt="Thumbnail Preview"
                                         style="display: none; max-width: 100px; margin-top: 10px;">
                                </div>
                                <!-- Submit Button -->
                                <div class="form-group">
                                    <input type="submit" value="Agregar" class="btn btn-primary btn-block">
                                </div>
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
