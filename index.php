<?php include("db.php");
include("functions.php");
if (isset($_GET['logout']) && isset($_COOKIE["login_auth"])) {
    header("Location:login.php");
    unset($_COOKIE['login_auth']);
    setcookie('login_auth', null, -1, '/');
    return true;
}
if (!isset($_COOKIE['login_auth'])) {
    header("Location:login.php");
}
include('includes/header.php');

?>
<div class="gradient">
    <div class="container d-flex justify-content-center py-3">
        <div class="row activity ">
            <div class="col-md-12">
                <?php
                $all_posts = retrive_all_post();
                foreach ($all_posts as $key => $value) {
                    $user_id = $value[1];
                    $row = retrive_data($user_id);
                    $name = $row['name'];
                    $profile_image = $row['profile_image'];
                    $address = $row['address'];
                ?>
                    <div class="panel panel-default card px-3">
                        <div class="panel-heading">
                            <img src="uploads/<?= $profile_image ?>" class="rounded-circle">
                            <div><strong>
                                    <?= $name ?>
                                </strong></div>
                            <div class="small"><i class="fa fa-map-marker"></i>
                                <?= $address ?>
                            </div>
                        </div>
                        <div class="panel-body d-flex justify-content-center flex-column">
                            <?php if (!empty($value[2]) && $value[5] == "image") { ?>
                                <p>
                                    <?= $value[2] ?>
                                </p>
                                <img src="uploads/posts/<?= $value[3] ?>" class="img-responsive img-fluid post_media">
                            <?php } elseif (!empty($value[2]) && $value[5] == "video") { ?>
                                <p>
                                    <?= $value[2] ?>
                                </p>
                                <iframe src="uploads/posts/<?= $value[3] ?>" height="320" width="500" class="post_media" frameborder="0" autoplay="false" controls></iframe>
                            <?php } elseif (empty($value[2]) && $value[5] == "image") { ?>
                                <img src="uploads/posts/<?= $value[3] ?>" class="img-responsive img-fluid post_media">
                            <?php } elseif (empty($value[2]) && $value[5] == "video") { ?>
                                <iframe src="uploads/posts/<?= $value[3] ?>" height="320" width="500" class="post_media" frameborder="0" autoplay="false" controls></iframe>
                            <?php } ?>
                        </div>
                        <div class="panel-footer my-3">
                            <div class="row ">

                                <div class="col text-center ">
                                    <button type="button" class="btn btn-secondary liked-btn" value="LIKE" post-id="<?= $value[0]; ?>"><i class="fa-solid fa-thumbs-up"></i>Like</button>
                                    <span class="badge rounded-pill badge-notification-button bg-danger"></span>
                                </div>
                                <div class="col text-center">
                                    <button type="button" class="btn btn-secondary comment-btn"><i class="fa-solid fa-comment"></i>Comment</button>
                                </div>
                                <div class="col text-center">
                                    <button type="button" class="btn btn-secondary"><i class="fa-solid fa-share"></i>Share</button>
                                </div>
                                <div class="col-12 mt-3 post-comment-sec">
                                    <input type="text" class="form-control post-comment " id="comment" name="comment" placeholder="Write a Comment" />
                                    <a href="#" class="comment-send" post-id="<?= $value[0]; ?>" ><img src="assets/images/send.png" alt=""></a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
</div>
<?php include('includes/footer.php'); ?>