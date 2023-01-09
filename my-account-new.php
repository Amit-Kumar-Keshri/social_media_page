<?php include('db.php');

if (isset($_GET['logout']) && isset($_COOKIE["login_auth"])) {
    header("Location:login.php");
    unset($_COOKIE['login_auth']);
    setcookie('login_auth', null, -1, '/');
    return true;
}
if (!isset($_COOKIE['login_auth'])) {
    header("Location:login.php");
}
include("functions.php");

$row = retrive_data($_COOKIE["login_auth"]);
//var_dump($row);
$id = $row['id'];
$name = $row['name'];
$email = $row['email'];
$phone = $row['phone'];
$address = $row['address'];
$gender = $row['gender'];
$profile_image = $row['profile_image'];

?>


<?php include('includes/header.php'); ?>

<div class="container">
    <div id="content" class="content p-0">
        <div class="profile-header">
            <div class="profile-header-cover"></div>
            <div class="profile-header-content">
                <div class="profile-header-img mb-4">
                    <img src="uploads/<?= $profile_image ?>" class="mb-4" alt="" />
                </div>

                <div class="profile-header-info">
                    <h4 class="m-t-sm"><?= $name ?></h4>
                    <a href="#" class="btn btn-xs btn-primary mb-2">Edit Profile</a>
                </div>
            </div>

            <!-- Tabs navs -->
            <ul class="nav nav-tabs profile-header bg-light" id="ex1" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="ex1-tab-1" data-mdb-toggle="tab" href="#profile-friends" role="tab" aria-controls="ex1-tabs-1" aria-selected="true">FRIENDS</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="ex1-tab-2" data-mdb-toggle="tab" href="#profile-posts" role="tab" aria-controls="ex1-tabs-2" aria-selected="false">POSTS</a>
                </li>
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
                    <div class="tab-content p-0">

                        <div class="tab-pane fade active show" id="profile-friends">
                            <div class="m-b-10"><b>Friend List (9)</b></div>

                            <ul class="friend-list clearfix">
                                <li>
                                    <!-- /* curently this showing user profile but it needs to shown friend list here */ -->
                                    <a href="#">
                                        <div class="friend-img"><img src="uploads/<?= $profile_image ?>" alt="" /></div>
                                        <div class="friend-info">
                                            <?php $row = retrive_all_request($_COOKIE['login_auth']) ?>
                                            <?php foreach ($row as $key => $value) {
                                            ?>
                                                <?php if ($value[3] == 'accepted') { ?>
                                                   <?php $name = retrive_data($value[2]); 
                                                   echo var_dump($name);
                                                   ?>
                                                    <h4><?php $name['name'] ?></h4>
                                                    <p>392 friends</p>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <!-- Videos -->

                        <div class="tab-pane fade" id="profile-videos">
                            <div class="post_area">
                                <?php
                                $all_user_post = show_post_by_current_user($_COOKIE['login_auth']);
                                foreach ($all_user_post as $key => $value) {
                                ?>
                                    <?php if ($value[4] == 'video') {  ?>
                                        <iframe width="320" height="240" src="uploads/posts/<?= $value[2]; ?>">
                                        </iframe>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>



                        <div class="tab-pane fade" id="profile-photos">
                            <div class="post_area">
                                <?php
                                $all_user_post = show_post_by_current_user($_COOKIE['login_auth']);
                                foreach ($all_user_post as $key => $value) {
                                ?>
                                    <?php if ($value[4] == 'image') {  ?>
                                        <div class="">
                                            <img width="320" height="240" src="uploads/posts/<?= $value[2]; ?>" alt="">
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
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



        <!-- Photos -->

        <!-- About -->

        <!-- Posts -->




    </div>
    <?php include('includes/footer.php'); ?>