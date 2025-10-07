<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.min.css" />

<?php
require_once "include/connection.php";

// Verificar si la clave "id" existe en $_GET
if (isset($_GET["id"])) {
    $p_id = $_GET["id"];

    $select_no_of_post_per_cat = "SELECT * FROM portafolio WHERE id = '$p_id'";
    $result_post = mysqli_query($conn, $select_no_of_post_per_cat);

    if ($result_post && mysqli_num_rows($result_post) > 0) {
        $row = mysqli_fetch_assoc($result_post);

        $delete_cat = "DELETE FROM portafolio WHERE id = '$p_id'";
        $result = mysqli_query($conn, $delete_cat);

        if ($result) {
            echo "<p><script>Swal.fire({
                title: 'Éxito',
                text: 'Imagen eliminada con éxito',
                icon: 'success',
                button: 'Cerrar',
            }).then(function() {
                window.location.href = 'ManagePortafolio.php';
            });</script></p>";
        } else {
            echo "<p><script>Swal.fire({
                title: 'Error',
                text: 'Hubo un error al eliminar la imagen',
                icon: 'error',
                button: 'Cerrar',
            });</script></p>";
        }
    } else {
        echo "<p><script>Swal.fire({
            title: 'Error',
            text: 'No se encontró la imagen',
            icon: 'error',
            button: 'Cerrar',
        });</script></p>";
    }
} else {
    echo "<p><script>Swal.fire({
        title: 'Error',
        text: 'No se proporcionó un ID válido',
        icon: 'error',
        button: 'Cerrar',
    });</script></p>";
}
?>