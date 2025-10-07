<!DOCTYPE html>
<html lang="en">
 
<head>
 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Asilo Registro</title>
 
    <!-- Font Icon -->
    <link rel="stylesheet" href="../LoginAssets/fonts/material-icon/css/material-design-iconic-font.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.min.css" />
    <link rel="stylesheet" href="vendors/typicons/typicons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    <!-- Main css -->
    <link rel="stylesheet" href="vendors/typicons/typicons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
 
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    <link rel="stylesheet" href="../LoginAssets/css/style.css">
</head>
 
<body>
</br>
</br>
</br>
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
 
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include("includes/config.php");
 
    $usuario = strtolower(filter_var($_POST['User'] ?? '', FILTER_SANITIZE_STRING));
    $nombre = strtolower(filter_var($_POST['nombre'] ?? '', FILTER_SANITIZE_STRING));
    $correo = strtolower(filter_var($_POST['email'] ?? '', FILTER_SANITIZE_STRING));
    $tel = strtolower(filter_var($_POST['phone'] ?? '', FILTER_SANITIZE_STRING));
 
    $password = $_POST['pwd'] ?? '';
    $password2 = $_POST['pwd1'] ?? '';
 
    if (empty($usuario) || empty($nombre) || empty($correo) || empty($password) || empty($password2)|| empty($tel)) {
        echo "<p><script>Swal.fire({ title: 'ERROR', text: 'No dejes espacios en blanco', icon: 'info', button: 'Cerrar' });</script></p>";
    } else {
        $result = $con->query("SELECT * FROM tbladmin WHERE UserName = '$usuario' LIMIT 1");
 
        if ($result->num_rows > 0) {
            echo "<p><script>Swal.fire({ title: 'ERROR', text: 'Este nombre de usuario ya existe', icon: 'warning', button: 'Cerrar' });</script></p>";
        } else {
            if (!preg_match("/^(?=.*[!@#$%^&*])(?=.*[A-Z])/", $password) || !preg_match("/^(?=.*[!@#$%^&*])(?=.*[A-Z])/", $password2)) {
                echo "<p><script>Swal.fire({ title: 'ERROR', text: 'La contraseña debe contener al menos un carácter especial y una letra mayúscula', icon: 'warning', button: 'Cerrar' });</script></p>";
            } else {
 
                if ($password !== $password2) {
                    echo "<p><script>Swal.fire({ title: 'ERROR', text: 'Las contraseñas no coinciden', icon: 'warning', button: 'Cerrar' });</script></p>";
                } else {
                    $hashpassword = hash('sha256', $password);
                    $insert = $con->query("INSERT INTO tbladmin (AdminName, UserName, MobileNumber, Email, Password ) VALUES ('$nombre', '$usuario', '$tel', '$correo', '$hashpassword')");
 
                    if ($insert === TRUE) {
                        echo "<p><script>Swal.fire({ title: 'ÉXITO', text: 'Registro exitoso', icon: 'success', button: 'Cerrar' }).then(() => { window.location.href = 'index.php'; });</script></p>";
                    } else {
                        echo "Error: " . $con->error;
                    }
                }
            }
        }
    }
 
    $con->close();
}
?>
    <!-- Sign up form -->
    <section class="signup">
        <div class="container">
            <div class="signup-content">
                <div class="signup-form">
                    <h2 class="form-title">Registro</h2>
                    <form method="POST" class="register-form" id="register-form">
                        <div class="form-group">
                            <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="nombre" id="nombre" onkeypress="return validar(event)"
                                required="required" placeholder="Nombre"
                                value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : ''; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="User" id="User" required="required" placeholder="Usuario"
                                minlength="5" maxlength="10"
                                value="<?php echo isset($_POST['User']) ? $_POST['User'] : ''; ?>">
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-email"></i></label>
                            <input type="email" name="email" id="email" required="required" placeholder="Gmail"
                                value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                        </div>
                        <div class="form-group">
                            <label for="phone"><i class="zmdi zmdi-email"></i></label>
                            <input type="number" name="phone" id="phone" required="required" placeholder="Telefono"
                            pattern="\d{8,10}"  value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : ''; ?>">
                        </div>
                        <div class="form-group">
                            <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="pwd" id="pwd" minlength="5" maxlength="15"
                                placeholder="Contraseña" required="required"
                                value="<?php echo isset($_POST['pwd']) ? $_POST['pwd'] : ''; ?>">
                        </div>
                        <div class="form-group">
                            <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                            <input type="password" name="pwd1" id="pwd1" minlength="5" maxlength="15"
                                placeholder="Repetir contraseña" required="required"
                                value="<?php echo isset($_POST['pwd1']) ? $_POST['pwd1'] : ''; ?>">
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Registrarse" />
                        </div>
                        <div class="form-check">
 
                            <input type="checkbox" class="form-check-input" id="remember" name="remember"
                                <?php if(isset($_COOKIE["user_login"])) { ?> checked <?php } ?>><label for="remember"
                                class="label-agree-term"><span><span></span></span>
                                Recordar Credenciales</label>
                            </label>
                        </div>
                    </form>
                </div>
 
                <div class="signup-image">
                    <figure><img src="../Refugio_Logo.png" alt="sing up image"></figure>
 
                    </br>
 
 
                    <ul class="socials">
 
                        <span class="social-label">Login</span>
                        <a href="index.php"><i class="display-flex-center zmdi zmdi-account zmdi-hc-2x"></i></a>
                    </ul>
                </div>
 
            </div>
 
        </div>
 
    </section>
    <script>
        document.getElementById('phone').addEventListener('input', function(event) {
            let inputValue = event.target.value;
            let sanitizedValue = inputValue.replace(/[^0-9]/g, ''); // Elimina todo lo que no sean números
 
            // Limitar a 13 caracteres
            if (sanitizedValue.length > 10) {
                sanitizedValue = sanitizedValue.slice(0, 10);
            }
 
            // Actualizar el valor del campo de entrada
            event.target.value = sanitizedValue;
        });
       
    </script>
 
    <!-- Sing in  Form -->
    <script>
    function validateEmail() {
        var emailInput = document.getElementById('email');
        var email = emailInput.value;
 
        // Expresión regular para validar el correo electrónico
        var emailRegex = /^[\w-]+(?:\.[\w-]+)*@(?:gmail\.com|yahoo\.com|outlook\.com)$/;
 
        // Validar el correo electrónico
        if (!emailRegex.test(email)) {
            return false; // Detener el envío del formulario si el correo electrónico no es válido
        }
        return true; // Permitir el envío del formulario si el correo electrónico es válido
    }
 
    // Agregar un listener al evento submit del formulario para llamar a la función de validación
    document.getElementById('login-form').addEventListener('submit', function(event) {
        if (!validateEmail()) {
            event
                .preventDefault(); // Detener el envío del formulario si la validación del correo electrónico falla
        }
    });
    </script>
 
    <!-- endinject -->
</body>
 
</html>