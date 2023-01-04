<?php
include("db.php");
include('functions.php');
if (isset($_GET['logout']) && isset($_COOKIE["login_auth"])) {
  header("Location:login.php");
  unset($_COOKIE['login_auth']);
  setcookie('login_auth', null, -1, '/');
  return true;
}
if (!isset($_COOKIE['login_auth'])) {
  header("Location:login.php");
}
?>
<?php include('includes/header.php'); ?>
<div class="row">
  <div class="col-lg-12  ">
    <div class="blue-header d-flex flex-column justify-content-center">
      <h1 class="text-center">Showing People Around</h1>
    </div>
  </div>
</div>
<div class="container">
<div class="row justify-content-start">
  <div class="col-lg-6  ">
    <div class="people-nearby">

  


  <?php
  $all_data = retrive_all_data();

  foreach ($all_data as $key => $value) {
    $user_id = $value[0];

    if ($user_id != $_COOKIE['login_auth']) {
  ?>
  <div class="nearby-user">
    <div class="row">
      <div class="col-md-2 col-sm-2 d-flex justify-content-center align-items-center">
        <img src="uploads/<?= $value[8]; ?>" alt="user" class="profile-photo-lg">
      </div>
      <div class="col-md-4 col-sm-4">
        <h5><a href="#" class="profile-link"><?= $value[1]; ?></a></h5>
        <p><?= $value[5]; ?></p>
        <p><?= $value[4]; ?></p>
        
      </div>
      <div class="col-md-6 col-sm-6 d-sm-flex justify-content-sm-start align-items-sm-center">
      <?php if (!check_if_already_added($value[0])) { ?>
        <button class="btn btn-primary pull-right add_friend_btn" data-id="<?= $value[0]; ?>">Add Friend</button>
      <?php } ?>
      </div>
    </div>
  </div>
     

  <?php
    }
  }
  ?>
</div>
</div>
</div>
</div>
<?php include('includes/footer.php'); ?>