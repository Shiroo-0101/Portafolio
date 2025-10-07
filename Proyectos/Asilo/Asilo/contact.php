<!doctype html>
<html lang="en">

<head>
    <title>Refugio &mdash;Santa Virginia </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&family=Playfair+Display:wght@400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="build/css/intlTelInput.css">



    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.min.css" />
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">


<?php
include('includes/config.php');
session_start();
error_reporting(0);

require_once("php-mailer/PHPMailer.php");
require_once("php-mailer/SMTP.php");
require_once("php-mailer/Exception.php");

use PHPMailer\PHPMailer\PHPMailer;

function sendMail($fname, $lname, $phone, $email, $message, $myemail, $mypassword) {
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = $myemail;
    $mail->Password = $mypassword;
    $mail->Port = 587;
    
    $mail->setFrom($email, $fname);
    $mail->addAddress($myemail);
    
    $mail->isHTML(true);
    $mail->Subject = "Consulta";
    $mail->Body = "<b>Name:</b> {$fname}<br><b>Apellido:</b> {$lname}<br><br><b>Numero de telefono:</b> {$phone}<br><br><b>Mail:</b> {$email}<br><br><b>Message:</b><br><br>{$message}";

    return $mail->send();
}

if(isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    
    if (empty($fname) || empty($lname) || empty($phone) || empty($email) || empty($message)) {
        echo "<p><script>Swal.fire({ title: 'ERROR', text: 'No dejes espacios en blanco', icon: 'warning', button: 'Cerrar' });</script></p>";
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<p><script>Swal.fire({ title: 'ERROR', text: 'El formato del correo electrónico no es válido', icon: 'warning', button: 'Cerrar' });</script></p>";
        } else {
            if (!preg_match('/^\+?[0-9\s]{7,13}$/', $phone)) {
                echo "<p><script>Swal.fire({ title: 'ERROR', text: 'El formato del teléfono no es válido', icon: 'warning', button: 'Cerrar' });</script></p>";
            } else {
                $resultado = mysqli_query($con, "SELECT email, token FROM configmail WHERE id='3'");
                if ($resultado->num_rows > 0) {
                    $row = mysqli_fetch_assoc($resultado);
                    $myemail = $row['email'];
                    $mypassword = $row['token'];
                    $query = mysqli_query($con, "INSERT INTO tblcontact (FirstName, LastName, Phone, Email, Message) VALUES ('$fname', '$lname', '$phone', '$email', '$message')");
                    if ($query) {
                        if (sendMail($fname, $lname, $phone, $email, $message, $myemail, $mypassword)) {
                            echo "<p><script>Swal.fire({ title: 'ÉXITO', text: 'Registro exitoso y correo enviado', icon: 'success', button: 'Cerrar' }).then(() => { window.location.href = 'contact.php'; });</script></p>";
                        } else {
                            echo "<p><script>Swal.fire({ title: 'ERROR', text: 'Hubo un problema al enviar el correo', icon: 'warning', button: 'Cerrar' });</script></p>";
                        }
                    } else {
                        echo "<p><script>Swal.fire({ title: 'ERROR', text: 'Hubo un error al registrar los datos', icon: 'warning', button: 'Cerrar' });</script></p>";
                    }
                } else {
                    echo "<p><script>Swal.fire({ title: 'ERROR', text: 'Hubo un error al encontrar los datos', icon: 'warning', button: 'Cerrar' });</script></p>";
                }
            }
        }
    }
}
?>




    <div id="overlayer"></div>
    <div class="loader">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>


    <div class="site-wrap">

        <div class="site-mobile-menu site-navbar-target">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>


        <?php
    include ('header.php');
    ?>

        <!-- MAIN -->


        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php
    // Conexión a la base de datos
    include('includes/config.php');

    // Consulta para obtener las imágenes de la base de datos
    $consulta = "SELECT imagen FROM slides";
    $resultado = mysqli_query($con, $consulta);

    $primer = true; // Variable para controlar el primer elemento del carrusel

    // Recorre los resultados y genera el código HTML para cada imagen
    while ($fila = mysqli_fetch_assoc($resultado)) {
      $imagen = $fila['imagen'];
      if ($primer) {
        echo '<div class="carousel-item active">';
        $primer = false;
      } else {
        echo '<div class="carousel-item">';
      }
      echo '<div class="slide-item overlay" style="background-image: url(\'/Asilo/Asilo/admin/images/'.$imagen.'\')">';
      echo '<div class="container">';
      echo '<div class="row">';
      echo '<div class="col-lg-6 align-self-center">';
      echo '<h1 class="heading mb-3"><strong>Contacto  <br> </strong></h1>';
      echo '<p class="lead text-white mb-5">Refugio de ancianos Santa Virginia</p>';
 
      echo '</div>';
      echo '</div>';
      echo '</div>';
      echo '</div>';
      echo '</div>';
    }

    // Cierra la conexión a la base de datos
    mysqli_close($con);
    ?>
            </div>

            <!-- Indicadores -->
            <ol class="carousel-indicators">
                <?php
    // Contador para los indicadores
    $contador = 0;
    // Volver a obtener los resultados
    mysqli_data_seek($resultado, 0);
    // Recorrer los resultados para generar los indicadores
    while ($fila = mysqli_fetch_assoc($resultado)) {
      echo '<li data-target="#carouselExampleSlidesOnly" data-slide-to="'.$contador.'"';
      // Si es el primer elemento, añadir la clase active
      if ($contador == 0) {
        echo ' class="active"';
      }
      echo '></li>';
      $contador++;
    }
    ?>
            </ol>
        </div>

        <script> 
      $('#mensaje_ayuda').text('20 carácteres restantes');
  $('#message').keydown(function () {
      var max = 20;
      var len = $(this).val().length;
      if (len >= max) {
          $('#mensaje_ayuda').text('Has llegado al límite');// Aquí enviamos el mensaje a mostrar          
          $('#mensaje_ayuda').addClass('text-danger');
          $('#message').addClass('is-invalid');
          $('#inputsubmit').addClass('disabled');    
          document.getElementById('inputsubmit').disabled = true;                    
      } 
      else {
          var ch = max - len;
          $('#mensaje_ayuda').text(ch + ' carácteres restantes');
          $('#mensaje_ayuda').removeClass('text-danger');            
          $('#message').removeClass('is-invalid');            
          $('#inputsubmit').removeClass('disabled');
          document.getElementById('inputsubmit').disabled = false;            
      }
  });  
    </script>
    


        <?php
