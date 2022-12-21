<?php
session_start();
include('db.php');
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = md5($_POST['password']);
    $query = "SELECT * FROM tb_registration where email='$email' and password='$pass'";  // login auth query
    if ($result = connect_database()->query($query)) {

        /*-------------------------------Login Authentication---------------------------------------------------*/
        if ($result->num_rows == 1) {
            $message = 'Login Successfully';                    // login successfull msg
            /*-------------------------------User's name  Fetch From Database ---------------------------------------------------*/
            $row = $result->fetch_assoc();                      // fetcing user's name
            $name = $row['name'];
            $views = $row['views'];
            $_SESSION['user'] = $name;
            $_SESSION['views'] = $views;                        // setting up the session with the name
            /*-------------------------------Session---------------------------------------------------*/
            if (!empty($_SESSION['views'])) {                   // session views 
                $_SESSION['views'] = $_SESSION['views'] + 1;    // session views counter
                $views = $_SESSION['views'];
            } else {
                $views = 1;
            }
            /*-------------------------------User Visit Counter---------------------------------------------------*/
            $update = "UPDATE tb_registration SET views = '$views' WHERE email='$email'";  // session views set in database
            $views_count = connect_database()->query($update);
            /*----------------------------------------------------------------------------------*/
        } else {
            echo 'Invalid Credintials';
        }
    } else {
        $message = 'Failed' . connect_database()->error;
    }
    mysqli_close(connect_database());
}
if (isset($_GET['logout']) && isset($_SESSION["user"])) {
    unset($_SESSION['user']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <section class="vh-100 gradient">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <div class="mb-md-5 mt-md-4 pb-5">
                                <?php if (isset($_SESSION["user"])) {
                                    echo ("Welcome" . " $name" . "<br>" . "<br>");
                                    echo '<a class="btn btn-outline-light btn-lg px-5" href="login.php?logout=true" >Logout</a>';
                                } else { ?>
                                    <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                    <p class="text-white-50 mb-5">Please enter your login and password!</p>

                                    <form action="login.php" method="POST">
                                        <div class="form-outline form-white mb-4">
                                            <input type="email" name="email" id="typeEmailX" class="form-control form-control-lg" placeholder="Email" />
                                            <!-- <label class="form-label" for="typeEmailX">Email</label> -->
                                        </div>

                                        <div class="form-outline form-white mb-4">
                                            <input type="password" name="password" id="typePasswordX" class="form-control form-control-lg" placeholder="Password" />
                                            <!-- <label class="form-label" for="typePasswordX">Password</label> -->
                                        </div>

                                        <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p>

                                        <button class="btn btn-outline-light btn-lg px-5" name="login" type="submit">Login</button>
                                    </form>
                            </div>
                            <div>
                                <p class="mb-0">Don't have an account? <a href="registration.php" class="text-white-50 fw-bold">Sign Up</a>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
<!-- Bootstrap JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

</body>

</html>