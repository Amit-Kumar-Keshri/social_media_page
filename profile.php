<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('ROOT_DIR', realpath(__DIR__ . '/..'));
include ROOT_DIR . '/social-media/includes/db.php';
include ROOT_DIR . '/social-media/includes/functions.php';


include('includes/header.php');

if (isset($_GET['logout']) && isset($_COOKIE["login_auth"])) {
    header("Location:login.php");
    unset($_COOKIE['login_auth']);
    setcookie('login_auth', null, -1, '/');
    return true;
}
if (!isset($_COOKIE['login_auth'])) {
    header("Location:login.php");
}


if (isset($_GET['view_user']) && $_GET['view_user'] != $_COOKIE["login_auth"]) {
    $active_user_id = $_GET['view_user'];
} else {
    $active_user_id = $_COOKIE["login_auth"];
}


$row = retrive_data($active_user_id);
//var_dump($row);
$id = $row['id'];
$name = $row['name'];
$email = $row['email'];
$phone = $row['phone'];
$address = $row['address'];
$gender = $row['gender'];
$profile_image = $row['profile_image'];
?>




<div class="container">
    <div id="content" class="content p-0">
        <div class="profile-header">
            <div class="profile-header-cover"></div>
            <div class="profile-header-content">
                <div class="profile-header-img mb-4">
                    <img src="uploads/<?= $profile_image; ?>" class="mb-4" alt="" />
                </div>

                <div class="profile-header-info">
                    <h4 class="m-t-sm">
                        <?= $name ?>
                    </h4>
                    <?php if (!isset($_GET['view_user']) || $_GET['view_user'] == $_COOKIE['login_auth'] ) { ?>
                        <a href="update-profile.php" class="btn btn-xs btn-primary mb-2">Edit Profile</a>
                    <?php } ?>
                </div>
            </div>

            <!-- Tabs navs -->
            <ul class="nav nav-tabs profile-header bg-light" id="ex1" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="ex1-tab-1" data-mdb-toggle="tab" href="#profile-friends" role="tab" aria-controls="ex1-tabs-1" aria-selected="true">FRIENDS</a>
                </li>
                <?php if (!isset($_GET['view_user']) || $_GET['view_user'] == $_COOKIE['login_auth']) { ?>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="ex1-tab-2" data-mdb-toggle="tab" href="#profile-posts" role="tab" aria-controls="ex1-tabs-2" aria-selected="false">POSTS</a>
                    </li>
                <?php } ?>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="ex1-tab-3" data-mdb-toggle="tab" href="#profile-photos" role="tab" aria-controls="ex1-tabs-3" aria-selected="false">PHOTOS</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="ex1-tab-3" data-mdb-toggle="tab" href="#profile-videos" role="tab" aria-controls="ex1-tabs-3" aria-selected="false">VIDEOS</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="ex1-tab-3" data-mdb-toggle="tab" href="#profile-about" role="tab" aria-controls="ex1-tabs-3" aria-selected="false">ABOUT</a>
                </li>
            </ul>
        </div>
        <div class="profile-container">
            <div class="row row-space-20">

                <div class="col-md-8">
                    <div class="tab-content p-0 m-3">
                        <div class="tab-pane fade active show" id="profile-friends">
                            <?php $all_friends = all_added_users($active_user_id);
                            if (isset($_GET['view_user']) && $_GET['view_user'] != $_COOKIE["login_auth"]) { ?>
                                <div class="m-b-10"><b>Friends (<?= count($all_friends); ?>)</b></div>
                            <?php  } else { ?>
                                <div class="m-b-10"><b>Friends (<?= count($all_friends) - 1; ?>)</b></div>
                            <?php } ?>
                            <ul class="friend-list clearfix row">
                                <?php
                                foreach ($all_friends as $key => $value) {
                                    if ($value != $active_user_id) {
                                        $row = retrive_data($value);
                                ?>
                                        <li class="py-1 pe-1 col-sm-6">
                                            <a href="profile.php?view_user=<?= $row['id']; ?>" class="d-flex bg-white">
                                                <div class="friend-img"><img src="uploads/<?= $row['profile_image'] ?>" alt="photo" height="48" width="48" /></div>
                                                <div class="friend-info mx-3">
                                                    <h4>
                                                        <?= $row['name']; ?>
                                                    </h4>
                                                    <?php $count_friends = all_added_users($value);
                                                    if (isset($_GET['view_user']) && $_GET['view_user'] != $_COOKIE["login_auth"]) { ?>
                                                        <p><?= count($count_friends) - 1; ?> friends</p>
                                                    <?php } else { ?>
                                                        <p><?= count($count_friends); ?> friends</p>
                                                    <?php } ?>
                                                </div>
                                            </a>
                                        </li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        </div>
                        <!-- Posts -->
                        <?php if (!isset($_GET['view_user']) || $_GET['view_user'] == $_COOKIE['login_auth']) { ?>
                            <div class="tab-pane fade" id="profile-posts">
                                <div class="card card-body">
                                    <div class="d-flex flex-colomn">
                                        <div class="card-image">
                                            <img class="mt-3 rounded-circle status-image" src="uploads/<?= $profile_image; ?>" alt="image">
                                        </div>
                                        <div class="status-update m-3">
                                            <form class="w-100">
                                                <textarea class="form-control pe-4 border-0" name="" id="" rows="2" data-autoresize placeholder="share your thought..." data-mdb-toggle="modal" data-mdb-target="#exampleModal"></textarea>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <!-- Videos -->
                        <div class="tab-pane fade" id="profile-videos">
                            <div class="post_area">
                                <?php
                                $all_user_post = show_post_by_current_user($active_user_id);
                                foreach ($all_user_post as $key => $value) {
                                ?>
                                    <?php if ($value[5] == 'video') { ?>
                                        <iframe width="auto" height="240" src="uploads/posts/<?= $value[3]; ?>" autoplay="false">
                                        </iframe>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>


                        <!-- Photos -->
                        <div class="tab-pane fade" id="profile-photos">
                            <div class="post_area">
                                <?php
                                $all_user_post = show_post_by_current_user($active_user_id);
                                foreach ($all_user_post as $key => $value) {
                                ?>
                                    <?php if ($value[5] == 'image') { ?>
                                        <div class="d-md-inline-block mt-2">
                                            <img height="320" src="uploads/posts/<?= $value[3]; ?>" alt="" style="width: 100%;">
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        <!-- About -->
                        <div class="tab-pane fade" id="profile-about">
                            <ul class="profile-info-list">
                                <li class="title">ABOUT <?= $name ?></li>
                                <li>
                                    <div class="field">Gender:</div>
                                    <div class="value">
                                        <?= $gender ?>
                                    </div>
                                </li>

                                <li>
                                    <div class="field">Phone No.:</div>
                                    <div class="value">
                                        <?= $phone ?>
                                    </div>
                                </li>
                                <li>
                                    <div class="field">E-mail:</div>
                                    <div class="value">
                                        <?= $email ?>
                                    </div>
                                </li>
                                <li>
                                    <div class="field">Address:</div>
                                    <div class="value">
                                        <address class="m-b-0">
                                            <?= $address ?>
                                        </address>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>



                <div class=" col-md-4 hidden-xs hidden-sm">
                    <ul class="profile-info-list">
                        <li class="title">PERSONAL INFORMATION</li>
                        <li>
                            <div class="field">Address:</div>
                            <div class="value">
                                <address class="m-b-0">
                                    <?= $address ?>
                                </address>
                            </div>
                        </li>
                        <li>
                            <div class="field">Phone No.:</div>
                            <div class="value">
                                <?= $phone ?>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>


    </div>
    <!-- Button trigger modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-status">
            <div class="modal-content ">
                <div class="modal-header">
                    <!-- <h5 class="modal-title " id="exampleModalLabel">Share your thoughts...</h5> -->
                    <!-- <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body">
                    <form class="w-100">
                        <textarea class="form-control post_caption" placeholder="enter your thoughts here..."></textarea>
                        <input type="file" class="form-control mt-3 post_file" id="post_file" name="post_file" placeholder="Upload Your Media" />
                        <div class="mt-3 progress" style="height: 20px;display: none;">
  <div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
</div>
                        

        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close_modal" data-mdb-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary postUploadBtn">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <?php include('includes/footer.php'); ?>