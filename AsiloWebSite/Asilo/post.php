<?php 
require_once "include/header.php";
?>
  <section id="sliderSection" style="margin-left: -15px; margin-right: -15px;">
        <div class="row">
            <div class="col-md-12 col-sm-12" style="padding-left: 0; padding-right: 2;">
                <div class="slick_slider" style="width: calc(100% + 30px); margin-left: -15px;">
<section id="sliderSection" style="margin-left: -15px; margin-right: -15px;">
    <div class="row">
        <div class="col-md-12 col-sm-12" style="padding-left: 0; padding-right: 2;">
            <div class="slick_slider" style="width: calc(100% + 30px); margin-left: -15px;">

                <!-- adding carousel -------------------------------------------------------------------------->
                <?php 
                $latest = "SELECT * FROM post_description ORDER BY p_time DESC LIMIT 5";
                $latest_n = mysqli_query($conn, $latest);
                if ($latest_n) {
                    while ($rows = mysqli_fetch_assoc($latest_n)) {
                        $heading = $rows["p_heading"];
                        $img = $rows["p_thumbnail"];
                        
                        $news_id = $rows["p_id"];
                        ?>
                <div class="single_iteam">
                    <a href="read-post.php?id=<?php echo $news_id; ?>">
                        <img src="admin/upload/thumbnail/<?php echo $img; ?>" alt="<?php echo $heading; ?>"
                            style="width:100%; height:auto; max-height: 900px;" class="img-fluid img-responsive">
                    </a>
                    <div class="slider_article"
                        style="background: rgba(0, 0, 0, 0.5); color: #fff; position: absolute; bottom: 0; width: 100%;">
                        <h2 style="font-size: 24px; font-weight: bold;">
                            <a class="slider_tittle" href="read-post.php?id=<?php echo $news_id; ?>"
                                style="color: #fff; text-decoration: none;"><?php echo $heading; ?></a>
                        </h2>
                    </div>
                </div>
                <?php
                    }
                }
                ?>
                <!-- end carousel----------------------------------------------------------------------------------------- -->

            </div>
        </div>
    </div>
 
    
</section>


<style>
#sliderSection {
    margin-left: -15px;
    /* Ajusta este valor según necesites */
    margin-right: -15px;
    /* Ajusta este valor según necesites */
}

.slick_slider {
    width: calc(100% + 30px);
    /* Ajusta este valor para que coincida con los márgenes negativos */
    margin-left: -15px;
    /* Ajusta este valor según necesites */
}

.col-md-12 {
    padding-left: 0;
    padding-right: 0;
}
</style>

<section id="contentSection">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="left_content">
                <div class="single_post_content">
                    <h2><span> Todas las noticias </span> </h2>

                    <!-- adding all news of selected category -->
                    <?php
                
                $select_cat_news = "SELECT * FROM post_description ORDER BY p_time DESC ";
                $result_cat_news = mysqli_query($conn , $select_cat_news);

                if($result_cat_news){
                    while ( $cat_news_rows = mysqli_fetch_assoc($result_cat_news) ){
                     $post_thumb = $cat_news_rows["p_thumbnail"];
                      $post_heading = $cat_news_rows["p_heading"];
                      $post_id = $cat_news_rows["p_id"];
                    
                      $post_id = $cat_news_rows["p_id"];
             ?>

                    <!-- inner card row -->

                    <div class="row">
                        <div class="card">
                            <div class="col-lg-4">
                                <a href="read-post.php?id=<?php echo $post_id; ?>"> <img
                                        style="height:150px; width:100%; " class="card-img img-fluid img-responsive"
                                        src="admin/upload/thumbnail/<?php echo $post_thumb; ?>"> </a>
                            </div>
                            <div class="card-body">
                                <div class="card-text"> <a href="read-post.php?id=<?php echo $post_id; ?>">
                                        <h3> <?php echo ucwords($post_heading); ?> </h3>
                                    </a> </div>
                                <div class="card-text"> <a
                                        href="read-post.php?id=<?php echo $post_id ?>"><?php echo ucwords($post_desc); ?>
                                    </a> </div>
                            </div>
                        </div>
                    </div>

                    <?php
                  }
                }
                        
                ?>
                    <!-- inner row end -->

                </div>
            </div>
        </div>
      
        <?php
require_once "include/footer.php";
?>
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
  </div>