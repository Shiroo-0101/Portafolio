<!DOCTYPE html>
<html lang="en">
 
<head>
 
  <title>Old Age Home Management System || Add Senior Details</title>
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
 
  <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
 
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.min.css" />
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
$nombre=$_POST['name'];
$stadistic=$_POST['estadistica'];
 
 
if (empty($nombre) || empty($stadistic))
{
    echo "<p><script>Swal.fire({ title: 'ERROR', text: 'No dejes espacios en blanco', icon: 'warning', button: 'Cerrar' });</script></p>";
}else {
 
  $query = mysqli_query($con, "SELECT COUNT(*) as total FROM tblestadis");
  $row = mysqli_fetch_assoc($query);
  $totalEstadis = $row['total'];
 
  if ($totalEstadis >= 4)
  {
    echo "<p><script>Swal.fire({ title: 'ERROR', text: 'Solo se permiten 4 estadisticas', icon: 'warning', button: 'Cerrar' });</script></p>";
  }else
  {
    $sql=mysqli_query($con,"insert into tblestadis(nombre, cantidad) values('$nombre','$stadistic')");
    if ($sql)
    {
      echo "<p><script>Swal.fire({ title: 'ÉXITO', text: 'Registro exitoso', icon: 'success', button: 'Cerrar' }).then(() => { window.location.href = 'estadisticas.php'; });</script></p>";
    }else {
      echo "<p><script>Swal.fire({ title: 'ERROR', text: 'Hubo un error al registrar los datos', icon: 'warning', button: 'Cerrar' });</script></p>";
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
 
      <script>
document.getElementById('phone').addEventListener('input', function(event) {
    let inputValue = event.target.value;
    let sanitizedValue = '';
 
    // Filtrar solo números, el signo '+' y el espacio
    for (let i = 0; i < inputValue.length; i++) {
        let char = inputValue[i];
        if (/[\d\+\s]/.test(char)) {  // Utilizamos \d para representar dígitos numéricos
            sanitizedValue += char;
        }
    }
 
    // Limitar a 13 caracteres
    if (sanitizedValue.length > 13) {
        sanitizedValue = sanitizedValue.slice(0, 13);
    }
 
    // Actualizar el valor del campo de entrada
    event.target.value = sanitizedValue;
});
</script>
     
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
                  <h4 class="card-title">Agragar estadisticas</h4>
                  <p class="card-description">
                    Agregar detalles de las estadisticas!!!
                  </p>
                  <form class="forms-sample" method="post" enctype="multipart/form-data">
                   
                    <div class="form-group">
                       <label for="exampleInputUsername1">Nombre de la estadistica</label>
                      <input id="name" name="name" type="text" class="form-control" required="true" value="">
                    </div>
                    <div class="form-group">
                       <label for="exampleInputUsername1">Estadistica</label>
                      <input id="estadistica" name="estadistica" type="number" class="form-control" required="true" value="">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2" name="submit">Agregar</button>
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