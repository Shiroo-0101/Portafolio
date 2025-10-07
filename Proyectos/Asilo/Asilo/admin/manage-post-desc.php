<?php 
session_start();
error_reporting(0);
include_once('includes/config.php');

if (strlen($_SESSION['aid'] == 0)) {
    header('location:logout.php');
    exit();
} else {
    if (isset($_POST['submit'])) {
        $pagetitle = $_POST['pagetitle'];
        $pagedes = $_POST['pagedes'];
        $query = mysqli_query($con, "UPDATE tblpage SET PageTitle='$pagetitle', PageDescription='$pagedes' WHERE PageType='aboutus'");
        if ($query) {
            echo '<script>alert("About Us has been updated.")</script>';
        } else {
            echo '<script>alert("Something Went Wrong. Please try again.")</script>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Refugio Santa Virginia || Acerca de nosotros</title>
    <link rel="stylesheet" href="vendors/typicons/typicons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="vendors/select2/select2.min.css">
    <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            color: #333333;
        }
        tr:nth-child(even) {
            background-color: #ffffff;
        }
        .btn-edit, .btn-delete {
            padding: 5px 10px;
            margin: 2px;
            border: none;
            cursor: pointer;
            border-radius: 3px;
            text-transform: uppercase;
        }
        .btn-edit {
            background-color: #4caf50;
            color: #ffffff;
        }
        .btn-delete {
            background-color: #f44336;
            color: #ffffff;
        }
    </style>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.min.css" />

</head>
<body>
    <div class="container-scroller">
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
            <?php include_once('includes/header.php'); ?>
        </nav>

        <div class="container-fluid page-body-wrapper">
            <?php include_once('includes/sidebar.php'); ?>

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>S.No.</th>
                                                   
                                                    <th>Descripcion de la noticia</th>
                                                    <th>Foto de la noticia</th>
                                                    <th>Accion</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                include_once('includes/config.php');
                                                $result = mysqli_query($con, "SELECT * FROM post_description ORDER BY p_id DESC");
                                                $i = 1;
                                                while ($rows = mysqli_fetch_assoc($result)) {
                                                    $p_heading = $rows["p_heading"];
                                                   
                                                    $p_thumbnail = $rows["p_thumbnail"];
                                                    $p_id = $rows["p_id"];
                                                    $p_cat = $rows["p_category"];
                                                ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo ucwords($p_heading); ?></td>
                                                        
                                                        <td><img src="upload/thumbnail/<?php echo $p_thumbnail; ?>" class="img-fluid" style="max-height: 70px;"></td>
                                                        <td>
                                                            <a href='edit-post-desc.php?id=<?php echo $p_id; ?>' class='btn-edit'>Editar</a>
                                                           <a href="#" onClick="return confirmDelete(<?php echo $p_id; ?>, '<?php echo $p_cat; ?>')" class='btn-delete'>Eliminar</a>

                                                        </td>
                                                    </tr>
                                                <?php 
                                                    $i++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
    function confirmDelete(id, category) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Esta acción eliminará el post de forma permanente.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario confirma la eliminación, redirige a delete-post.php con los parámetros del ID y la categoría
                window.location.href = 'delete-post.php?id=' + id + '&category=' + category;
            }
        });

        // Detener el evento de clic por defecto
        return false;
    }
</script>

        <?php include_once('includes/footer.php'); ?>

    </div>

    <script src="vendors/js/vendor.bundle.base.js"></script>
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/todolist.js"></script>
    <script src="vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <script src="vendors/select2/select2.min.js"></script>
    <script src="js/file-upload.js"></script>
    <script src="js/typeahead.js"></script>
    <script src="js/select2.js"></script>
</body>
</html>
<?php } ?>
