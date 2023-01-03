<?php
include("db.php");
include('functions.php');
?>
<?php include('includes/header.php'); ?>
  <div class="row">
    <div class="col-lg-12  ">
      <div class="blue-header d-flex flex-column justify-content-center">
        <h1 class="text-center">Showing People Around</h1>
      </div>
    </div>
  </div>

<div class="row">
    <div class="col-lg-12  ">

    </div>


<?php
$all_data = retrive_all_data();

foreach ($all_data as $key => $value) {
	$user_id = $value[0];

if($user_id!=$_COOKIE['login_auth']){
?>
<div class="user_item col-lg-3 col-md-4 col-sm-2">
	<img src="uploads/<?=$value[8];?>" alt="user_image" />
	<h3><?=$value[1];?></h3>
	<h5><?=$value[5];?></h5>
	<?php if(!check_if_alredy_added($value[0])) { ?>
		<button class="btn btn-primary add_friend_btn" data-id="<?=$value[0];?>" >Add as Friend</button>
	<?php } ?>
</div>

<?php
}
}
?>
</div>
<?php include('includes/footer.php'); ?>