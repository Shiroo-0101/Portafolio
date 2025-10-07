<?php
session_start();
error_reporting(0);
include_once('includes/config.php');


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Refugio Santa Virginia</title>
    <!-- base:css -->
    <link rel="stylesheet" href="vendors/typicons/typicons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- endinject -->
    <!-- SweetAlert CSS -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
    .chart-container {
        position: relative;
        width: 100%;
        height: 0;
        padding-bottom: 60%;
        /* Establece la relación de aspecto deseada (16:9 en este caso) */
    }

    #myChart {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    @media (max-width: 767px) {
        .form-group {
            margin-bottom: 0.5rem;
        }
    }
    </style>

</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <?php include_once('includes/header.php'); ?>
        <!-- partial -->
        <nav class="navbar-breadcrumb col-xl-12 col-12 d-flex flex-row p-0">
            &nbsp;
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <ul class="navbar-nav mr-lg-2">
                    <li class="nav-item ml-0">
                        <h4 class="mb-0"> Detalles de las Estadísticas</h4>
                    </li>
                    <li class="nav-item">
                        <div class="d-flex align-items-baseline">
                            <p class="mb-0">Inicio</p>
                            <i class="typcn typcn-chevron-right"></i>
                            <p class="mb-0"> Detalles de las Estadísticas</p>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <?php include_once('includes/sidebar.php'); ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12">









                            <div class="card">
                                <h4 class="card-title" style="padding-left: 20px; padding-top: 20px;">Gráfica de
                                    Estadísticas</h4>
                                <div class="card-body">
                                    <div class="chart-container">
                                        <canvas id="myChart"></canvas>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
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
    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php
    $query = mysqli_query($con, "select * from tblestadis");
    $data = array();
    while ($row = mysqli_fetch_array($query)) {
        $data[] = array(
            'nombre' => $row['nombre'],
            'cantidad' => $row['cantidad']
        );
    }
    ?>

    <script>
    // Convert PHP data to JavaScript
    var data = <?php echo json_encode($data); ?>;

    // Extract labels and data
    var labels = data.map(function(item) {
        return item.nombre;
    });
    var quantities = data.map(function(item) {
        return item.cantidad;
    });

    // Create gradient for bars
    var ctx = document.getElementById('myChart').getContext('2d');
    var gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(0, 139, 207, 0.6)'); // Color azul para las barras
    gradient.addColorStop(1, 'rgba(0, 139, 207, 0.2)'); // Tono más claro de azul
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Cantidad',
                data: quantities,
                backgroundColor: gradient,
                borderColor: 'rgba(0, 139, 207, 1)', // Color azul para el borde de las barras
                borderWidth: 1,
                hoverBackgroundColor: 'rgba(0, 139, 207, 0.8)' // Tono más claro de azul al pasar el mouse
            }]
        },
        options: {
            scales: {
                y: {
                    responsive: true, // Hacer la gráfica responsiva
                    beginAtZero: true,
                    min: 0,
                    ticks: {
                        stepSize: 1,
                        precision: 0 // Ensure that the ticks are integers
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        font: {
                            size: 50
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Cantidad: ' + context.parsed.y;
                        }
                    }
                }
            },
            elements: {
                bar: {
                    borderWidth: 2,
                    borderRadius: 4,
                    borderSkipped: false
                }
            }
        }
    });
    </script>

</body>

</html>