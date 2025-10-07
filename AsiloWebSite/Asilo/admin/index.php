<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Refugio login</title>
 
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
include("includes/config.php");
 
// Conexión a la base de datos
if(isset($_POST['submit']))
{
    // Verificar si los campos están vacíos
    if(empty($_POST['username']) || empty($_POST['password'])) {
        echo "<script>Swal.fire({ title: 'ERROR', text: 'Por favor, completa todos los campos.', icon: 'info', button: 'Cerrar' });</script>";
     
       
    }else{
 
      $username = strtolower(filter_var($_POST['username'] ?? '', FILTER_SANITIZE_STRING));
   
      $password = $_POST['password'];
 
      $hashpassword = hash('sha256', $password);
     
      $ret = mysqli_query($con,"SELECT ID FROM tbladmin WHERE UserName='$username' and Password='$hashpassword'");
      $num = mysqli_fetch_array($ret);
     
      if($num > 0) {
          $_SESSION['alogin'] = $_POST['username'];
          $_SESSION['aid'] = $num['ID'];
 
          if(!empty($_POST["remember"])) {
              //COOKIES for username
              setcookie ("user_login",$_POST["username"],time()+ (10 * 365 * 24 * 60 * 60));
              //COOKIES for password
              setcookie ("userpassword",$_POST["password"],time()+ (10 * 365 * 24 * 60 * 60));
          } else {
              if(isset($_COOKIE["user_login"])) {
                  setcookie ("user_login","");
                  if(isset($_COOKIE["userpassword"])) {
                      setcookie ("userpassword","");
                  }
              }
          }
 
          header("location:dashboard.php");
      } else {
        echo "<script>Swal.fire({ title: 'ERROR', text: 'Usuario o Contraseña inválido.', icon: 'info', button: 'Cerrar' });</script>";
      }
 
 
    }
 
    // Si los campos no están vacíos, proceder con la autenticación
}
?>
 
    </br>
 
    <!-- Sing in  Form -->
    <section class="sign-in">
        <div class="container">
            <div class="signin-content">
                <div class="signin-image">
                    <figure><img src="../Refugio_Logo.png" alt="sing up image"></figure>
                    <a href="comproemail.php" class="signup-image-link">Recuperar Contraseña</a>
                </div>
 
                <div class="signin-form">
                    <h2 class="form-title">Admin Login</h2>
                    <form method="POST" class="register-form" id="login-form">
                        <div class="form-group">
                            <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="username" id="username" placeholder="Usuario"
                                value="<?php if(isset($_COOKIE["user_login"])) { echo $_COOKIE["user_login"]; } ?>">
                        </div>
                        <div class="form-group">
                            <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" id="password" placeholder="Contraseña"
                                required="true"
                                value="<?php if(isset($_COOKIE["userpassword"])) { echo $_COOKIE["userpassword"]; } ?>">
                        </div>
                        <div class="form-check">
 
                            <input type="checkbox" class="form-check-input" id="remember" name="remember"
                                <?php if(isset($_COOKIE["user_login"])) { ?> checked <?php } ?>>
                            <label for="remember" class="label-agree-term"><span><span></span></span>
                                Recordar Credenciales</label>
                            </label>
                        </div>
 
                        <div class="form-group form-button">
 
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Acceder" />
                        </div>
                    </form>
                    <div class="social-login">
                        <span class="social-label">Inicio</span>
                        <ul class="socials">
                            <a href="../index.php"><i class="display-flex-center zmdi zmdi-home zmdi-hc-2x"></i></a>
                        </ul>
                    </div>
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