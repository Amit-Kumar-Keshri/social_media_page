<?php

if (isset($_GET['logout']) && isset($_COOKIE["login_auth"])) {
  header("Location:login.php");
  unset($_COOKIE['login_auth']);
  setcookie('login_auth', null, -1, '/');
  return true;
}


if (isset($_COOKIE['login_auth'])) {
  $id = $_COOKIE["login_auth"];
  $query = "Select * from tb_registration where id='$id'";
  $result = connect_database()->query($query);
  $row = $result->fetch_assoc();
  $current_user_profile_image = $row['profile_image'];
  $profile_name = $row['name'];
}
?>


<!doctype html>
<html lang="en">

<head>
  <title>Social Media Project</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.css" rel="stylesheet" />
  <!-- CUSTOM -->
  <link rel="stylesheet" href="assets/css/style.css" />


</head>

<body>

  <header>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <!-- Container wrapper -->
      <div class="container-fluid">
        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Navbar brand -->
          <a class="navbar-brand mt-2 mt-lg-0" href="https://pws-translate.dvlpsite.com/social-media/">
            Social Media
          </a>
        </div>
        <!-- Collapsible wrapper -->

        <?php if (isset($_COOKIE['login_auth'])) { ?>
          <!-- Right elements -->
          <div class="d-flex align-items-center">

            <a class="link-secondary me-3" href="index.php"><i class="fas fa-home"></i></a>
            <a class="link-secondary me-3" href="people.php"><i class="fas fa-user"></i></a>

            <!-- Icon -->


            <!-- Notifications -->
            <div class="dropdown">
              <a class="text-reset me-3 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-plus"></i>
                <?php $all_data = retrive_all_request($id); ?>
                <span class="badge rounded-pill badge-notification bg-danger request-noti">
                  <?= count($all_data) ?>
                </span>
              </a>
              <ul class="dropdown-menu dropdown-menu-end friend-request-list gradient" aria-labelledby="navbarDropdownMenuLink">
                <?php


                foreach ($all_data as $key => $value) {
                  $sender_id = $value[1];
                  $row = retrive_data($sender_id);
                  $sender_profile_image = $row['profile_image'];
                  $sender_name = $row['name'];
                  $status = $value[3];
                ?>
                  <?php if ($status == "requested") { ?>
                    <li class="m-3 user_item bg-light rounded-5 p-2">
                      <div class="row align-items-center">
                        <div class="col-4 w-auto">
                          <img src="uploads/<?= $sender_profile_image ?>" class="img-fluid rounded-circle" alt="" height="60" width="60">
                        </div>
                        <div class="col-8 ms-3">
                          <div class="row">
                            <div class="col-12">
                              <p class="m-0">
                                <?= $sender_name ?>
                              </p>
                            </div>
                            <div class="col-12">
                              <div class="row">
                                <div class="col">
                                  <button class="btn btn-success btn-accept" data-rqst-sender-id="<?= $sender_id ?>">Accept</button>
                                </div>
                                <div class="col">
                                  <button class="btn btn-danger btn-reject" data-rqst-sender-id="<?= $sender_id ?>">Reject</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                <?php
                  }
                }
                ?>

              </ul>
            </div>

            <!-- Avatar -->
            <div class="dropdown">
              <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                <img src="uploads/<?= $current_user_profile_image ?>" class="rounded-circle header-profile-image" height="25" alt="<?= $profile_name; ?>" loading="lazy" />
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                <li>
                  <a class="dropdown-item" href="profile.php">My profile</a>
                </li>
                <li>
                  <a class="dropdown-item" href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?logout=true">Logout</a>
                </li>
              </ul>
            </div>

          </div>
          <!-- Right elements -->
        <?php } ?>

      </div>
      <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
  </header>

  <?php
  if (isset($error_message)) {
    echo '<p class="notification_sec error_msg bg-danger text-center w-100 text-white">' . $error_message . '</p>';
  }

  if (isset($success_message)) {
    echo '<p class="notification_sec success_msg bg-success text-center w-100 text-white">' . $success_message . '</p>';
  }
  ?>