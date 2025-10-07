
<!DOCTYPE html>
<html lang="en">

<head>
  
  <title>Refugio Santa Virginia || Actualizar Proyectos Requeridos</title>
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
    </script></head>

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
$id=intval($_GET['id']);
$sql=mysqli_query($con,"update proyectos set projecTitle='$sertitle',projectDescription='$serdes', money='$cantidad' where ID='$id'");

echo "<script>
Swal.fire({ 
    title: 'ÉXITO', 
    text: 'Producto Requerido actualizado con éxito', 
    icon: 'success', 
    button: 'Cerrar' 
}).then(() => {
    window.location.href = 'manage-donacion.php'; 
});
</script>";


}
?>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->

    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
          <a class="navbar-brand brand-logo" href="index.html"><img src="images/logo.svg" alt="logo"/></a>
          <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo-mini.svg" alt="logo"/></a>
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
  
      <!-- partial -->
      <!-- partial -->
      <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                  <h4 class="card-title"> Actualizar Proyectos Requeridos</h4>
                  <p class="card-description">
                  Actualizar Proyectos Requeridos
                  </p>
                  <form class="forms-sample" method="post">
                    <?php
                    $id=intval($_GET['id']);
                         $query=mysqli_query($con,"select * from proyectos where proyectos.ID='$id'");

while($row=mysqli_fetch_array($query))
{
?>
                    <div class="form-group">
                       <label for="exampleInputUsername1">Nombre del Proyecto</label>
                      <input id="sertitle" name="sertitle" type="text" class="form-control" required="true" value="<?php echo htmlentities($row['projecTitle']);?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Descripción del Proyecto</label>
                      <textarea class="form-control" name="serdes" id="serdes" rows="5"><?php echo htmlentities($row['projectDescription']);?></textarea>
                    </div>
                    <div class="form-group">
                                           <label for="exampleInputUsername1">Cantidad necesaria para el proyecto</label>
                                           <input id="cantidad" name="cantidad" type="number" class="form-control" required="true" value="<?php echo htmlentities($row['money']);?>">
                                        </div>
                    <div class="form-group">
                                            <label for="exampleInputE">Primera imagen</label>
</br>
<a href="change-projectimage.php?id=<?php echo $row['ID'];?>">Cambiar imagen</a>
</br>
                                            <img src="images/<?php echo htmlentities($row['image']);?>"
                                                width="250">
                                              

                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputE">Segunda imagen</label>
</br>
<a href="change-projectimage2.php?id=<?php echo $row['ID'];?>">Cambiar imagen</a>
</br>
                                            <img src="images/<?php echo htmlentities($row['image2']);?>"
                                                width="250">
                                              

                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputE">Tercera imagen</label>
</br>
<a href="change-projectimage3.php?id=<?php echo $row['ID'];?>">Cambiar imagen</a>
</br>
                                            <img src="images/<?php echo htmlentities($row['image3']);?>"
                                                width="250">
                                              

                                        </div>
                    <?php } ?>
                    <button type="submit" class="btn btn-primary mr-2" name="submit">Guardar</button>
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