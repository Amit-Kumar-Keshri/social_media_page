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
	post_upload_function($_POST['post_caption'], $_FILES['post_file'], $_COOKIE['login_auth']);
}

if (isset($_POST['action']) && $_POST['action'] == 'add_like_react') {
	add_like_react_func($_POST['post_id'], $_COOKIE['login_auth']);
}
if (isset($_POST['action']) && $_POST['action'] == 'add_comment') {
	add_comment_func( $_POST['comment_data'], $_POST['post_id'], $_COOKIE['login_auth']);
}


function add_comment_func($comment_data, $post_id, $current_user_id){
	$post_insert_query = "update tb_reactions set added_comment='$comment_data', added_by='$current_user_id' where post_id='$post_id'";
	if ($result = connect_database()->query($post_insert_query)) {
		$status = true;
		mysqli_close(connect_database());
	} else {
		$status = false;
	}	
	mysqli_close(connect_database());
	echo json_encode(array('status' => $status));
	exit();	
}
function add_like_react_func($post_id, $current_user_id)
{
	$date_added = date("l jS \of F Y h:i:s A");
	$post_insert_query = "INSERT INTO tb_reactions (added_by, post_id, added_comment, liked, date_added) VALUES ('$current_user_id','$post_id','','1','$date_added')";
	if ($result = connect_database()->query($post_insert_query)) {
		$status = true;
		mysqli_close(connect_database());
	} else {
		$status = false;
	}

	$count_query = "select count(liked),added_by from tb_reactions where post_id = '$post_id'";
	$result = connect_database()->query($count_query);
	$row = $result->fetch_assoc();
	$count = $row['count(liked)'];
	$check = $row['added_by'];
	if ($check == $_COOKIE['login_auth']){
		$button_status = 'disabled';
	}
	mysqli_close(connect_database());
	echo json_encode(array('status' => $status,'like' => $count));
	exit();
}

function post_upload_function($post_caption, $post_file, $user_id)
{
	$target_dir = "uploads/posts/";
	$filename = $post_file["name"];
	$target_file = $target_dir . $filename;
	$date_added = date("l jS \of F Y h:i:s A");

	$FileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

	if ($FileType == 'jpg' || $FileType == 'jpeg' || $FileType == 'png' || $FileType == 'gif' || $FileType == 'gif' || $FileType == 'webp') {
		$file_type = 'image';
	} else if ($FileType == 'mp4' || $FileType == 'avi' || $FileType == 'webm' || $FileType == 'flv') {
		$file_type = 'video';
	} else {
		$file_type = 'UNKNOWN';
	}

	if (move_uploaded_file($post_file["tmp_name"], $target_file)) {
		$post_insert_query = "INSERT INTO tb_post (user_id, post_text, media_path, date_added, file_type) VALUES ('$user_id', '$post_caption','$filename', '$date_added', '$file_type')";
		if ($result = connect_database()->query($post_insert_query)) {
			$status = true;
			mysqli_close(connect_database());
		} else {
			$status = false;
		}
	} else {
		$status = false;
	}
	echo json_encode(array('status' => $status, 'image' => $target_file, 'file_type' => $FileType, 'post_caption' => $post_caption));
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
{
	$accept_status = "accepted";
	$current_user_id = $_COOKIE['login_auth'];
	$update_query = "UPDATE tb_request SET status ='$accept_status' where added_by = '$sender_id' AND requested_to = '$current_user_id'";
	if ($result = connect_database()->query($update_query)) {
		$status = true;
	} else {
		$status = false;
	}
	mysqli_close(connect_database());
	echo json_encode(array('status' => $status, 'request_status' => $accept_status));
	exit();
}
function friend_request_reject_helper($sender_id)
{
	$reject_status = "rejected";
	$current_user_id = $_COOKIE['login_auth'];
	$update_query = "UPDATE tb_request SET status ='$reject_status' where added_by = '$sender_id' AND requested_to = '$current_user_id'";
	if ($result = connect_database()->query($update_query)) {
		$status = true;
	} else {
		$status = false;
	}
	mysqli_close(connect_database());
	echo json_encode(array('status' => $status, 'request_status' => $reject_status));
	exit();
}
