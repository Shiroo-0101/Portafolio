
<!DOCTYPE html>
<html lang="es">

<head>

    <title>Refugio Santa Virginia || Buscar Detalles de Ciudadanos Mayores</title>
    <!-- base:css -->
    <link rel="stylesheet" href="vendors/typicons/typicons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    <!-- endinject -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.min.css" />
</head>

<body>
<?php session_start();
error_reporting(0);
// Conexión a la base de datos
include('includes/config.php');
// Validación de la sesión
if(strlen($_SESSION['aid'])==0) { 
    header('location:login.php');
} else {
?>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <?php include_once('includes/header.php');?>
        <!-- partial -->
      <style>
    .navbar-breadcrumb .navbar-menu-wrapper, 
    .navbar-breadcrumb .navbar-menu-wrapper a, 
    .navbar-breadcrumb .navbar-menu-wrapper p, 
    .navbar-breadcrumb .navbar-menu-wrapper h4 {
        color: #fff;
    }
</style>

<nav class="navbar-breadcrumb col-12 d-flex flex-column flex-md-row p-0">
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between w-100">
        <div class="d-flex align-items-center">
            <h4 class="mb-0 mr-md-4">Buscar Detalles de personas en el refugio</h4>
            <div class="d-none d-md-flex align-items-baseline">
                <p class="mb-0 mr-2">Inicio</p>
                <i class="typcn typcn-chevron-right mr-2"></i>
                <p class="mb-0">Buscar Detalles de personas registradas</p>
            </div>
        </div>
        <div class="d-md-none">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#breadcrumbCollapse" aria-controls="breadcrumbCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
    <div class="collapse d-md-none" id="breadcrumbCollapse">
        <div class="mt-2 d-flex align-items-baseline">
            <p class="mb-0 mr-2">Inicio</p>
            <i class="typcn typcn-chevron-right mr-2"></i>
            <p class="mb-0">Buscar Detalles de personas registradas</p>
        </div>
    </div>
</nav>
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <?php include_once('includes/sidebar.php');?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <form class="forms-sample" method="post">
                            <!-- Agregar aquí contenido del formulario si es necesario -->
                        </form>

                        <div class="content-wrapper">
                            <div class="row">
                                <div class="col-md-12 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Búsqueda</h4>
                                            <p class="card-description">
                                                Buscar detalles de personas por número de registro y nombre
                                            </p>
                                            <form class="forms-sample" method="post">
                                                <div class="form-group">
                                                    <label for="exampleInputUsername1">Buscar por número de
                                                        registro o nombre</label>
                                                    <input type="text" id="searchdata" name="searchdata"
                                                        class="form-control" required="required" autofocus="autofocus">
                                                </div>
                                                <button type="submit" name="search"
                                                    class="btn btn-info btn-min-width mr-1 mb-1">Buscar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="card">
                                <div class="table-responsive pt-3">
                                    <?php
                    if(isset($_POST['search'])) { 
                      $sdata=$_POST['searchdata'];
                  ?>
                                    <h4 class="card-title" style="padding-left: 20px; padding-top: 20px;">Resultados
                                        para "<?php echo $sdata;?>"</h4>
                                    <table class="table table-striped project-orders-table">
                                        <thead>
                                            <tr>
                                                <th class="ml-5">#</th>
                                                <th>Número de Registro</th>
                                                <th>Nombre</th>
                                                <th>Enfermedades</th>
                                                <th>Medicinas Permanentes</th>
                                                <th>Número de Contacto</th>
                                                <th>Fecha de Nacimiento</th>
                                                <th> Direccion de emergencia</th>
                                                <th> Numero de emergencia</th>
                                                <th>Agregado Por</th>
                                                <th>Fecha de Registro</th>

                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
$query = mysqli_query($con, "SELECT * FROM tblseniorcitizen WHERE tblseniorcitizen.RegistrationNumber = '$sdata' OR tblseniorcitizen.Name LIKE '$sdata%'");
$num=mysqli_num_rows($query);
                         if($num>0){
                           $cnt=1;
                           while($row=mysqli_fetch_array($query)) {
                      ?>
                                            <tr>
                                                <td><?php echo htmlentities($cnt);?></td>
                                                <td><?php echo htmlentities($row['RegistrationNumber']);?> </td>
                                                <td><?php echo htmlentities($row['Name']);?> </td>
                                                <td><?php echo htmlentities($row['disease']);?> </td>
                                                <td><?php echo htmlentities($row['Medicine']);?> </td>
                                                <td><?php echo htmlentities($row['ContactNumber']);?> </td>
                                                <td><?php echo htmlentities($row['DateofBirth']);?> </td>
                                                <td><?php echo htmlentities($row['EmergencyAddress']);?> </td>
                                                <td><?php echo htmlentities($row['EmergencyContactnumber']);?> </td>
                                                <td><?php echo htmlentities($row['AddedBy']);?> </td>
                                                <td><?php echo htmlentities($row['RegitrationDate']);?></td>

                                                <img src="images/<?php echo htmlentities($row['ProfilePic']);?>"
                                                    width="150">

                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <a href="edit-scdetails.php?id=<?php echo $row['ID']?>"
                                                            class="btn btn-success btn-sm btn-icon-text mr-3">Editar <i
                                                                class="typcn typcn-edit btn-icon-append"></i> </a>
                            <a href="#" onClick="return confirmDelete(<?php echo $row['ID']?>)" class="btn btn-danger btn-sm btn-icon-text">Borrar <i class="typcn typcn-delete-outline btn-icon-append"></i></a>                          </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php 
                          $cnt=$cnt+1;
                         } 
                       } else { ?>
                                            <tr>
                                                <td colspan="8">
                                                    <script>
                                                    Swal.fire({
                                                        title: 'No se encontraron registros',
                                                        text: 'No se encontraron registros con este término de búsqueda',
                                                        icon: 'info',
                                                        confirmButtonText: 'Cerrar'
                                                    });
                                                    </script>
                                                    
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
    function confirmDelete(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Esta acción eliminará el registro de forma permanente.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, borrar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario confirma la eliminación, redirigir con el ID
                window.location.href = 'manage-scdetails.php?id=' + id + '&del=delete';
            }
        });

        // Detener el evento de clic por defecto
        return false;
    }
</script>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <?php include_once('includes/footer.php');?>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- base:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <script src="vendors/chart.js/Chart.min.js"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="js/dashboard.js"></script>
    <!-- End custom js for this page-->
</body>

</html>
<?php } ?>