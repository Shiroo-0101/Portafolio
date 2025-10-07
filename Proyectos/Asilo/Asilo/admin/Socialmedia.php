
<!DOCTYPE html>
<html lang="en">

<head>
  
  <title>Refugio Santa Virginia || Página de links </title>
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
   
    $Youtube1=$_POST['multimedia1'];

    $Youtube2=$_POST['multimedia2'];
    $Youtube3=$_POST['multimedia3'];
    $GoogleM=$_POST['Google'];

$twitterX=$_POST['twitter'];
$Facebook=$_POST['facebook'];
 $instagram=$_POST['insta'];
     $query=mysqli_query($con,"update socialmedialinks set Twitter='$twitterX',Facebook='$Facebook',Instagram='$instagram' ,Youtube='$Youtube1' ,Youtubee='$Youtube2' ,Youtubeee='$Youtube3' ,GoogleMaps='$GoogleM' where  PageType='Links'");
    if ($query) {
 
      echo "<script>
      Swal.fire({
          title: 'ÉXITO',
          text: 'Links han sido actualizados.',
          icon: 'success',
          button: 'Cerrar'
      });
  </script>";  }
  else
    {
      echo "<script>
      Swal.fire({
          title: 'ERROR',
          text: 'Algo salió mal. Por favor, inténtelo de nuevo.',
          icon: 'error',
          button: 'Cerrar'
      });
  </script>";    }
  
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
      <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Links de redes sociales y multimedia del sitio</h4>
                  <p class="card-description">
       Refugio Santa Virginia
                  </p>
                  <form class="forms-sample" method="post">
                    <?php
                
$ret=mysqli_query($con,"select * from  socialmedialinks where Pagetype='Links'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
                    <div class="form-group">
                    <label for="exampleInputUsername1">Tipo de página</label>
                      <input id="pagetitle" name="pagetitle" type="text" class="form-control" value="<?php echo $row['Pagetype']; ?>" readonly>                    </div>
                    <div class="form-group">
                      <label for="exampleInput"> Link de Twitter </label>
                     <input type="text" class="form-control" name="twitter" value="<?php  echo $row['Twitter'];?>" required='true'>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Link de Facebook </label>
                     <input type="text" class="form-control" name="facebook" value="<?php  echo $row['Facebook'];?>" required='true'>
                    </div>
                  
                    <div class="form-group">
                      <label for="exampleInputUsername1">Link de Instagram </label>
                     <input type="text" class="form-control" name="insta" value="<?php  echo $row['Instagram'];?>" required='true'>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Link de Google Maps </label>
                     <input type="text" class="form-control" name="Google" value="<?php  echo $row['GoogleMaps'];?>" required='true'>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Link de multimedia 1  </label>
</br>
                      <label for="exampleInputUsername1">Seccion de inicio llamada: Refugio Santa Virginia   </label>
                     <input type="text" class="form-control" name="multimedia1" value="<?php  echo $row['Youtube'];?>" required='true'>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Link de multimedia 2  </label>
</br>
                      <label for="exampleInputUsername1">Seccion de inicio llamada: La Responsabilidad de Ayudar al Prójimo   </label>
                     <input type="text" class="form-control" name="multimedia2" value="<?php  echo $row['Youtubee'];?>" required='true'>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Link de multimedia 3  </label>
</br>
                      <label for="exampleInputUserna">Seccion de donaciones llamada: Donaciones a Refugio Santa Virginia  </label>
                     <input type="text" class="form-control" name="multimedia3" value="<?php  echo $row['Youtubeee'];?>" required='true'>
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