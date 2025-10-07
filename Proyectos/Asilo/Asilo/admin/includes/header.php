<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex justify-content-center fondo-celeste">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
            <a class="navbar-brand brand-logo" href="dashboard.php">
                <strong style="color: white;">
                    <img src="../Refugio_Logo.png" alt="Refugio" style="width:80px;height:80px;">
                </strong>
            </a>
            <a class="navbar-brand brand-logo-mini" href="">
                <img src="../Refugio_Logo.png" alt="logo" />
            </a>
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="typcn typcn-th-menu"></span>
            </button>
        </div>
    </div>
    <style>
    .fondo-celeste {
        background-color: #ADD8E6;
        /* Puedes cambiar el valor hexagonal por el color celeste que desees */
    }
    </style>
 
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav mr-lg-2">
            <li class="nav-item nav-profile dropdown">
                <?php
 
// Check if the session variable 'aid' is set
if(isset($_SESSION['aid'])) {
    $adid = $_SESSION['aid'];
 
    // Run the query
    $ret = mysqli_query($con, "SELECT AdminName FROM tbladmin WHERE ID='$adid'");
 
    // Check if the query returned a result
    if($ret && mysqli_num_rows($ret) > 0) {
        $row = mysqli_fetch_array($ret);
        $name = $row['AdminName'];
    } else {
        // Handle case where no result is returned
        $name = "Usuario no valido"; // You can set a default value or handle it as needed
    }
} else {
    // Handle case where 'aid' is not set in session
    $name = "No ha iniciado sesion"; // You can set a default value or handle it as needed
}
?>
 
                <a class="nav-link" href="#" data-toggle="dropdown" id="profileDropdown">
                    <img src="images/faces/face5.jpg" alt="profile" />
                    <span class="nav-profile-name"><?php echo htmlspecialchars($name); ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="profile.php">
                        <i class="typcn typcn-cog-outline text-primary"></i>
                        Perfil
                    </a>
                    <a class="dropdown-item" href="change-password.php">
                        <i class="typcn typcn-cog-outline text-primary"></i>
                        Cambiar Contraseña
                    </a>
                    <a class="dropdown-item" href="logout.php">
                       
                        <i class="typcn typcn-eject text-primary"></i>
                        Cerrar Sesión
                    </a>
                </div>
            </li>
            <li class="nav-item nav-user-status dropdown">
                (<h6 class="mb-0">Hora: <?php date_default_timezone_set('America/El_Salvador'); echo date('H:i:s'); ?></h6>)
            </li>
        </ul>
 
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="typcn typcn-th-menu"></span>
        </button>
    </div>
</nav>
 
<script type="text/javascript">
$(document).ready(function() {
    setInterval(runningTime, 1000);
});
 
function runningTime() {
    $.ajax({
        url: 'timeScript.php',
        success: function(data) {
            $('#runningTime').html(data);
        },
    });
}
</script>