<!DOCTYPE html>
<html lang="en">

<head>

    <title>Refugio Santa Virginia || Actualizar servicios</title>
    <!-- base:css -->
    <link rel="stylesheet" href="vendors/typicons/typicons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="vendors/select2/select2.min.css">
    <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- inject:css -->
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    <!-- endinject -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.min.css" />

    <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    <script type="text/javascript">
    bkLib.onDomLoaded(function() {
        new nicEditor({
            fullPanel: true
        }).panelInstance('emeradd');
    });
    </script>
      <script type="text/javascript">
    bkLib.onDomLoaded(function() {
        new nicEditor({
            fullPanel: true
        }).panelInstance('commadd');
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
$namesc=$_POST['namesc'];
$enfersc=$_POST['enferadd'];
$medisc=$_POST['mediadd'];
$dob=$_POST['dob'];
$contnum=$_POST['contnum'];
$commadd=$_POST['commadd'];
$emeradd=$_POST['emeradd'];
$emercontnum=$_POST['emercontnum'];
$id=intval($_GET['id']);
$sql=mysqli_query($con,"update tblseniorcitizen set Name='$namesc', disease='$enfersc' , Medicine='$medisc' ,DateofBirth='$dob', ContactNumber='$contnum',CommunicationAddress='$commadd',EmergencyAddress='$emeradd',EmergencyContactnumber='$emercontnum' where ID='$id'");
echo "<script>
Swal.fire({ 
    title: 'ÉXITO', 
    text: 'Registro actualizado con éxito', 
    icon: 'success', 
    button: 'Cerrar' 
}).then(() => {
    window.location.href = 'manage-scdetails.php'; 
});
</script>";

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
                                    <h4 class="card-title">Actualizar datos</h4>
                                    <p class="card-description">
                                        Actualizar datos
                                    </p>
                                    <form class="forms-sample" method="post">
                                        <?php
                    $id=intval($_GET['id']);
                         $query=mysqli_query($con,"select * from tblseniorcitizen where tblseniorcitizen.ID='$id'");

while($row=mysqli_fetch_array($query))
{
?>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Nombre de la persona</label>
                                            <input id="namesc" name="namesc" type="text" class="form-control"
                                                required="true" value="<?php echo htmlentities($row['Name']);?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="enferadd">Enfermedades</label>
                                            <input id="enferadd" name="enferadd" type="text" class="form-control"
                                                required="true" value="<?php echo htmlentities($row['disease']);?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="mediadd">Medicinas Permanentes</label>
                                            <input id="mediadd" name="mediadd" type="text" class="form-control"
                                                required="true" value="<?php echo htmlentities($row['Medicine']);?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Fecha de nacimiento</label>
                                            <input id="dob" name="dob" type="date" class="form-control" required="true"
                                                value="<?php echo htmlentities($row['DateofBirth']);?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Número de contacto</label>
                                            <input id="contnum" name="contnum" type="text" pattern="[0-9]+"
                                                maxlength="10" class="form-control" required="true"
                                                value="<?php echo htmlentities($row['ContactNumber']);?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Dirección</label>
                                            <textarea class="form-control" id="commadd" name="commadd"
                                                rows="5"><?php echo htmlentities($row['CommunicationAddress']);?></textarea>

                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Foto de perfil</label>

                                            <img src="images/<?php echo htmlentities($row['ProfilePic']);?>"
                                                width="250">
                                            <a href="change-image.php?id=<?php echo $row['ID'];?>">Cambiar imagen</a>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Dirección en caso de emergencia</label>

                                            <textarea class="form-control" id="emeradd" name="emeradd"
                                                rows="5"><?php echo htmlentities($row['EmergencyAddress']);?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Número de contacto en caso de
                                                emergencia</label>
                                            <input id="emercontnum" name="emercontnum" pattern="[0-9]+" maxlength="10"
                                                type="text" class="form-control" required="true"
                                                value="<?php echo htmlentities($row['EmergencyContactnumber']);?>">
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