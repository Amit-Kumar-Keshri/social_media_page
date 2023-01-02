<?php
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

include('db.php');

$VALID_EMAIL_PATTERN = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
$VALID_PHONE_PATTERN = "/^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[6789]\d{9}$/";
$VALID_NAME_PATTERN = "/^([a-zA-Z' ]+)$/";


$name_error = $email_error = $phone_error = $address_error = $gender_error = '';
$update_name = $update_email = $update_phone = $update_address = $update_gender = '';


$id = $_COOKIE["login_auth"];
$query = "Select * from tb_registration where id='$id'";
$result = connect_database()->query($query);
$row = $result->fetch_assoc();
$name = $row['name'];
$email = $row['email'];
$phone = $row['phone'];
$address = $row['address'];
$gender = $row['gender'];
$profile_image = $row['profile_image'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_FILES["file"])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if ($check !== false) {
      if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {

        $profile_image = htmlspecialchars(basename($_FILES["file"]["name"]));
        $image_upload_query = "update tb_registration set profile_image='$profile_image' where id='$id' ";
        connect_database()->query($image_upload_query);
      } else {
        echo "Sorry, there was an error uploading your file.";
      }

      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }
  } else {
    $image_error = "required";
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['name'])) {
    if (strcmp($name, $_POST['name']) != 0 && preg_match($VALID_NAME_PATTERN, $_POST['name'])) {
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
    if (strcmp($email, $_POST['email']) != 0 && preg_match($VALID_EMAIL_PATTERN, $_POST['email'])) {
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
    if (strcmp($phone, $_POST['phone']) != 0 && preg_match($VALID_PHONE_PATTERN, $_POST['phone'])) {
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

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Welcome <?= $name ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous" />
  <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
  <div class="row">
    <div class="col-lg-12  ">
      <div class="blue-header d-flex flex-column justify-content-center">
        <h1 class="text-center">Welcome <?= $name ?></h1>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-lg-4 my-3 highlight">
        <div class="image-container ">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
            <img class="img-fluid" src="uploads/<?= $profile_image ?>" />
            <div class="row my-3">
              <div class="col">
                <input type="file" class="form-control" id="file" name="file" placeholder="Upload Your Photo" value="<?= $name ?>" />
              </div>
            </div>
            <div class="text-center upload-button">
              <button class="my-3 btn btn-primary" name="upload" type="submit">
                Upload photo
              </button>
            </div>
          </form>
        </div>
      </div>
      <div class="col-lg-8">

        <form class="mt-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
          <div class="row my-3">
            <div class="col-3">
              <label for="name">Name</label>
            </div>
            <div class="col-9">
              <input type="text" class="form-control disabled-box" id="name" name="name" placeholder="Name" value="<?= $name ?>" disabled />
              <small class="form-text text-danger">
                <?php echo $name_error ?>
              </small>
            </div>
          </div>

          <div class="row my-3">
            <div class="col-3">
              <label for="email">E-mail</label>
            </div>
            <div class="col-9">
              <input type="email" class="form-control disabled-box" id="email" name="email" placeholder="Email" value="<?= $email ?>" disabled />
              <small class="form-text text-danger">
                <?php echo $email_error ?>
              </small>
            </div>
          </div>
          <div class="row my-3">
            <div class="col-3">
              <label for="phone">Phone Number</label>
            </div>
            <div class="col-9">
              <input type="tel" class="form-control disabled-box" id="phone" name="phone" value="<?= $phone ?>" placeholder="Phone Number" disabled />
              <small class="form-text text-danger">
                <?php echo $phone_error ?>
              </small>
            </div>
          </div>
          <div class="row my-3">
            <div class="col-3">
              <label for="address">Address</label>
            </div>
            <div class="col-9">
              <input type="address" class="form-control disabled-box" id="address" name="address" placeholder="Address" value="<?= $address ?>" disabled />
              <small class="form-text text-danger">
                <?php echo $address_error ?>
              </small>
            </div>
          </div>
          <div class="row my-3">
            <div class="col-3">
              <label for="gender">Gender</label>
            </div>
            <div class="col-9">
              <input type="gender" class="form-control disabled-box" id="gender" name="gender" placeholder="Gender" value="<?= $gender ?>" disabled />
              <small class="form-text text-danger">
                <?php echo $gender_error ?>
              </small>
            </div>
          </div>

          <div class="row my-3">
            <div class="col-6">
              <a class=" btn btn-primary edit-button gy-3">Edit</a>
              <!-- <a class=" btn btn-primary gy-3" href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?logout=true">Logout</a> -->
              <button class="btn btn-primary" type="submit" name="update" disabled>Update</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="assets/js/script.js"></script>

</html>