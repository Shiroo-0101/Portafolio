<?php
require_once "include/header.php";
?>
<style>
  .single_page_content .img-center {
    max-width: 100%;
    height: auto;
  }

  @media (min-width: 768px) {
    .single_page_content .img-center {
      width: 85%;
      max-height: 400px;
      object-fit: cover;
    }
  }
</style>


<?php 

$id = $_GET["id"];
$read_news = "SELECT * FROM post_description WHERE p_id = '$id' ";
$read_result = mysqli_query($conn, $read_news);
if ($read_result) {
    while ($rows = mysqli_fetch_assoc($read_result)) {
        $heading =  $rows["p_heading"];
        $details =  $rows["p_description"];
        $time = $rows["p_time"];
        $category = $rows["p_category"];
        $img = $rows["p_thumbnail"];
?>
    <section id="sliderSection" style="margin-left: -15px; margin-right: -15px;">
        <div class="row">
            <div class="col-md-12 col-sm-12" style="padding-left: 0; padding-right: 0;">
                <div class="slick_slider" style="width: calc(100% + 30px); margin-left: -15px;">
<section id="contentSection">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="left_content">
                <div class="single_page">
                    <h1> <?php echo $heading; ?> </h1>
                    <div class="post_commentbox">
                        <a href="#"><i class="fa fa-user"></i>Admin</a>
                        <span><i class="fa fa-calendar"></i> <?php echo date('d-M-Y', strtotime($time)); ?> </span>
                        <a href="#"><i class="fa fa-tags"></i><?php echo $category; ?></a>
                    </div>
                    <div class="single_page_content">
  <img class="img-center" src="admin/upload/thumbnail/<?php echo $img; ?>" alt="">
  <blockquote><?php echo $details; ?></blockquote>
</div>
                    <div class="social_link">
                        <ul class="sociallink_nav">
                        <?php
                            include('includes/config.php');
          $ret=mysqli_query($con,"SELECT * FROM socialmedialinks WHERE Pagetype='Links'");
          while ($row=mysqli_fetch_array($ret)) {
          ?>
                            <li><a href="<?php echo $row['Facebook'];?>"> <i class="fa fa-facebook"></i></a></li>
                            <li><a href="<?php echo $row['Twitter'];?>" ><i class="fa fa-twitter"></i></a></li>
                            <li><a href="<?php echo $row['Instagram'];?>"><i class="fa fa-instagram"></i></a></li>
  <?php } ?>
                        </ul>
                    </div>
                    <div class="related_post">
                        <h2>Noticias Relacionadas <i class="fa fa-thumbs-o-up"></i></h2>
                        <ul class="spost_nav wow fadeInDown animated">
                            <?php
                            $select_related_post = "SELECT * FROM post_description WHERE p_category = '$category' ORDER BY RAND() LIMIT 3";
                            $related_post = mysqli_query($conn, $select_related_post);
                            if ($related_post) {
                                while ($related_post_row = mysqli_fetch_assoc($related_post)) {
                                    $thumb = $related_post_row["p_thumbnail"];
                                    $related_heading = $related_post_row["p_heading"];
                                    $related_id = $related_post_row["p_id"];
                                    ?>
                                    <li>
                                        <div class="media">
                                            <a class="media-left" href="read-post.php?id=<?php echo $related_id; ?>">
                                                <img src="admin/upload/thumbnail/<?php echo $thumb; ?>" alt="<?php echo $related_heading; ?>">
                                            </a>
                                            <div class="media-body">
                                                <a class="catg_title" href="read-post.php?id=<?php echo $related_id; ?>">
                                                    <?php echo $related_heading; ?>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
?>

<?php 
require_once "include/footer.php";
?>