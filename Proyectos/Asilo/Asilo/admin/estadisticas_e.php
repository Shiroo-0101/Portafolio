<!DOCTYPE html>
<html lang="en">

<head>

    <title>Refugio Santa Virginia</title>
    <!-- base:css -->
    <link rel="stylesheet" href="vendors/typicons/typicons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    <!-- endinject -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    .navbar-breadcrumb .navbar-menu-wrapper, 
    .navbar-breadcrumb .navbar-menu-wrapper a, 
    .navbar-breadcrumb .navbar-menu-wrapper p, 
    .navbar-breadcrumb .navbar-menu-wrapper h4 {
        color: #fff;
    }
</style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.min.css" />
</head>

<body>
    <?php session_start();
error_reporting(0);
include_once('includes/config.php');

if($_GET['del']){
$scid=$_GET['id'];
mysqli_query($con,"delete from tblestadis where id ='$scid'");
echo "<script>
Swal.fire({
    title: 'Datos Eliminados',
    text: 'La entrada ha sido eliminada correctamente.',
    icon: 'success',
    confirmButtonText: 'OK'
}).then((result) => {
    if (result.isConfirmed) {
        window.location.href = 'estadisticas_e.php';
    }
});
</script>";          }
?>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <?php include_once('includes/header.php');?>
        <nav class="navbar-breadcrumb col-12 d-flex flex-column flex-md-row p-0">
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between w-100">
        <div class="d-flex align-items-center">
            <h4 class="mb-0 mr-md-4">Administrar Detalles de las Estadísticas</h4>
            <div class="d-none d-md-flex align-items-baseline">
                <p class="mb-0 mr-2">Inicio</p>
                <i class="typcn typcn-chevron-right mr-2"></i>
                <p class="mb-0">Administrar Detalles de las Estadísticas</p>
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
            <p class="mb-0">Administrar Detalles de las Estadísticas</p>
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
                        <div class="col-md-12">
                            <div class="card">
                                <h4 class="card-title" style="padding-left: 20px; padding-top: 20px;">Administrar
                                    Detalles de las Estadisticas</h4>
                                <p class="card-description" style="padding-left: 20px;">
                                </p>
                                <div class="table-responsive pt-3">

                                    <table class="table table-striped project-orders-table">
                                        <thead>
                                            <tr>
                                                <th class="ml-5">#</th>
                                                <th>Nombre</th>
                                                <th>Cantidad</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                         $query=mysqli_query($con,"select * from tblestadis");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>
                                            <tr>

                                                <td><?php echo htmlentities($cnt);?></td>
                                                <td><?php echo htmlentities($row['nombre']);?> </td>
                                                <td><?php echo htmlentities($row['cantidad']);?> </td>


                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <a href="edit_estadisticas.php?id=<?php echo $row['id']?>"
                                                            class="btn btn-success btn-sm btn-icon-text mr-3">Editar <i
                                                                class="typcn typcn-edit btn-icon-append"></i> </a>
                                                        <a href="#" onclick="confirmDelete(<?php echo $row['id']; ?>)"
                                                            class="btn btn-danger btn-sm btn-icon-text">Borrar <i
                                                                class="typcn typcn-delete-outline btn-icon-append"></i></a>
                                                    </div>
                                                </td>
                                            </tr><?php $cnt=$cnt+1; } ?>

                                        </tbody>
                                    </table>


                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                <script>
                // SweetAlert confirmation for delete action
                function confirmDelete(id) {
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "¡No podrás revertir esto!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, bórralo!',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'estadisticas_e.php?id=' + id + '&del=delete';
                        }
                    })
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