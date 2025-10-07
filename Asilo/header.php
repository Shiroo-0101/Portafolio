<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Título de tu página</title>
  <!-- Bootstrap CSS -->
</head>
<body>
  <header class="site-navbar light js-sticky-header site-navbar-target1" role="banner">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-6 col-xl-2">
          <a href="index.php"><img src="Refugio_Logo.png" alt="Refugio" style="width:100px;height:100px;"></a>
        </div>
        <div class="col-12 col-md-10 d-none d-xl-block">
          <nav class="site-navigation position-relative text-right" role="navigation">
            <ul class="site-menu main-menu1 js-clone-nav mr-auto d-none d-lg-block">
              <li><a href="index.php" class="nav-link"><strong>Inicio</strong></a></li>
              <li class="has-children">
                <a href="services.php" class="nav-link "><strong>Servicios</strong></a>
                <ul class="dropdown">
                  <?php
                  $query = mysqli_query($con, "SELECT * FROM tblservices");
                  while ($row = mysqli_fetch_array($query)) {
                  ?>
                  <li><a href="services.php" class="nav-link"><?php echo htmlentities($row['ServiceTitle']); ?></a></li>
                  <?php
                  }
                  ?>
                  <li class="has-children">
                </ul>
              </li>
              <li><a href="about.php" class="nav-link"><strong>Acerca de</strong></a></li>
              
              
              <li class="has-children">
                <a href="donacion.php" class="nav-link "><strong>Donacion</strong></a>
                <ul class="dropdown">
                
                  <li><a href="donacion.php" class="nav-link">Donar</a></li>
                  <li><a href="donacion1.php" class="nav-link">Ayudanos</a></li>
                  <li><a href="project.php" class="nav-link">Proyectos</a></li>
                  <li class="has-children">
                </ul>
              </li>
              <li><a href="contact.php" class="nav-link"><strong>Contactanos</strong></a></li>
              <li><a href="post.php" class="nav-link"><strong>Noticias</strong></a></li>
              <li><a href="asilosantavirginia.php" class="nav-link"><strong>Santa Virginia </strong></a></li>
            </ul>
          </nav>
        </div>
        <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3" style="position: relative; top: 3px;">
          <a href="#" class="site-menu-toggle js-menu-toggle float-right"><span class="icon-menu h3 text-black"></span></a>
        </div>
      </div>
    </div>
  </header>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
</body>
</html>
