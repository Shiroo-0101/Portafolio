<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Refugio Recuperacion de contraseña</title>
 
    <!-- Font Icon -->
    <link rel="stylesheet" href="../LoginAssets/fonts/material-icon/css/material-design-iconic-font.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.min.css" />
    <link rel="stylesheet" href="vendors/typicons/typicons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    <!-- Main css -->
    <link rel="stylesheet" href="../LoginAssets/css/style.css">
 
    <script type="text/javascript">
    function checkpass() {
        if (document.changepassword.newpassword.value != document.changepassword.confirmpassword.value) {
            Swal.fire({
                title: 'ERROR',
                text: 'El campo de nueva contraseña y confirmar contraseña no coinciden',
                icon: 'error',
                button: 'Cerrar'
            });
            document.changepassword.confirmpassword.focus();
            return false;
        }
        return true;
    }
    </script>
</head>
 
<body>
</br>
</br>
</br>
<?php
    session_start();
    error_reporting(0);
    include('includes/config.php');
 
    if(isset($_POST['submit'])) {
        $contactno = $_SESSION['contactno'];
        $user = $_SESSION['Usuario'];
        $password = $_POST['newpassword'];
        $hashpassword = hash('sha256', $password);
 
        $query = mysqli_query($con, "UPDATE tbladmin SET Password='$hashpassword' WHERE UserName='$user' AND MobileNumber='$contactno'");
 
        if($query) {
            echo "<script>
                    Swal.fire({
                        title: 'ÉXITO',
                        text: 'Tu contraseña ha cambiado correctamente.',
                        icon: 'success',
                        button: 'Cerrar'
                    }).then(function() {
                        window.location = 'index.php';
                    });
                </script>";
            session_destroy();
        } else {
            echo "<script>
                    Swal.fire({
                        title: 'ERROR',
                        text: 'Hubo un error al cambiar la contraseña. Por favor, intenta de nuevo.',
                        icon: 'error',
                        button: 'Cerrar'
                    });
                </script>";
        }
    }
    ?>
 
    </br>
 
    <!-- Sing in  Form -->
    <section class="sign-in">
        <div class="container">
            <div class="signin-content">
                <div class="signin-image">
                    <figure><img src="../Refugio_Logo.png" alt="sing up image"></figure>
                    <a href="index.php" class="signup-image-link">Login</a>
                </div>
 
                <div class="signin-form">
                    <h2 class="form-title">Admin Cambio de contraseña</h2>
                    <form method="POST" class="register-form" id="login-form" name="changepassword" onsubmit="return checkpass();">
                        <div class="form-group">
                            <label for="your_user"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="newpassword" id="newpassword" placeholder="Nueva Contraseña">
                        </div>
                        <div class="form-group">
                            <label for="your_phone"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirme su contraseña">
                        </div>
                        <div class="form-group form-button">
 
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Cambiar Contraseña" />
                        </div>
                    </form>
                   
                </div>
            </div>
        </div>
    </section>
 
 
    <!-- JS -->
    <script src="../LoginAssets/vendor/jquery/jquery.min.js"></script>
    <script src="../LoginAssets/js/main.js"></script>
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/todolist.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
 
 
</html>
