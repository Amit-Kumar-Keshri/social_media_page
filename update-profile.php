<?php
define('ROOT_DIR', realpath(__DIR__ . '/..'));
include ROOT_DIR . '/social-media/includes/db.php';
include ROOT_DIR . '/social-media/includes/functions.php';

if (isset($_GET['logout']) && isset($_COOKIE["login_auth"])) {
  header("Location:login.php");
  unset($_COOKIE['login_auth']);
  setcookie('login_auth', null, -1, '/');
  return true;
}

if (!isset($_COOKIE['login_auth'])) {
  header("Location:login.php");
}


$VALID_EMAIL_PATTERN = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
$VALID_PHONE_PATTERN = "/^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[6789]\d{9}$/";
$VALID_NAME_PATTERN = "/^([a-zA-Z' ]+)$/";


$name_error = $email_error = $phone_error = $address_error = $gender_error = $image_error = '';
$update_name = $update_email = $update_phone = $update_address = $update_gender = '';



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
<div class="row">
  <div class="col-lg-12  ">
    <div class="blue-header d-flex flex-column justify-content-center">
      <h1 class="text-center">Welcome <?= $name ?></h1>
    </div>
  </div>
</div>
<div class="gradient">
  <div class="container ">
    <div class="row justify-content-lg-between">
      <div class="col-lg-5 my-3 highlight">
        <div class="image-container position-relative">
          <!-- <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data"> -->
            <div class="image-container">
              <img class="profile-image" src="uploads/<?= $profile_image ?>" />
            </div>
            <div class="row my-3 justify-content-center align-items-center custom-input-box">
              <!-- <img type="file" data-id="<?= $id; ?>" id="file" name="file" class="imgUploadBtn rounded-circle" src="assets/images/camera.png" alt="">
              <input type="file" class="form-control imgUploadBtn" data-id="<?= $id; ?>" id="file" name="file" placeholder="Upload Your Photo" /> -->


              <label for="file-input" class="custom-file-upload position-absolute">
                <img src="assets/images/camera.png" alt="Upload image">
              </label>
              <input type="file" class=" imgUploadBtn" data-id="<?= $id; ?>" accept="image/*" id="file-input">
            </div>
          <!-- </form> -->
        </div>
      </div>
      <div class=" col-lg-7">
              <!-- <form class="mt-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"> -->
                <div class="row my-3">
                  <div class="col-lg-3">
                    <label for="name">Name</label>
                  </div>
                  <div class="col-lg-9">
                    <input type="text" class="form-control disabled-box bg-transparent" id="updateName" name="name" placeholder="Name" value="<?= $name ?>" />
                    <small class="form-text text-danger">
                      <?php echo $name_error ?>
                    </small>
                  </div>
                </div>
                <div class="row my-3">
                  <div class="col-lg-3">
                    <label for="email">E-mail</label>
                  </div>
                  <div class="col-lg-9">
                    <input type="email" class="form-control disabled-box bg-transparent" id="updateEmail" name="email" placeholder="Email" value="<?= $email ?>" />
                    <small class="form-text text-danger">
                      <?php echo $email_error ?>
                    </small>
                  </div>
                </div>
                <div class="row my-3">
                  <div class="col-lg-3">
                    <label for="phone">Phone Number</label>
                  </div>
                  <div class="col-lg-9">
                    <input type="tel" class="form-control disabled-box bg-transparent" id="updatePhone" name="phone" value="<?= $phone ?>" placeholder="Phone Number" />
                    <small class="form-text text-danger">
                      <?php echo $phone_error ?>
                    </small>
                  </div>
                </div>
                <div class="row my-3">
                  <div class="col-lg-3">
                    <label for="address">Address</label>
                  </div>
                  <div class="col-lg-9">
                    <input type="address" class="form-control disabled-box bg-transparent" id="updateAddress" name="address" placeholder="Address" value="<?= $address ?>" />
                    <small class="form-text text-danger">
                      <?php echo $address_error ?>
                    </small>
                  </div>
                </div>
                <div class="row my-3">
                  <div class="col-lg-3">
                    <label for="gender">Gender</label>
                  </div>
                  <div class="col-lg-9">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gender" id="male" value="Male" <?php if (strtolower($gender) == "male") {
                                                                                                          echo "checked";
                                                                                                        } ?> />
                      <label class="form-check-label" for="male"> Male </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gender" id="female" value="Female" <?php if (strtolower($gender) == "female") {
                                                                                                              echo "checked";
                                                                                                            } ?> />
                      <label class="form-check-label" for="female"> Female </label>
                    </div>
                    <!-- <input type="radio" class="form-control disabled-box" id="gender" name="gender" placeholder="Gender" value="male"  />
              <label class="form-check-label" for="male"> Male </label>
              <input type="radio" class="form-control disabled-box" id="gender" name="gender" placeholder="Gender" value="female"  />
              <label class="form-check-label" for="female"> Female </label> -->
                    <small class="form-text text-danger">
                      <?php echo $gender_error ?>
                    </small>
                  </div>
                </div>
                <div class="row my-3">
                  <div class="col-lg-6">
                    <button class="btn btn-primary updateProfileBtn" type="submit" name="update">Update</button>
                  </div>
                </div>
              <!-- </form> -->
            </div>
        </div>
      </div>
    </div>

    <?php include('includes/footer.php'); ?>