<?php
include("db.php");
include('functions.php');
if (isset($_COOKIE['login_auth'])) {
    header("Location: my-account-new.php");
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = md5($_POST['password']);
    if (sm_login_user($email, $pass) == 'success') {
        header("Location: my-account.php");
    } else {
        $error_message = 'Invalid Credentials';
    }
}
?>
<?php include('includes/header.php'); ?>
<section class="min-vh-100 gradient">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card form-page text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        <div class="mb-md-5 mt-md-4 pb-5">
                            <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                            <p class="text-white mb-5">Please enter your login and password!</p>
                            <form action="login.php" method="POST">
                                <div class="form-outline form-white mb-4">
                                    <input type="email" name="email" id="typeEmailX"
                                        class="form-control form-control-lg" />
                                    <label class="form-label" for="typeEmailX">Email</label>
                                </div>
                                <div class="form-outline form-white mb-4">
                                    <input type="password" name="password" id="typePasswordX"
                                        class="form-control form-control-lg" />
                                    <label class="form-label" for="typePasswordX">Password</label>
                                </div>
                                <p class="small mb-5 pb-lg-2"><a class="text-white" href="#!">Forgot password?</a></p>
                                <button class="btn btn-outline-light btn-lg px-5" name="login"
                                    type="submit">login</button>
                            </form>
                        </div>
                        <div>
                            <p class="mb-0">Don't have an account? <a href="registration.php"
                                    class="text-white fw-bold">Sign Up</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include('includes/footer.php'); ?>