include('includes/config.php');
$start_id = 1;
$end_id = 4;
?>

        <div class="site-section bg-primary count-numbers">
            <div class="container">
                <div class="row">
                    <?php
for ($id = $start_id; $id <= $end_id; $id++) {
    // Preparar la declaración SQL
    $stmt = $con->prepare("SELECT * FROM tblestadis WHERE id = ?");
    $stmt->bind_param("i", $id); // "i" indica que el parámetro es un entero
    $stmt->execute();
    $result = $stmt->get_result();
    $data = [];

    // Inicializar el array para almacenar los datos
    if ($result->num_rows > 0) {
        // Almacenar el dato específico en la variable $data
        $data = $result->fetch_assoc();
    } else {
        $data = null;
    }
    ?>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                        <div class="counter-wrap text-center">
                            <strong class="counter d-block">
                                <?php if ($id == 2): ?>
                                <span>$</span>
                                <?php endif; ?>
                                <span class="number"
                                    data-number="<?php echo htmlspecialchars($data['cantidad']); ?>"></span>
                            </strong>
                            <strong> <span data="<?php echo htmlspecialchars($data['nombre']); ?>">
                                    <?php echo htmlspecialchars($data['nombre']); ?></strong>
                            </span>
                        </div>
                    </div>
                    <?php
    $stmt->close();
}
?>
                </div>
            </div>
        </div>
    </div>



    </br>

    <div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mb-5">
                <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <div class="row form-group">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="text-black" for="fname">Nombre</label>
                            <input type="text" name="fname" id="fname" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="text-black" for="lname">Apellido</label>
                            <input type="text" name="lname" id="lname" class="form-control">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <label class="text-black" for="email">Gmail</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <label class="text-black" for="phone">Telefono</label>
                            <div class="form-group-row">
                                <div class="form-group-col-md-12">
                                    <input type="text" name="phone" id="phone" class="form-control">
                                </div>
                            </div>
                            <script>
                                document.getElementById('phone').addEventListener('input', function(event) {
                                    let inputValue = event.target.value;
                                    let sanitizedValue = '';

                                    // Filtrar solo números, el signo '+' y el espacio
                                    for (let i = 0; i < inputValue.length; i++) {
                                        let char = inputValue[i];
                                        if (/[\d\+\s]/.test(char)) {
                                            sanitizedValue += char;
                                        }
                                    }

                                    // Limitar a 13 caracteres
                                    if (sanitizedValue.length > 13) {
                                        sanitizedValue = sanitizedValue.slice(0, 13);
                                    }

                                    // Actualizar el valor del campo de entrada
                                    event.target.value = sanitizedValue;
                                });
                            </script>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <label class="text-black" for="message">Mensaje</label>
                            <textarea name="message" id="message" cols="30" rows="7" maxlength="350" class="form-control" placeholder="Mensaje..."></textarea>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <input type="submit" name="submit" value="Enviar" class="btn btn-primary text-white">
                        </div>
                    </div>
                </form>
            </div>

            <?php
            $sql = "SELECT * FROM tblpage WHERE PageType = 'contactus'";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='col-lg-3 ml-auto'>";
                    echo "<p class='mb-0 font-weight-bold text-black mr-2'>REFUGIO SANTA VIRGINIA</p>";
                    echo "<img src='Refugio_Logo.png' alt='Imagen del refugio' style='width: 50px; height: auto;'>";
                    echo "</br>";
                    echo "</br>";
                    echo "<p class='mb-0 font-weight-bold text-black'>Ubicacion</p>";
                    echo "<p class='mb-4'>" . $row["PageDescription"] . "</p>";
                    echo "<p class='mb-0 font-weight-bold text-black'>Correo Electronico</p>";
                    echo "<p class='mb-4'>" . $row["Email"] . "</p>";
                    echo "<p class='mb-0 font-weight-bold text-black'>Numero de telefono</p>";
                    echo "<p class='mb-4'>" . "+503 " . $row["MobileNumber"] . "</p>";
                    echo "</div>";
                }
            } else {
                echo "0 resultados";
            }
            $con->close();
            ?>
        </div>
    </div>
