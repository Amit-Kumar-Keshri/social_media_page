<?php

if (isset($_COOKIE['login_auth'])) {
$id = $_COOKIE["login_auth"];
$query = "Select * from tb_registration where id='$id'";
$result = connect_database()->query($query);
$row = $result->fetch_assoc();
$profile_image = $row['profile_image'];
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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.css" rel="stylesheet"/>
  <!-- CUSTOM -->
  <link rel="stylesheet" href="assets/css/style.css"/>


</head>
<body>

<header>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <!-- Container wrapper -->
  <div class="container-fluid">
    <!-- Toggle button -->
    <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>

    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Navbar brand -->
      <a class="navbar-brand mt-2 mt-lg-0" href="#">
        Social Media
      </a>
    </div>
    <!-- Collapsible wrapper -->

<?php if (isset($_COOKIE['login_auth'])) { ?>
    <!-- Right elements -->
    <div class="d-flex align-items-center">
      <!-- Icon -->
      

      <!-- Notifications -->
      <div class="dropdown">
        <a
          class="text-reset me-3 dropdown-toggle hidden-arrow"
          href="#"
          id="navbarDropdownMenuLink"
          role="button"
          data-mdb-toggle="dropdown"
          aria-expanded="false"
        >
          <i class="fas fa-bell"></i>
          <span class="badge rounded-pill badge-notification bg-danger">1</span>
        </a>
        <ul
          class="dropdown-menu dropdown-menu-end"
          aria-labelledby="navbarDropdownMenuLink"
        >
          <li>
            <a class="dropdown-item" href="#">Some news</a>
          </li>
          <li>
            <a class="dropdown-item" href="#">Another news</a>
          </li>
          <li>
            <a class="dropdown-item" href="#">Something else here</a>
          </li>
        </ul>
      </div>
      <!-- Avatar -->
      <div class="dropdown">
        <a
          class="dropdown-toggle d-flex align-items-center hidden-arrow"
          href="#"
          id="navbarDropdownMenuAvatar"
          role="button"
          data-mdb-toggle="dropdown"
          aria-expanded="false"
        >
          <img
            src="uploads/<?=$profile_image?>"
            class="rounded-circle"
            height="25"
            alt="Black and White Portrait of a Man"
            loading="lazy"
          />
        </a>
        <ul
          class="dropdown-menu dropdown-menu-end"
          aria-labelledby="navbarDropdownMenuAvatar"
        >
          <li>
            <a class="dropdown-item" href="#">My profile</a>
          </li>
          <li>
            <a class="dropdown-item" href="#">Settings</a>
          </li>
          <li>
            <a class="dropdown-item" href = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?logout=true">Logout</a>
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
if(isset($error_message)) {
    echo '<p class="notification_sec error_msg bg-danger text-center w-100 text-white">'.$error_message.'</p>';
}

if(isset($success_message)) {
    echo '<p class="notification_sec success_msg bg-success text-center w-100 text-white">'.$success_message.'</p>';
}
?>