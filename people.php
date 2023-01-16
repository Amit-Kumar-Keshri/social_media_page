<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('ROOT_DIR', realpath(__DIR__.'/..'));
include ROOT_DIR.'/social-media/db.php';
include ROOT_DIR.'/social-media/functions.php';

if (!isset($_COOKIE['login_auth'])) {
  header("Location:login.php");
}
?>
<?php include('includes/header.php'); ?>
<div class="row">
  <div class="">
    <div class="blue-header d-flex flex-column justify-content-center">
      <h1 class="text-center">Showing People Around</h1>
    </div>
  </div>
</div>
<div class="gradient">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="d-flex flex-wrap">
          <?php
          $all_data = retrive_all_data();

          $already_added_user = all_added_users($_COOKIE['login_auth']);

          //var_dump($already_added_user);


          foreach ($all_data as $key => $value) {
            $user_id = $value[0];
            if (!in_array($user_id, $already_added_user)) {
                //echo $user_id;
                ?>
                <div class="card card-one m-3">
                  <div class="header">
                    <div class="avatar">
                      <img src="uploads/<?= $value[7]; ?>" alt="user" class="profile-photo-lg">
                    </div>
                  </div>
                  <h3><a href="#" class="profile-link">
                      <?= $value[1]; ?>
                    </a></h3>
                  <div class="desc">
                    <?php if (!check_if_already_added($value[0])) { ?>
                      <button class="btn btn-primary pull-right add_friend_btn" data-id="<?= $value[0]; ?>">Add Friend</button>
                    <?php } else { ?>
                      <button class="btn btn-success pull-right add_friend_btn" data-id="<?= $value[0]; ?>">Pending
                        Request</button>
                    <?php } ?>
                  </div>
                  <div class="contacts">
                    <div class="clear"></div>
                  </div>
                  <div class="footer"></div>
                </div>
                <?php
            }
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include('includes/footer.php'); ?>