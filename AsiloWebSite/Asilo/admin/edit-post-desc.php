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
    <link rel="stylesheet" href="vendors/select2/select2.min.css">
    <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    <!-- endinject -->
    <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    <script type="text/javascript">
    bkLib.onDomLoaded(function() {
        new nicEditor({
            fullPanel: true
        }).panelInstance('editor');
    });
    </script>
</head>
<body>
<?php
session_start();
error_reporting(0);

include_once('includes/config.php');
if (strlen($_SESSION['aid']) == 0) {
    header('location:logout.php');
} 

// Database connection
require_once "include/connection.php";
$successAlert = "<script>Swal.fire({ title: '¡Éxito!', text: 'El registro ha sido un éxito', icon: 'success', button: 'Cerrar' });</script>";
$errorAlert = "<script>Swal.fire({ title: 'Error', text: '¡Algo salió mal. Por favor, inténtalo de nuevo!', icon: 'info', button: 'Cerrar' });</script>";
$errorAlert1 = "<script>Swal.fire({ title: 'Error', text: 'No deje espacios en blanco', icon: 'info', button: 'Cerrar' });</script>";

$id = $_GET["id"];
$get_post_details = "SELECT * FROM post_description WHERE p_id ='$id' ";
$result_get_post_details = mysqli_query($conn, $get_post_details);

if ($result_get_post_details) {
    while ($post_details_row = mysqli_fetch_assoc($result_get_post_details)) {
        $p_heading = $post_details_row["p_heading"];
        $editor = $post_details_row["p_description"];
        $thumbnail_name = $post_details_row["p_thumbnail"];
    }
}

$p_heading_err = $editor_err = $thumbnail_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_REQUEST["p_heading"])) {
        echo $errorAlert1;
        $p_heading = "";
    } else {
        $p_heading = $_REQUEST["p_heading"];
    }

 // Validar la descripción del editor
 $editor = trim($_REQUEST["editor"]); // Eliminar espacios en blanco al principio y al final del contenido

 // Validar la descripción del editor
 $editor = trim($_REQUEST["editor"]); // Eliminar espacios en blanco al principio y al final del contenido

 if ($editor === "") {
     echo $errorAlert1;
     $editor_err = $errorAlert1; // Mostrar mensaje de error
 } else {
     $editor_err = ""; // Restablecer el mensaje de error
 }
    $new_file_name = $thumbnail_name; // default to current thumbnail name
    if (!empty($_FILES["thumbnail"]["name"])) {
        $thumbnail_name = $_FILES["thumbnail"]["name"];
        $thumbnail_temp_loc = $_FILES["thumbnail"]["tmp_name"];

        $temp_extension = explode(".", $thumbnail_name);
        $thumbnail_extension = strtolower(end($temp_extension));
        $isallowed = array("jpg", "png", "jpeg");

        if (in_array($thumbnail_extension, $isallowed)) {
            $new_file_name = uniqid("", true) . "." . $thumbnail_extension;
            $location = "upload/thumbnail/" . $new_file_name;
            $carousel_location = "upload/carousel/" . $new_file_name;

            // Move thumbnail to thumbnail location
            move_uploaded_file($thumbnail_temp_loc, $location);
            
            // Move thumbnail to carousel location
            move_uploaded_file($thumbnail_temp_loc, $carousel_location);
        } else {
            echo "<script>Swal.fire({ title: 'ERROR', text: 'Sólo se admiten archivos JPG, JPEG y PNG.', icon: 'info', button: 'Cerrar' });</script>";
            $thumbnail_name = "";
        }
    }

    if (!empty($p_heading) && !empty($editor)) {
        $update_post_description = "UPDATE post_description SET p_heading = '$p_heading', p_description = '$editor', p_thumbnail = '$new_file_name' WHERE p_id = '$id'";
        $result_update_desc = mysqli_query($conn, $update_post_description);

        if ($result_update_desc) {
            echo "<script>
            Swal.fire({
                title: '¡Éxito!',
                text: 'El registro ha sido un éxito',
                icon: 'success',
                button: 'Cerrar'
            }).then(function() {
                window.location.href = 'manage-post-desc.php';
            });
            </script>";
        } else {
            echo $errorAlert;
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
        <?php include_once('includes/header.php');?>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_settings-panel.html -->
        <?php include_once('includes/sidebar.php');?>
        <!-- partial -->
        <!-- partial:partials/_sidebar.html -->
        <div class="main-panel">
            <div class="container mb-5">
                <div id="form" class="pt-5 form-input-content">
                    <div class="card login-form mb-0">
                        <div class="card-body pt-3 shadow">
                            <h4 class="text-center">Editar descripción de la noticia </h4>
                            <form method="POST" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?id=' . $id; ?>" onsubmit="return validarFormulario();">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Encabezamiento de la noticia:</label>
                                        <input type="text" class="form-control" name="p_heading" id="exampleInputEmail1"
                                               aria-describedby="emailHelp" placeholder="Post Heading"
                                               value="<?php echo $p_heading; ?>">
                                        <?php echo $p_heading_err; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInput">Descripción de la noticia:</label>
                                        <textarea name="editor" id="editor" class="form-control"><?php echo $editor; ?></textarea>
                                        <?php echo $editor_err; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Publicar Foto:</label>
                                        <input type="file" class="form-control" name="thumbnail" id="exampleInputPassword1" placeholder="">
</br>
                                        <img src="upload/thumbnail/<?php echo htmlentities($thumbnail_name); ?>" width="250">
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary btn-block" onclick="return validarFormulario();">Editar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- partial -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- Script de validación en el head del documento -->
    <script type="text/javascript">
   function validarFormulario() {
    var editorValue = document.getElementById("editor").value.trim();
    var regex = /^\s*$/; // Expresión regular para verificar si el campo contiene solo espacios en blanco

    if (regex.test(editorValue)) {
        alert("Por favor, ingresa una descripción para la noticia.");
        return false; // Evita que el formulario se envíe
    }
    return true; // Permite que el formulario se envíe si la descripción no está vacía o no contiene solo espacios en blanco
}

</script>

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
</body>
</html>
