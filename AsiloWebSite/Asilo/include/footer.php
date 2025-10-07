<div class="col-lg-4 col-md-4 col-sm-4">
        <div class="latest_post">
          <h2><span>Noticias Populares</span></h2>
          <div class="latest_post_container" style="height:500p; overflow: auto;">
            <ul class="latest_postnav" >

            <!-- ADDING LATEST NEWS---------------------------------------------------------------------- -->
            <?php 

            $latest = "SELECT * FROM post_description ORDER BY RAND() DESC LIMIT 10";
            $latest_n = mysqli_query($conn , $latest);
            if($latest_n){
              while( $rows = mysqli_fetch_assoc($latest_n) ){
                $heading = $rows["p_heading"];
                $img = $rows["p_thumbnail"];
                $id = $rows["p_id"]
                ?>
                <li>
                <div class="media"> <a href="read-post.php?id=<?php echo $id; ?>" class="media-left"> <img alt="" src="./admin/upload/thumbnail/<?php echo $img; ?>"> </a>
                  <div class="media-body"> <a href="read-post.php?id=<?php echo $id; ?>" class="catg_title"> <?php echo $heading; ?> </a> </div>
                </div>
              </li>
              <?php

              }
            }
            ?>
            </ul>
          </div>
        </div>

        <aside class="right_content">
        <div class="latest_post">
            <h2><span>Últimas Noticias</span></h2>
            <div class="latest_post_container" style="height:500p; overflow: auto;">
            <ul class="spost_nav pt-4"  >

            <!-- ADDING POPULAR NEWS --------------------------------------------------------------->
            <?php 
                $latest = "SELECT * FROM post_description ORDER BY p_time DESC LIMIT 10";
                $latest_n = mysqli_query($conn , $latest);
                if($latest_n){
                 
                  while( $rows = mysqli_fetch_assoc($latest_n) ){
                    $heading = $rows["p_heading"];
                    $img = $rows["p_thumbnail"];
                    $id = $rows["p_id"];
                    ?>
                    <li>
                    <div class="media"> <a href="read-post.php?id=<?php echo $id; ?>" class="media-left"> <img alt="" src="./admin/upload/thumbnail/<?php echo $img; ?>"> </a>
                      <div class="media-body"> <a href="read-post.php?id=<?php echo $id; ?>" class="catg_title"> <?php echo $heading; ?> </a> </div>
                    </div>
                  </li>
                  <?php
                  }
                }
                ?>
            </ul>
          </div>
          </div>
       
          <div class="single_sidebar wow fadeInDown">
            <h2><span>Links</span></h2>
            <ul>
            <!-- <li><a href="#">Log-in / Sign-Up</a></li> -->
            <li><a href="./about.php">Acerca de nosotros</a></li>
              <li><a href="./contact.php">Contacto</a></li>
            </ul>
          </div>
        </aside>
      </div>
    </div>
  </section>
  <div class="site-footer bg-light">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <h2 class="footer-heading mb-4">Acerca de nosotros</h2>
     
<p style="text-align:justify;">El Proyecto Refugio Santa Virginia Centurione Bracelli se ha constituido por un grupo de Salvadoreños, como un apéndice de Católicos, con el fin de recaudar fondos con los cuales habilitar en lo posible el Hogar de Ancianos y refugio Santa Virginia Centurione Bracelli, hoy en vías de creación en la ciudad de San Salvador, El Salvador.</p>          <div class="my-5 social">
<?php
                            include('includes/config.php');
          $ret=mysqli_query($con,"SELECT * FROM socialmedialinks WHERE Pagetype='Links'");
          while ($row=mysqli_fetch_array($ret)) {
          ?>
            <a href="<?php echo $row['Facebook'];?>" class="pl-0 pr-3"><span class="icon-facebook"></span></a>
            <a href="<?php echo $row['Twitter'];?>" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
            <a href="<?php echo $row['Instagram'];?>" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
            <?php } ?>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="row">
            <div class="col-lg-4">
              <h2 class="footer-heading mb-4">Quienes Somos?</h2>
              <ul class="list-unstyled">
                <li><a href="about.php">Acerca de nosotros</a></li>
               
              </ul>
            </div>
            <div class="col-lg-4">
              <h2 class="footer-heading mb-4">Inicio</h2>
              <ul class="list-unstyled">
                <li><a href="index.php">Refugio Santa Virginia</a></li>
               
              </ul>
            </div>
            <div class="col-lg-4">
              <h2 class="footer-heading mb-4">Servicios</h2>
              <ul class="list-unstyled">
                <li><a href="services.php">Servicios de Refugio Santa Virginia</a></li>
               
              </ul>
            </div>
            <div class="col-lg-4">
              <h2 class="footer-heading mb-4">Donaciones</h2>
              <ul class="list-unstyled">
                <li><a href="donacion.php">Donar a Refugio Santa Virginia</a></li>
           
              </ul>
            </div>
            <div class="col-lg-4">
              <h2 class="footer-heading mb-4">Contacto y noticias</h2>
              <ul class="list-unstyled">
                <li><a href="contact.php">Contacto</a></li>
                <li><a href="post.php">Noticias de Refugio Santa Virginia </a></li>
                
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="row text-center">
        <div class="col-md-12">
          <div class="border-top pt-5">
            <p class="copyright"><small>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              Copyright &copy;<script>document.write(new Date().getFullYear());</script> <i class="icon-heart text-danger" aria-hidden="true"></i>  <a  target="_blank" >Refugio Santa Virginia</a>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></small></p>

            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div> <!-- .site-wrap -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.countdown.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/aos.js"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/jquery.animateNumber.min.js"></script>
<script src="js/jquery.fancybox.min.js"></script>
<script src="js/jquery.sticky.js"></script>
<script src="js/isotope.pkgd.min.js"></script>


<script src="js/main.js"></script>
<script src="assets/js/jquery.min.js"></script> 
<script src="assets/js/wow.min.js"></script> 
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/jquery.li-scroller.1.0.js"></script> 
<script src="assets/js/jquery.newsTicker.min.js"></script> 
<script src="assets/js/jquery.fancybox.pack.js"></script> 
<script src="assets/js/custom.js"></script>

</body>
</html>

