<?php
session_start();
$_SESSION['alogin'] = "";
session_unset();
$_SESSION['errmsg'] = "You have successfully logged out";

// Redirigir a la página de inicio de sesión
header("Location: index.php");
exit();
?>