<?php
define('ROOT_DIR', realpath(__DIR__ . '/..'));
include ROOT_DIR . '/social-media/includes/db.php';
include ROOT_DIR . '/social-media/includes/functions.php';

// if (!isset($_COOKIE['login_auth'])) {
//     header("Location:login.php");
// }
include('includes/header.php');

if (isset($_GET['post-id'])) {
    


    ?>
<div class="gradient">
    <div class="container d-flex justify-content-center py-3">
        <div class="row activity ">
            <div class="col-md-12">
                <?php
                $post_details = retrive_post($_GET['post-id']);
                    $user_id = $post_details['user_id'];
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
                            <?php if (!empty($post_details['post_text']) && $post_details['file_type'] == "image") { ?>
                                <p>
                                    <?= $post_details['post_text'] ?>
                                </p>img-responsive img-fluid">
                            <?php } elseif (!empty($post_details['post_text']) && $post_details['file_type'] == "video") { ?>
                                <p>
                                    <?= $post_details['post_text'] ?>
                                </p>
                                <iframe src="uploads/posts/<?= $post_details['media_path'] ?>" height="320" width="500" frameborder="0" autoplay="false" controls></iframe>
                            <?php } elseif (empty($post_details['post_text']) && $post_details['file_type'] == "image") { ?>
                                <img src="uploads/posts/<?= $post_details['media_path'] ?>" class=" img-fluid ">
                            <?php } elseif (empty($post_details['post_text']) && $post_details['file_type'] == "video") { ?>
                                <iframe src="uploads/posts/<?= $post_details['media_path'] ?>" height="320" width="500" frameborder="0" autoplay="false" controls></iframe>
                            <?php } ?>
                        </div>
                        <div class="panel-footer my-3">
                            <div class="row ">
                                <div class="col text-center liked_sec"> 
                                    <?php if(isset($_COOKIE['login_auth']) && !check_if_already_liked($_GET['post-id'])) {
                                        ?>  
                                        <button type="button" class="btn btn-secondary liked-btn" value="LIKE" post-id="<?= $value[0]; ?>"><i class="fa-solid fa-thumbs-up"></i>Like</button> 
                                        <?php }else { ?>                             
                                        <span class="badge rounded-pill badge-notification-button bg-danger">
                                            <?php echo $count = like_count($_GET['post-id']) ?> People Liked
                                        </span>
                                        <?php } ?>
                                </div>
                                <div class="col text-center">
                                    <button type="button" class="btn btn-secondary comment-btn"><i class="fa-solid fa-comment"></i>Comment</button>
                                </div>
                                
                                <div class="col-12 mt-3 ">
                                    <div class="post-comment">
                                        <div class="post-comment-sec">
                                        <?php if(isset($_COOKIE['login_auth']) && !check_if_already_liked($_GET['post-id'])) {
                                        ?>  
                                            <input type="text" class="form-control post-comment1" id="comment" name="comment" placeholder="Write a Comment" />
                                            <a class="comment-send" post-id="<?= $post_details['id']; ?>"><img class="send-btn-icon" src="assets/images/send.png" alt=""></a>
                                            <?php } ?>
                                        </div>
                                        <div class="mt-3 ms-3 comment-boxes d-flex flex-column">
                                            <?php
                                            $all_comments = retrive_all_comments($post_details['user_id']);
                                            foreach ($all_comments as $key => $comments) {
                                                if (!empty($comments[3])) {
                                                    $commenter_data = retrive_data($comments[1]);
                                                    ?>
                                                    <a class="friend-list comments d-flex mb-3">
                                                        <div class="friend-img rounded-circle"><img class="rounded-circle" src="uploads/<?= $commenter_data['profile_image'] ?>" alt="user profile photo" /></div>
                                                        <div class="friend-info px-3 ">
                                                            <h4 class="mb-1">
                                                                <?= $commenter_data['name']; ?>
                                                            </h4>
                                                            <p>
                                                                <?= $comments[3] ?>
                                                            </p>
                                                        </div>
                                                    </a>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                
                ?>
            </div>
        </div>
    </div>
</div>
</div>
<?php } ?>
<?php include('includes/footer.php'); ?>
