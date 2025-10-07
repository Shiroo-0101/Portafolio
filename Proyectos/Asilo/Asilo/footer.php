<div class="site-footer bg-light">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
        <?php
              include('includes/config.php');
          $ret=mysqli_query($con,"select * from tblpage where PageType='aboutus'");
          $cnt=1;
          while ($row=mysqli_fetch_array($ret)) {
          ?>
          <h2 class="footer-heading mb-4"><?php echo $row['PageTitle'];?></h2>

     
<p style="text-align:justify;"><?php echo $row['PageDescription'];?></p>         
<?php } ?>
 <div class="my-5 social">
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