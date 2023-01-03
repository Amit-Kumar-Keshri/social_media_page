<?php
include("db.php");
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


$VALID_EMAIL_PATTERN = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
$VALID_PHONE_PATTERN = "/^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[6789]\d{9}$/";
$VALID_NAME_PATTERN = "/^([a-zA-Z' ]+)$/";


$name_error = $email_error = $phone_error = $address_error = $gender_error = $image_error ='';
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
if (isset($_POST['upload'])) {
  $upload_profile_check = mya_fileupload($_FILES['file'],$id);
  if ($upload_profile_check['status']){
     $profile_image = $upload_profile_check['image'];
     $image_error = '';
  }
  else{
    $image_error = "File not Upload";
  }
}

if (isset($_POST['update'])) {
  if (isset($_POST['name'])) {
    if (strcmp($name, $_POST['name']) != 0) {
      $name_error = "";
      $update_name = $_POST['name'];
      $update_query = "UPDATE tb_registration SET name='$update_name' where id = '$id'";
      connect_database()->query($update_query);
    } else {
      $name_error = "";
    }
  } else {
    $name_error = "Required";
  }

  if (isset($_POST['email'])) {
    if (strcmp($email, $_POST['email']) != 0) {
      $email_error = "";
      $update_email = $_POST['email'];
      $check_query = "Select * from tb_registration where email='$update_email'";
      $result = connect_database()->query($check_query);
      if ($result->num_rows > 0) {
        $email_error = "Email Already Registered";
      } else {
        $update_query = "UPDATE tb_registration SET email='$update_email' where id = '$id'";
        connect_database()->query($update_query);
      }
    } else {
      $email_error = "";
    }
  } else {
    $email_error = "Required";
  }

  if (isset($_POST['phone'])) {
    if (strcmp($phone, $_POST['phone']) != 0) {
      $phone_error = "";
      $update_phone = $_POST['phone'];
      $update_query = "UPDATE tb_registration SET phone='$update_phone' where id = '$id'";
      connect_database()->query($update_query);
    } else {
      $phone_error = "";
    }
  } else {
    $phone_error = "Required";
  }

  if (isset($_POST['address'])) {
    if (strcmp($address, $_POST['address']) != 0) {
      $address_error = "";
      $update_address = $_POST['address'];
      $update_query = "UPDATE tb_registration SET address='$update_address' where id = '$id'";
      connect_database()->query($update_query);
    } else {
      $address_error = "";
    }
  } else {
    $address_error = "Required";
  }

  if (isset($_POST['gender'])) {
    if (strcmp($gender, $_POST['gender']) != 0) {
      $gender_error = "";
      $update_gender = $_POST['gender'];
      $update_query = "UPDATE tb_registration SET gender='$update_gender' where id = '$id'";
      connect_database()->query($update_query);
    } else {
      $gender_error = "";
    }
  } else {
    $gender_error = "Required";
  }
}
include('includes/header.php');
?>
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
        <div class="image-container ">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
          <div class="image-container"> 
          <img class="profile-image"  src="uploads/<?= $profile_image ?>" />
</div>
            <div class="row my-3 justify-content-center align-items-center">
              
                <input type="file" class="form-control" id="file" name="file" placeholder="Upload Your Photo" />
                <small class="form-text text-danger ">
                <?php echo $image_error ?>
              </small>
              
            </div>
            <div class="text-center upload-button">
              <button class="my-3 btn btn-primary" name="upload" type="submit">
                Upload photo
              </button>
            </div>
          </form>
        </div>
      </div>
      <div class="col-lg-7">

        <form class="mt-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
          <div class="row my-3">
            <div class="col-lg-3">
              <label for="name">Name</label>
            </div>
            <div class="col-lg-9">
              <input type="text" class="form-control disabled-box" id="name" name="name" placeholder="Name" value="<?= $name ?>" disabled />
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
              <input type="email" class="form-control disabled-box" id="email" name="email" placeholder="Email" value="<?= $email ?>" disabled />
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
              <input type="tel" class="form-control disabled-box" id="phone" name="phone" value="<?= $phone ?>" placeholder="Phone Number" disabled />
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
              <input type="address" class="form-control disabled-box" id="address" name="address" placeholder="Address" value="<?= $address ?>" disabled />
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
                <input class="form-check-input" type="radio" name="gender" id="male" value="Male" <?php if(strtolower($gender) == "male"){ echo "checked";} ?>/>
                <label class="form-check-label" for="male"> Male </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="female" value="Female" <?php if(strtolower($gender) == "female"){ echo "checked";} ?> />
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
              <a class=" btn btn-primary edit-button gy-3">Edit</a>
              <button class="btn btn-primary" type="submit" name="update" disabled>Update</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include('includes/footer.php'); ?>