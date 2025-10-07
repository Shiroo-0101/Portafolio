<!DOCTYPE html>
<html lang="en">

<head>

    <title>Refugio Santa Virginia || Añadir detalles </title>
    <!-- base:css -->
    <link rel="stylesheet" href="vendors/typicons/typicons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="vendors/select2/select2.min.css">
    <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    <!-- endinject -->

    <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    
    <script type="text/javascript">
    bkLib.onDomLoaded(function() {
        new nicEditor({
            fullPanel: true
        }).panelInstance('commadd');
    });
    </script>
</head>
<script type="text/javascript">
bkLib.onDomLoaded(function() {
    new nicEditor({
        fullPanel: true
    }).panelInstance('emeradd');
});
</script>
</head>

<body>
    <?php session_start();
//error_reporting(0);
include_once('includes/config.php');
if (strlen($_SESSION['aid']==0)) {
  header('location:logout.php');
  } else{
if(isset($_POST['submit']))
{
$namesc=$_POST['namesc'];
$dob=$_POST['dob'];

$contnum=$_POST['contnum'];
$commadd=$_POST['commadd'];
$emeradd=$_POST['emeradd'];
$emercontnum=$_POST['emercontnum'];
$enferadd=$_POST['Enfermedad'];
$mediciadd=$_POST['Medicina'];
$addedby='admin';
$regnum=mt_rand(100000000, 999999999);
$propic=$_FILES["propic"]["name"];
$extension = substr($propic,strlen($propic)-4,strlen($propic));
$allowed_extensions = array(".jpg","jpeg",".png",".gif",".JPG",".PNG",".JPEG",".GIF");
if(!in_array($extension,$allowed_extensions))
{
            echo "<script>Swal.fire({ title: 'ERROR', text: 'Sólo se admiten archivos JPG, JPEG GIF y PNG.', icon: 'info', button: 'Cerrar' });</script>";
}
else
{

$propic=md5($propic).time().$extension;
 move_uploaded_file($_FILES["propic"]["tmp_name"],"images/".$propic);
$sql=mysqli_query($con,"insert into tblseniorcitizen(RegistrationNumber,Name,disease,Medicine,DateofBirth,ContactNumber,CommunicationAddress,ProfilePic,EmergencyAddress,EmergencyContactnumber,AddedBy) values('$regnum','$namesc','$enferadd', '$mediciadd','$dob','$contnum','$commadd','$propic','$emeradd','$emercontnum','$addedby')");
echo "<p><script>Swal.fire({ title: 'ÉXITO', text: 'Registro exitoso', icon: 'success' , button: 'Cerrar' }).then(() => { window.location.href = 'add-scdetails.php'; });</script></p>";
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
                                    <h4 class="card-title"> Registro de personas</h4>
                                    <p class="card-description">
                                        Añadir detalles de personas en el Refugio
                                    </p>
                                    <form class="forms-sample" method="post" enctype="multipart/form-data">

                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Nombre de la persona</label>
                                            <input id="namesc" name="namesc" type="text" class="form-control"
                                                required="true" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Fecha de nacimiento</label>
                                            <input id="dob" name="dob" type="date" class="form-control" required="true"
                                                max="1970-01-01">
                                        </div>

                                        <div class="form-group">
                                            <label for="Enfermedad">Enfermedades</label>
                                            <input id="Enfermedad" name="Enfermedad" type="text" class="form-control"
                                                required="true" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="Medicina">Medicamentos Permanentes</label>
                                            <input id="Medicina" name="Medicina" type="text" class="form-control"
                                                required="true" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Número de contacto</label>
                                            <input id="contnum" name="contnum" type="text" class="form-control form-control-lg custom-input" pattern="\d{8,10}" maxlength="10" required="true" value="">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Dirección</label>
                                            <textarea class="form-control" id="commadd" name="commadd"
                                                rows="5"></textarea>

                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Foto de perfil</label>
                                            <input id="propic" name="propic" type="file" class="form-control"
                                                required="true" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Dirección de emergencia</label>

                                            <textarea class="form-control" id="emeradd" name="emeradd"
                                                rows="5"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Número de contacto en caso de
                                                emergencia</label>
                                            <input id="emercontnum" name="emercontnum" type="text"class="form-control form-control-lg custom-input" pattern="\d{8,10}" maxlength="10" required="true" value="">
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
    <script>
        document.getElementById('contnum').addEventListener('input', function(event) {
            let inputValue = event.target.value;
            let sanitizedValue = inputValue.replace(/[^0-9]/g, ''); // Elimina todo lo que no sean números

            // Limitar a 13 caracteres
            if (sanitizedValue.length > 10) {
                sanitizedValue = sanitizedValue.slice(0, 10);
            }

            // Actualizar el valor del campo de entrada
            event.target.value = sanitizedValue;
        });
        document.getElementById('emercontnum').addEventListener('input', function(event) {
            let inputValue = event.target.value;
            let sanitizedValue = inputValue.replace(/[^0-9]/g, ''); // Elimina todo lo que no sean números

            // Limitar a 13 caracteres
            if (sanitizedValue.length > 10) {
                sanitizedValue = sanitizedValue.slice(0, 10);
            }

            // Actualizar el valor del campo de entrada
            event.target.value = sanitizedValue;
        });
    </script>
</body>

</html>
<?php } ?>