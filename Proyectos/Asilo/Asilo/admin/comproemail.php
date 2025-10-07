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

require_once("php-mailer/PHPMailer.php");
require_once("php-mailer/SMTP.php");
require_once("php-mailer/Exception.php");

use PHPMailer\PHPMailer\PHPMailer;

//Funcion para generar Token
function generate_numeric_token($length) {
    $token = "";
    for ($i = 0; $i < $length; $i++) {
        $token .= mt_rand(0, 9);
    }
    return $token;
}   

//Funcion para enviar correo
function sendMail($token, $email, $myemail, $mypassword) {

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = $myemail;
    $mail->Password = $mypassword;
    $mail->Port = 587;
    
    $mail->setFrom($myemail);
    $mail->addAddress($email);
    
    $mail->isHTML(true);
    $mail->Subject = "Consulta";
    $mail->Body = "Querido $email gracias por confiar en nosotros. Es un placer trabajar con usted, Nosotros no queremos que tenga ningun incoveniente. En este email nosotros le enviamos un codigo para mas seguridad y que pueda cambiar su contraseña. Su condigo tendra un tiempo de vencimiento asi que se le recomienda escribirlo lo mas pronto posible. Gracias. Recovery code: $token";

    if ($mail->send()) {
        return true;
    } else {
        return false;
    }
}

if(isset($_POST['submit'])) {
    $email = trim(strtolower($_POST['Email']));
    $token = generate_numeric_token(5);
    $expiration_time = 300;
    $expiration = date('Y-m-d H:i:s', time() + $expiration_time);

    $query = mysqli_query($con, "SELECT ID FROM tbladmin WHERE Email='$email'");
    if (!$query) {
        die("Error en la consulta: " . mysqli_error($con));
    }

    $ret = mysqli_fetch_array($query);
    if ($ret) {
        $query2 = mysqli_query($con, "INSERT INTO tokens (token, expiration) VALUES ('$token', '$expiration')");
        if ($query2) {
            $resultado = mysqli_query($con,"SELECT email, token FROM configmail WHERE id='3'");
            if($resultado && $resultado->num_rows > 0) {
                $row = mysqli_fetch_assoc($resultado);
                $myemail= $row['email'];
                $mypassword= $row['token'];
                if (sendMail($token, $email, $myemail, $mypassword)) {
                    echo "<script type='text/javascript'> document.location ='token.php'; </script>";
                } else {
                    echo "<script>Swal.fire('ERROR','No se pudo enviar el correo.','error');</script>";
                }
            } else {
                echo "<script>Swal.fire('ERROR','No se encontró la configuración del correo.','error');</script>";
            }
        } else {
            echo "<script>Swal.fire('ERROR','No se pudo insertar el token.','error');</script>";
        }
    } else {
        echo "<script>Swal.fire('ERROR','Email no existente.','error');</script>";
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
                    <h2 class="form-title">Admin Comprobacion de Email</h2>
                    <form method="POST" class="register-form" id="login-form">
                        <div class="form-group">
                            <label for="your_email"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="Email" id="Email" placeholder="Email">
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