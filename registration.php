<?php
include('db.php');

$VALID_EMAIL_PATTERN = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
$VALID_PHONE_PATTERN = "/^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[6789]\d{9}$/";
$VALID_NAME_PATTERN = "/^([a-zA-Z' ]+)$/";
$name_error = $email_error = $phone_error = $username_error = $password_error = $address_error = $gender_error = '';
$name = $email = $phone = $username = $password = $address = $gender = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST['name'])) {
    $name_error = 'Required';
  } else if (preg_match($VALID_NAME_PATTERN, $_POST['name'])) {
    $name_error = "";
    $name = $_POST['name'];
  } else {
    $name_error = 'Name Should not include number';
  }

  if (empty($_POST['email'])) {
    $email_error = 'Required';
  } else if (preg_match($VALID_EMAIL_PATTERN, $_POST['email'])) {
    $email_error = "";
    $email = $_POST['email'];
  } else {
    $email_error = 'Enter a Valid Mail ID';
  }


  if (empty($_POST['password'])) {
    $password_error = 'Required';
  } else if (strlen($_POST['password']) > 0 && strlen($_POST['password']) < 8) {
    $password_error = 'Should be at least 8 characters';
  } else {
    $password_error = "";
    $password = md5($_POST['password']);
  }


  if (empty($_POST['phone'])) {
    $phone_error = 'Required';
  } else if (preg_match($VALID_PHONE_PATTERN, $_POST['phone'])) {
    $phone_error = "";
    $phone = $_POST['phone'];
  } else {
    $phone_error = 'Only a Indian Phone No allowed';
  }


  if (empty($_POST['address'])) {
    $address_error = 'Required';
  } else {
    $address_error = "";
    $address = $_POST['address'];
  }

  if (empty($_POST['gender'])) {
    $gender_error = 'Required';
  } else {
    $gender_error = "";
    $gender = $_POST['gender'];
  }

  if ($name_error == "" && $email_error == "" && $username_error == "" && $password_error == "" && $phone_error == "" && $address_error == "" && $gender_error == "") {
    $sql = "SELECT * FROM tb_registration WHERE email='$email'";
    $result = connect_database()->query($sql);
    if ($result->num_rows > 0) {
      $email_error = "Email Already Registered";
    } else {
      $insert_query = "INSERT INTO tb_registration (name, email, password, phone, address, gender) VALUES ('$name', '$email', '$password', '$phone', '$address', '$gender')";
      if ($result = connect_database()->query($insert_query)) {
        $message = 'Data Inserted';
      } else {
        $message = 'Failed' . connect_database()->error;
      }

      echo $message;
    }
    mysqli_close(connect_database());
  }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registration-Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous" />
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <section class="min-vh-100 gradient">
    <div class="d-flex justify-content-center align-items-center gx-5 form-body h-100">
      <form class="form-page" action="" method="POST">
        <!-- title -->
        <div class="row">
          <div class="col-lg-12">
            <h2 class="text-center ">Sign Up</h2>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-lg-12 my-2">
            <label for="name">Full name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" />
            <small class="form-text text-danger">
              <?php echo $name_error ?>
            </small>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-6 my-2">
            <label for="email">E-mail:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" />
            <small class="form-text text-danger">
              <?php echo $email_error ?>
            </small>
          </div>
          <div class="col-lg-6 my-2">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" />
            <small class="form-text text-danger">
              <?php echo $password_error ?>
            </small>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 my-2">
            <label for="phone">Phone-no.:</label>
            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone-number" />
            <small class="form-text text-danger">
              <?php echo $phone_error ?>
            </small>
          </div>
          <!-- <div class="col-lg-6 my-2">
                    <label for="validationCustom01">Re-type Phone-number:</label>
                   <input type="tel" class="form-control" id="validationCustom01" name="re-phone" placeholder="Re-type phone-number" >
                  
                </div> -->
        </div>
        <div class="row">
          <div class="col-lg-12 my-2">
            <label for="address">Address</label>
            <textarea class="form-control" name="address" rows="3"></textarea>
            <small class="form-text text-danger">
              <?php echo $address_error ?>
            </small>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 my-2">
            <div>
              Choose your Gender:
              <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="male" value="Male"/>
                <label class="form-check-label" for="male"> Male </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="female" value="Female" />
                <label class="form-check-label" for="female"> Female </label>
              </div>
            </div>
            <small class="form-text text-danger">
              <?php echo $gender_error ?>
            </small>
          </div>
        </div>
        <div class="text-center col-lg-12">
          <button class="btn btn-outline-light btn-lg px-4" type="submit">Sign Up</button>
        </div>
        <div class="text-center mt-2">
          <p class="mb-0 text-white">Don't have an account? <a href="login.php" class="text-white-50 fw-bold">Login</a>
          </p>
        </div>
      </form>
    </div>
  </section>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>

</html>