</div>



    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>

    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="build/js/intlTelInput.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
    .form-group-row {
        display: flex;
        flex-wrap: wrap;
        margin: -10px;
    }

    .form-group-col-md-12 {
        flex: 0 0 100%;
        max-width: 100%;
        padding: 10px;
    }

    .hola {
        width: 730%;
        max-width: 730px;
        box-sizing: border-box;
    }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var input = document.querySelector("#phone");
        var iti = window.intlTelInput(input, {
            // Configuración adicional según sea necesario
            initialCountry: "auto",
            geoIpLookup: function(callback) {
                fetch('https://ipinfo.io/json')
                    .then(response => response.json())
                    .then(data => callback(data.country))
                    .catch(() => callback('us'));
            },
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
        });

        input.addEventListener('countrychange', function() {
            var selectedCountryData = iti.getSelectedCountryData();
            if (selectedCountryData && selectedCountryData.dialCode) {
                input.value = "+" + selectedCountryData.dialCode;
            } else {
                Swal.fire({
                    title: 'No hay país seleccionado',
                    text: 'Por favor, selecciona un país para obtener el código de área.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        input.value = "";
                    }
                });
            }
        });

        // Inicializar el valor del input con el código del país seleccionado al cargar la página
        var initialCountryData = iti.getSelectedCountryData();
        if (initialCountryData && initialCountryData.dialCode) {
            input.value = "+" + initialCountryData.dialCode;
        }
    });
    </script>
    <style>
    .map-container {
        position: relative;
        width: 100%;
        padding-bottom: 26.25%;
        /* 16:9 aspect ratio */
    }

    .map-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
    </style>
    <section id="cta" class="cta img-bg    bg-primary"
        style=" background-size: cover; background-position: center; height: 50vh; position: relative;">
        <div class="container d-flex justify-content-center align-items-center h-100" data-aos="zoom-in">
            <div class="text-center">
                <h1 class="display-1 fw-bolder" style="color: #FFFFFF; font-size: 4rem;">UBICACION</h1>
                <?php
                    include('includes/config.php');
          $ret=mysqli_query($con,"SELECT * FROM tblpage WHERE PageType='contactus'");
          while ($row=mysqli_fetch_array($ret)) {
          ?>
                </br>
                <h5 class="text-white" style="text-align: center;">
                    <?php echo $row['PageDescription']; ?>
                </h5> <?php } ?>
            </div>
        </div>

    </section><!-- End Cta Section -->

    </br>

    <div class="map-container">
        <?php
                            include('includes/config.php');
          $ret=mysqli_query($con,"SELECT * FROM socialmedialinks WHERE Pagetype='Links'");
          while ($row=mysqli_fetch_array($ret)) {
          ?>
        <iframe src="<?php echo $row['GoogleMaps']; ?>" width="600" height="450" style="border:0;" allowfullscreen=""
            loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <?php } ?>
    </div>
    </div>

    <?php
include ('footer.php');
  ?>

    <script src="js/main.js"></script>
</body>

</html>