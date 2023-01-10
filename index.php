<?php include("db.php");
include("functions.php");
include('includes/header.php');
?>
<div class="container d-flex justify-content-center">
    <div class="row activity ">
        <div class="col-md-6">
            <?php
            $all_posts = retrive_all_post();
            foreach ($all_posts as $key => $value) {
                $user_id = $value[1];
                $row = retrive_data($user_id);
                $name = $row['name'];
                $profile_image = $row['profile_image'];
                $address = $row['address'];
                ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <img src="uploads/<?= $profile_image ?>" class="rounded-circle">
                        <div><strong>
                                <?= $name ?>
                            </strong></div>
                        <div class="small"><i class="fa fa-map-marker"></i>
                            <?= $address ?>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php if (!empty($value[2])) { ?>
                            <blockquote>
                                <?= $value[2] ?>
                            </blockquote>
                        <?php } elseif ($value[5] == "image") { ?>
                            <img src="uploads/posts/<?= $value[3] ?>" class="img-responsive image-">
                        <?php } elseif ($value[5] == "video") { ?>
                            <iframe src="uploads/posts/<?= $value[3] ?>" width="500" height="281" frameborder="0"></iframe>
                        <?php } ?>
                    </div>
                    <div class="panel-footer">
                    </div>
                </div>
                <?php
            }
            ?>
            <!-- <div class="panel panel-default">
                <div class="panel-heading">
                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="img-rounded">
                    <div><strong>John Doe</strong></div>
                    <div class="small"><i class="fa fa-map-marker"></i> Medellin, Colombia</div>
                </div>
                <div class="panel-body">
                    <img src="https://www.bootdey.com/image/500x333" class="img-responsive">
                </div>
                <div class="panel-footer">
                   
                </div>
            </div> -->


        </div><!--/.col-->
        <!-- <div class="col-md-6">


                <div class="col">
          <div class="card shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>

            <div class="card-body">
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                </div>
                <small class="text-muted">9 mins</small>
              </div>
            </div>
          </div>
        </div>






            <div class="panel panel-default">
                <div class="panel-heading">
                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="img-rounded">
                    <div><strong>John Doe</strong></div>
                    <div class="small"><i class="fa fa-map-marker"></i> Medellin, Colombia</div>
                </div>
                <div class="panel-body">
                    <div class="video-container">
                        <iframe src="//player.vimeo.com/video/87526548" width="500" height="281"
                            frameborder="0"></iframe>
                    </div>

                </div>
                <div class="panel-footer">
                   
                </div>
            </div>
        </div> -->
    </div>
</div>
<?php include('includes/footer.php'); ?>