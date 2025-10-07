<!DOCTYPE html>
<html lang="en">

<head>
  
  <title>Verifica tus datos</title>
  <!-- base:css -->
  <link rel="stylesheet" href="vendors/typicons/typicons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
 
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.min.css" />
</head>

<body>
<script type="text/javascript">
        function validar(e) { // 1
            tecla = (document.all) ? e.keyCode : e.which; // 2
            if (tecla == 8) return true; // 3
            patron = /[A-Za-z\s]/; // 4
            te = String.fromCharCode(tecla); // 5
            return patron.test(te); // 6
        }
    </script>
    <script type="text/javascript">
        function numeros(nu) { // 1
            tecla = (document.all) ? e.keyCode : e.which; // 2
            if (tecla == 8) return true; // 3
            ppatron = /\d/; // Solo acepta números// 4
            te = String.fromCharCode(tecla); // 5
            return patron.test(te); // 6
        }
    </script>
    <?php
include("includes/config.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conexion = new mysqli('localhost', 'jeremy', 'Shiroo2024', 'oahmsdb');
 
    if ($conexion->connect_error) {
        die("Connection failed: " . $conexion->connect_error);
    }
 
    $usuario = strtolower(filter_var($_POST['User'], FILTER_SANITIZE_STRING));
    $nombre = strtolower(filter_var($_POST['nombre'], FILTER_SANITIZE_STRING));
    $correo = strtolower(filter_var($_POST['email'], FILTER_SANITIZE_STRING));
    $password = $_POST['pwd'];
    $password2 = $_POST['pwd1'];

    if (empty($usuario) || empty($nombre) || empty($correo) || empty($password) || empty($password2)) {
        echo "<p><script>Swal.fire({ title: 'ERROR', text: 'No dejes espacios en blanco', icon: 'warning', button: 'Cerrar' });</script></p>";
    } else {
        $result = $conexion->query("SELECT * FROM tbladmin WHERE UserName = '$usuario' LIMIT 1");
 
        if ($result->num_rows > 0) {
            echo "<p><script>Swal.fire({ title: 'ERROR', text: 'Este nombre de usuario ya existe', icon: 'warning', button: 'Cerrar' });</script></p>";
        } else {
            if (!preg_match("/^(?=.*[!@#$%^&*])(?=.*[A-Z])/", $password) || !preg_match("/^(?=.*[!@#$%^&*])(?=.*[A-Z])/", $password2)) {
                echo "<p><script>Swal.fire({ title: 'ERROR', text: 'La contraseña debe contener al menos un carácter especial y una letra mayúscula', icon: 'warning', button: 'Cerrar' });</script></p>";
            } else {
                $password = md5($password);
                $password2 = md5($password2);
 
                if ($password !== $password2) {
                    echo "<p><script>Swal.fire({ title: 'ERROR', text: 'Las contraseñas no coinciden', icon: 'warning', button: 'Cerrar' });</script></p>";
                } else {
                    $insert = $conexion->query("INSERT INTO tbladmin (AdminName, UserName, Email, Password ) VALUES ('$nombre', '$usuario', '$correo', '$password')");
 
                    if ($insert === TRUE) {
                        echo "<p><script>Swal.fire({ title: 'ÉXITO', text: 'Registro exitoso', icon: 'success', button: 'Cerrar' }).then(() => { window.location.href = 'login.php'; });</script></p>";
                    } else {
                        echo "Error: " . $conexion->error;
                    }
                }
            }
        }
    }
 
    $conexion->close();
}
?>


  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <h3 style="color:seagreen;">Refugio Santa Virginia Centurione Bracelli</h3>
              
              <h6 class="font-weight-light">Registra tus datos para continuar.</h6>
              <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg border-left-0" onkeypress="return validar(event)" required="required" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : ''; ?>"/>
                  
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg border-left-0" onkeypress="return validar(event)" required="required" name="User" id="User" placeholder="Usuario"   value="<?php echo isset($_POST['User']) ? $_POST['User'] : ''; ?>">
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg border-left-0" onkeypress="return validar(event)" required="required" id="email" name="email" placeholder="Correo Electronico"  value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                        
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg border-left-0"  id="pwd" name="pwd" minlength="5" maxlength="10" placeholder="Contraseña"  required="required" value="<?php echo isset($_POST['pwd']) ? $_POST['pwd'] : ''; ?>">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg border-left-0"  id="pwd1" name="pwd1" minlength="5" maxlength="10" placeholder="Repetir Contraseña"  required="required" value="<?php echo isset($_POST['pwd1']) ? $_POST['pwd1'] : ''; ?>">
                </div>
                <div class="mt-3">
                  <input type="submit" class="btn btn-block btn-info btn-lg font-weight-medium auth-form-btn" name="submit" value="Registrarme"></input>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                       <input type="checkbox" class="form-check-input" id="remember" name="remember" <?php if(isset($_COOKIE["user_login"])) { ?> checked <?php } ?>>
                      Recordar Mis Datos
                    </label>
                  </div>
                  <a href="forgot-password.php" class="auth-link text-black">Olvidó su contraseña?</a>
                </div>
               <a href="../index.php" class="auth-link text-black">Pagina de Inicio</a>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>
