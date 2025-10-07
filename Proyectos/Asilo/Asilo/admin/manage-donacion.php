<!DOCTYPE html>
<html lang="en">

<head>

    <title>Refugio Santa Virginia || Gestionar Productos Requeridos</title>
    <!-- base:css -->
    <link rel="stylesheet" href="vendors/typicons/typicons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    <!-- endinject -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php session_start();
error_reporting(0);
include_once('includes/config.php');

if($_GET['del']){
$serid=$_GET['id'];
mysqli_query($con,"delete from tbldonacion where ID ='$serid'");


echo "<script>
Swal.fire({ 
    title: 'ÉXITO', 
    text: 'Dato eliminado exitosamente', 
    icon: 'success', 
    button: 'Cerrar' 
}).then(() => {
    window.location.href = 'manage-donacion.php'; // Reemplaza 'pagina-destino.php' con la URL a la que deseas redirigir
});
</script>";
          }
?>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <?php include_once('includes/header.php');?>
        <!-- partial -->
        <nav class="navbar-breadcrumb col-xl-12 col-12 d-flex flex-row p-0">
            &nbsp;
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <ul class="navbar-nav mr-lg-2">
                    <li class="nav-item ml-0">
                        <h4 class="mb-0">Gestion de Productos Requeridos</h4>
                    </li>
                    <li class="nav-item">
                        <div class="d-flex align-items-baseline">
                            <p class="mb-0">Inicio</p>
                            <i class="typcn typcn-chevron-right"></i>
                            <p class="mb-0">Gestion de Productos Requeridos</p>
                        </div>
                    </li>
                </ul>

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
                                <h4 class="card-title" style="padding-left: 20px; padding-top: 20px;">Gestion de Productos Requeridos</h4>
                                <p class="card-description" style="padding-left: 20px;">
                                Gestion de Productos Requeridos
                                </p>
                                <div class="table-responsive pt-3">

                                    <table class="table table-striped project-orders-table">
                                        <thead>
                                            <tr>
                                                <th class="ml-5">#</th>
                                                <th>Nombre del producto</th>
                                                <th>Fecha de creación</th>
                                                <th>Imagen </th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                       

                         $query=mysqli_query($con,"select * from tbldonacion");
$cnt=1;

while($row=mysqli_fetch_array($query))
{
    $p_thumbnail = $row["Image"];
?>
                                            <tr>

                                                <td><?php echo htmlentities($cnt);?></td>
                                                <td><?php echo htmlentities($row['DonacionTitle']);?> </td>
                                                <td><?php echo htmlentities($row['CreationDate']);?></td>
                                                <td><img src="images/<?php echo htmlentities($p_thumbnail); ?>"
                                                        class="img-fluid" style="max-height: 70px;"></td>


                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <a href="edit-donacion1.php?id=<?php echo $row['ID']?>"
                                                            class="btn btn-success btn-sm btn-icon-text mr-3">Editar <i
                                                                class="typcn typcn-edit btn-icon-append"></i> </a>
                                                        <a href="#"
                                                            onClick="return confirmDelete(<?php echo $row['ID']?>)"
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
                function confirmDelete(id) {
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: 'Esta acción eliminará el elemento de forma permanente.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Sí, borrar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Si el usuario confirma la eliminación, redirige a manage-services.php con el ID
                            window.location.href = 'manage-donacion.php?id=' + id + '&del=delete';
                        }
                    });

                    // Detiene el evento de clic por defecto
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