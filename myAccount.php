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

include('db.php');

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

        <form class="form-page mt-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
          <div class="row my-3">
            <div class="col-3">
              <label for="name">Name</label>
            </div>
            <div class="col-9">
              <input type="text" class="form-control disabled-box" id="name" name="name" placeholder="Name" value="<?= $name ?>" disabled />
            </div>
          </div>

          <div class="row my-3">
            <div class="col-3">
              <label for="email">E-mail</label>
            </div>
            <div class="col-9">
              <input type="email" class="form-control disabled-box" id="email" name="email" placeholder="Email" value="<?= $email ?>" disabled />

            </div>
          </div>
          <div class="row my-3">
            <div class="col-3">
              <label for="phone">Phone Number</label>
            </div>
            <div class="col-9">
              <input type="tel" class="form-control disabled-box" id="phone" name="phone" value="<?= $phone ?>" placeholder="Phone Number" disabled />
            </div>
          </div>
          <div class="row my-3">
            <div class="col-3">
              <label for="address">Address</label>
            </div>
            <div class="col-9">
              <input type="address" class="form-control disabled-box" id="address" name="address" placeholder="Address" value="<?= $address ?>" disabled />
            </div>
          </div>
          <div class="row my-3">
            <div class="col-3">
              <label for="gender">Gender</label>
            </div>
            <div class="col-9">
              <input type="gender" class="form-control disabled-box" id="gender" name="gender" placeholder="Gender" value="<?= $gender ?>" disabled />
            </div>
          </div>

          <div class="row my-3">
            <div class="col-3">
              <a class=" btn btn-primary edit-button gy-3">Edit</a>
              <a class=" btn btn-primary" href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?logout=true">Logout</a>
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