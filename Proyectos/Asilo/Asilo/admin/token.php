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
</head>
 
<body>
</br>
</br>
</br>
<?php
session_start();
error_reporting(0);
date_default_timezone_set("America/El_Salvador");

include('includes/config.php');

if(isset($_POST['submit']))
  {
    $token=$_POST['Token'];

    $sql = "SELECT * FROM tokens WHERE token = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $token);
        $stmt->execute();
        $result = $stmt->get_result();
        $ver = $result->num_rows;
    if($ver>0){
      
        $query = "SELECT COUNT(*) FROM tokens WHERE token = ? ";
        $stmt = $con->prepare($query);
        $stmt->bind_param("i", $token);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();

        if ($count > 0) {
            // $contactno=$_SESSION['contactno'];
            // $email=$_SESSION['email'];
            echo "<script type='text/javascript'> document.location ='forgot-password.php'; </script>";
        }else
        {
            echo "<script>
            Swal.fire({
                title: 'ERROR',
                text: 'El token ya esta vencido. Por favor, inténtelo de nuevo.',
                icon: 'error',
                button: 'Cerrar'
                });
            </script>";
        }
     
    }
    else{
      echo "<script>
      Swal.fire({
          title: 'ERROR',
          text: 'El token no existe. Por favor, inténtelo de nuevo.',
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
                    <h2 class="form-title">Admin Validacion del Token</h2>
                    <form method="POST" class="register-form" id="login-form">
                        <div class="form-group">
                            <label for="your_token"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="Token" id="Token" placeholder="Token">
                        </div>
                        <div class="form-group form-button">
 
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Acceder" />
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