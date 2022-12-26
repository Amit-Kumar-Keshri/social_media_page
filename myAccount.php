<?php
if (isset($_GET['logout']) && isset($_COOKIE["login_auth"])) {
    unset($_COOKIE['login_auth']); 
    setcookie('login_auth', null, -1, '/'); 
    return true;
    header("Location:login.php");
}
if(!isset($_COOKIE['login_auth'])){
    header("Location:login.php");
}

include('db.php');
$id = $_COOKIE["login_auth"];
$query = "Select * from tb_registration where id='$id'";
$result = connect_database()->query($query);
$row = $result->fetch_assoc();
$name = $row['name'];
$image = $row['profile_image'];
echo $id;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <title>Successful page</title>
</head>
<body>
    <section class="min-vh-100 form-body gradient">
        <div class="d-flex justify-content-center align-items-center gx-5 h-100">
            <div class="form-page bg-dark">
                <div class="row justify-content-center">
                    <div class="col-lg-12 text-center image-icon ">
                        <img src="uploads/<?=$image?>" alt="user image">
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h1><span><?=$name ?></span></h1>
                        <p>Congratulations!! You've been succesfully Logged in.</p>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <a href="myAccount.php?logout=true"class="btn btn-outline-light btn-lg px-5" name='log-out' type="submit">Log Out</a>
                        </div>
                    </div>
                </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>

</html>