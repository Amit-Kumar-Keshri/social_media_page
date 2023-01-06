<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include_once('db.php');

if (isset($_POST['action']) && $_POST['action'] == 'add_friend_action') {
	add_as_friend_func($_POST['people_id']);
}
if (isset($_POST['action']) && $_POST['action'] == 'accept_action') {
	friend_request_accept_helper($_POST['sender_id']);
}
if (isset($_POST['action']) && $_POST['action'] == 'reject_action') {
	friend_request_reject_helper($_POST['sender_id']);
}
if (isset($_POST['action']) && $_POST['action'] == 'upload_image_action') {
	mya_fileupload($_FILES['image_file'], $_POST['user_id']);
}

if (isset($_POST['action']) && $_POST['action'] == 'upload_post_action') {
	post_upload_function($_FILES['post_file'], $_COOKIE['login_auth']);
}

function post_upload_function($post_file, $user_id)
{
	$target_dir = "uploads/posts/";
	$filename = $post_file["name"];
	$target_file = $target_dir . $filename;
	$date_added = date("l jS \of F Y h:i:s A");

	$FileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

	if ($FileType == 'jpg' || $FileType == 'jpeg' || $FileType == 'png' || $FileType == 'gif') {
		$file_type = 'image';
	} else if ($FileType == 'mp4' || $FileType == 'avi' || $FileType == 'webm' || $FileType == 'flv') {
		$file_type = 'video';
	} else {
		$file_type = 'UNKNOWN';
	}

	if (move_uploaded_file($post_file["tmp_name"], $target_file)) {
		$post_insert_query = "INSERT INTO tb_post (user_id, media_path, date_added, file_type) VALUES ('$user_id', '$filename', '$date_added', '$file_type')";
		if ($result = connect_database()->query($post_insert_query)) {
			$status = true;
			mysqli_close(connect_database());
		} else {
			$status = false;
		}
	} else {
		$status = false;
	}
	echo json_encode(array('status' => $status, 'image' => $target_file, 'file_type' => $FileType));
	exit();
}


function mya_fileupload($image_file, $user_id)
{
	$target_dir = "uploads/";
	$filename = $image_file["name"];
	$target_file = $target_dir . $filename;


	if (move_uploaded_file($image_file["tmp_name"], $target_file)) {
		$image_upload_query = "update tb_registration set profile_image='$filename' where id='$user_id' ";
		connect_database()->query($image_upload_query);
		mysqli_close(connect_database());
		$status = true;
	} else {
		$status = false;
	}
	echo json_encode(array('status' => $status, 'image' => $target_file));
	exit();

}


function add_as_friend_func($people_id)
{
	$request_status = "requested";
	$current_user_id = $_COOKIE['login_auth'];
	$date_added = date("l jS \of F Y h:i:s A");
	$insert_query = "INSERT INTO tb_request (added_by, requested_to, status, date_of_added) VALUES ('$current_user_id', '$people_id', '$request_status', '$date_added')";
	if ($result = connect_database()->query($insert_query)) {
		$status = true;
	} else {
		$status = false;
	}
	mysqli_close(connect_database());
	echo json_encode(array('status' => $status));
	exit();
}

function friend_request_accept_helper($sender_id)
{	$accept_status = "accepted";
	$current_user_id = $_COOKIE['login_auth'];
	$update_query ="UPDATE tb_request SET status ='$accept_status' where added_by = '$sender_id' AND requested_to = '$current_user_id'";
	if ($result = connect_database()->query($update_query)) {
		$status = true;
	} else {
		$status = false;
	}
	mysqli_close(connect_database());
	echo json_encode(array('status' => $status,'request_status' => $accept_status));
	exit();
}
function friend_request_reject_helper($sender_id)
{	$reject_status = "rejected";
	$current_user_id = $_COOKIE['login_auth'];
	$update_query ="UPDATE tb_request SET status ='$reject_status' where added_by = '$sender_id' AND requested_to = '$current_user_id'";
	if ($result = connect_database()->query($update_query)) {
		$status = true;
	} else {
		$status = false;
	}
	mysqli_close(connect_database());
	echo json_encode(array('status' => $status, 'request_status' => $reject_status));
	exit();
}