<?php
include('db.php') ;
include('functions.php');
if (isset($_COOKIE['login_auth'])) {
  header("Location: my-account.php");
}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $reg_validation = reg_validation_check($_POST['name'],$_POST['email'],$_POST['password'],$_POST['phone'],$_POST['address'],$_POST['gender']);
  if($reg_validation['status']){

    $reg_res_query = insert_registration_data($_POST['name'],$_POST['email'],md5($_POST['password']),$_POST['phone'],$_POST['address'],$_POST['gender']);
      if($reg_res_query['status']){
        $success_message = $reg_res_query['message'];
      } else {
        $error_message = $reg_res_query['message'];
      }

  } else {
    $error_message = $reg_validation['message'];
  }
}
include('includes/header.php');
?>

  <section class="min-vh-100 gradient">
    <div class="d-flex justify-content-center align-items-center gx-5 form-body h-100">
      <form class="form-page" action="registration.php" method="POST">
        <!-- title -->
        <div class="row">
          <div class="col-lg-12">
            <h2 class="text-center ">Sign Up</h2>
            <h4 class="text-center ">All * marked Fields are Required</h4>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-lg-12 my-2">
            <label for="name">Full name *</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" />
          </div>
        </div>

        <div class="row">
          <div class="col-lg-6 my-2">
            <label for="email">E-mail Address *</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" />
          </div>
          <div class="col-lg-6 my-2">
            <label for="password">Password *</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" />
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 my-2">
            <label for="phone">Phone-no *</label>
            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone-number" />
          </div>


        </div>
        <div class="row">
          <div class="col-lg-12 my-2">
            <label for="address">Address *</label>
            <textarea class="form-control" name="address" rows="3"></textarea>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 my-2">
            <div>
              Choose your Gender *
              <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="male" value="Male" checked/>
                <label class="form-check-label" for="male"> Male </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="female" value="Female" />
                <label class="form-check-label" for="female"> Female </label>
              </div>
            </div>
          </div>
        </div>
        <div class="text-center col-lg-12">
          <button class="btn btn-outline-light btn-lg px-4" type="submit">Sign Up</button>
        </div>
        <div class="text-center mt-2">
          <p class="mb-0 text-white">Already have an account? <a href="login.php" class="text-white-50 fw-bold">Login</a>
          </p>
        </div>
      </form>
    </div>
  </section>
