<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include_once('db.php');

if (isset($_POST['action']) && $_POST['action'] == 'add_friend_action') {
	add_as_friend_func($_POST['people_id']);
}
if (isset($_POST['action']) && $_POST['action'] == 'upload_image_action') {
	mya_fileupload($_FILES['image_file']['name'], $_POST['user_id']);
}


function mya_fileupload($file, $id)
{
	$target_dir = "uploads/";
	$target_file = $target_dir . $file;
	if (move_uploaded_file($_FILES["image_file"]["tmp_name"], $target_file)) {
		
		$image_upload_query = "update tb_registration set profile_image='$file' where id='$id' ";
		connect_database()->query($image_upload_query);
		$file_error = false;
	} else {
		$file_error = true;
	}
	echo json_encode(array('status' => 200,'image' =>$target_file));
	exit();

}


function add_as_friend_func($people_id)
{
	$current_user_id = $_COOKIE['login_auth'];
	$date_added = date("l jS \of F Y h:i:s A");
	echo $current_user_id;
	$insert_query = "INSERT INTO tb_request (added_by, requested_to, date_of_added) VALUES ('$current_user_id', '$people_id', '$date_added')";
	if ($result = connect_database()->query($insert_query)) {
		$status = true;
	} else {
		$status = false;
		$message = 'Failed' . connect_database()->error;
	}
	mysqli_close(connect_database());
	echo json_encode(array('status' => $status, ));
	exit();
}