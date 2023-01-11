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
                    <h4 class="m-t-sm">
                        <?= $name ?>
                    </h4>
                    <a href="my-account.php" class="btn btn-xs btn-primary mb-2">Edit Profile</a>
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
                    <div class="tab-content p-0 m-3">
                        <div class="tab-pane fade active show" id="profile-friends">
                            <div class="m-b-10"><b>Friend List (9)</b></div>
                            <ul class="friend-list clearfix">

                                <!-- /* curently this showing user profile but it needs to shown friend list here */ -->
                                <?php
                                $all_friends = retrive_all_friends($_COOKIE['login_auth']);
                                foreach ($all_friends as $key => $value) {
                                    if ($value[3] == 'accepted') {
                                        $row = retrive_data($value[2]);
                                ?>
                                        <li>
                                            <a href="#" class="">
                                                <div class="friend-img"><img src="uploads/<?= $row['profile_image'] ?>" alt="" /></div>
                                                <div class="friend-info">
                                                    <h4><?= $row['name']; ?></h4>
                                                    <p>392 friends</p>
                                                </div>
                                            </a>
                                        </li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        </div>

                        <!-- Videos -->

                        <div class="tab-pane fade" id="profile-posts">
                            <div class="card card-body">
                                <div class="d-flex flex-colomn">
                                    <div class="card-image">

                                        <img class="mt-3 rounded-circle status-image" src="https://social.webestica.com/assets/images/avatar/03.jpg" alt="image">
                                    </div>
                                    <div class="status-update m-3">
                                        <form class="w-100">
                                            <textarea class="form-control pe-4 border-0" name="" id="" rows="2" data-autoresize placeholder="share your thought..." data-mdb-toggle="modal" data-mdb-target="#exampleModal"></textarea>
                                        </form>
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
                                                            <input type="file" class="form-control mt-3" id="post_file" name="post_file" placeholder="Upload Your Media" />
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary postUploadBtn">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="nav nav-pills nav-stack">
                                            <li class="nav-items"><a href="#">Photo</a></li>
                                            <li class="nav-items"><a href="#">Video</a></li>
                                            <li class="nav-items"><a href="#">Event</a></li>
                                            <li class="nav-items"><a href="#">Feeling/Activity</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="profile-videos">
                            <div class="post_area">
                                <?php
                                $all_user_post = show_post_by_current_user($_COOKIE['login_auth']);
                                foreach ($all_user_post as $key => $value) {
                                ?>
                                    <?php if ($value[5] == 'video') { ?>
                                        <iframe width="320" height="240" src="uploads/posts/<?= $value[3]; ?>" autoplay="false">
                                        </iframe>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>


                        <!-- Photos -->
                        <div class="tab-pane fade" id="profile-photos">
                            <div class="post_area">
                                <?php
                                $all_user_post = show_post_by_current_user($_COOKIE['login_auth']);
                                foreach ($all_user_post as $key => $value) {
                                ?>
                                    <?php if ($value[5] == 'image') { ?>
                                        <div class="d-inline-block">
                                            <img width="320" height="240" src="uploads/posts/<?= $value[3]; ?>" alt="">
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="profile-about">
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





        <!-- About -->

        <!-- Posts -->




    </div>
    <?php include('includes/footer.php'); ?>