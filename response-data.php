<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include_once('includes/db.php');

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
if (isset($_POST['action']) && $_POST['action'] == 'update_data') {
	update_data($_POST['name'],$_POST['email'],$_POST['phone'],$_POST['address'],$_POST['gender'],$_COOKIE['login_auth']);
}

if (isset($_POST['action']) && $_POST['action'] == 'msg_sent') {
	chat_message_insert($_POST['message_data'], $_POST['reciever_id'], $_COOKIE['login_auth']);
}
if (isset($_POST['action']) && $_POST['action'] == 'msg_populator') {
	chat_message_populator($_POST['reciever_id'], $_COOKIE['login_auth']);
}
if (isset($_POST['action']) && $_POST['action'] == 'check_msg') {
	check_msg_interval($_POST['reciever_id'], $_COOKIE['login_auth']);
}
if (isset($_POST['action']) && $_POST['action'] == 'check_msg_counter') {
	check_msg_counter($_POST['reciever_id'], $_COOKIE['login_auth']);
}

function check_msg_counter($reciever_id, $sender_id){
	$count_query = "Select status from tb_chat where sender = '$reciever_id' AND receiver = '$sender_id' AND status = 'unseen'"; 
	if ($result = connect_database()->query($count_query)) {
		$result = $result->fetch_all();
		$status = true;
    }
	else{
		$status = false;
	}
	mysqli_close(connect_database());
	echo json_encode(array('status' => $status, 'message_counter' => count($result)));
	exit();
}
function chat_message_insert($message_data, $reciever_id, $current_user_id){
	$message_status = "unseen";
	$date_added = date("l jS \of F Y h:i:s A");
	$insert_query = "INSERT INTO tb_chat (sender, receiver, message, date_added, status) VALUES ('$current_user_id', '$reciever_id', '$message_data', '$date_added', '$message_status')";
	if ($result = connect_database()->query($insert_query)) {
		$status = true;
	} else {
		$status = false;
	}
	mysqli_close(connect_database());
	echo json_encode(array('status' => $message_status));
	exit();
}
function chat_message_populator($reciever_id, $sender_id){
	$message_status = "seen";
	$message_data = [];

	$query = "Select id,message from tb_chat where sender = '$sender_id' AND receiver = '$reciever_id' ORDER BY id ASC";
    if ($result = connect_database()->query($query)) {
        $row_message = $result->fetch_all();
        mysqli_close(connect_database());
		$status = true;
    }
	else{
		$status = false;
	}
    foreach ($row_message  as $key => $value) {
    	$row_id = $value[0];
    	$row_message = $value[1];
    	$message_data[$row_id] = '<p class="small p-2 m-3  text-white rounded-5 bg-primary w-50 crrnt_user">'.$row_message.'</p>';
    }

    

    $query = "Select id,message from tb_chat where sender = '$reciever_id' AND receiver = '$sender_id' ORDER BY id ASC";
    if ($result = connect_database()->query($query)) {
        $row_message = $result->fetch_all();
        mysqli_close(connect_database());
		$status = true;
    }
	else{
		$status = false;
	}
    foreach ($row_message  as $key => $value) {
    	$row_id = $value[0];
    	$row_message = $value[1];
    	$message_data[$row_id] = '<p class="small p-2 m-3  text-white rounded-5 bg-primary w-50 frnd_user">'.$row_message.'</p>';
    }

	ksort($message_data);

	$update_query = "update tb_chat set status='$message_status' where sender = '$reciever_id' AND receiver = '$sender_id' AND status = 'unseen'"; 
	if ($result = connect_database()->query($update_query)) {
        mysqli_close(connect_database());
		$status = true;
    }
	else{
		$status = false;
	} 
	echo json_encode(array('status' => $status, 'message_date' => $message_data));
	exit();	
}

function check_msg_interval($reciever_id, $sender_id){
	$message_data = [];

	$query = "Select id,message from tb_chat WHERE sender = '$reciever_id' AND receiver = '$sender_id' AND status = 'unseen' ORDER BY id ASC";
	if ($result = connect_database()->query($query)) {
		$row_message = $result->fetch_all();
		$msg_count = count($row_message);
		$status = true;
		if($msg_count>0) {
			foreach ($row_message  as $key => $value) {
				$row_id = $value[0];
				$row_message = $value[1];
				$message_data[$row_id] = '<p class="small p-2 m-3  text-white rounded-5 bg-primary w-50 frnd_user">'.$row_message.'</p>';
			}
			$update_chat_query = "update tb_chat set status='seen' where sender = '$reciever_id' AND receiver = '$sender_id' ";
			if ($result  = connect_database()->query($update_chat_query)) {
				$status = true;
			}
		} else {
			$msg_count = 0;
		}
	} else {
		$status = false;
		$msg_count = 0;
	}
	mysqli_close(connect_database());
	//echo json_encode(array(, 'message_date' => $message_data));
	echo json_encode(array('status' => $status, 'message_data' => $message_data, 'message_count' => $msg_count));
	exit();	
}



function add_comment_func($comment_data, $post_id, $current_user_id) {
	$date_added = date("l jS \of F Y h:i:s A");
	$post_insert_query = "INSERT INTO tb_reactions (added_by, post_id, added_comment, liked, date_added) VALUES ('$current_user_id' , '$post_id' , '$comment_data' , 0 , '$date_added')";
	if ($result = connect_database()->query($post_insert_query)) {
		$status = true;
		mysqli_close(connect_database());
	} else {
		$status = false;
	}
	echo json_encode(array('status' => $status));
	exit();	
}

function add_like_react_func($post_id, $current_user_id) {
	$date_added = date("l jS \of F Y h:i:s A");
	$post_insert_query = "INSERT INTO tb_reactions (added_by, post_id, added_comment, liked, date_added) VALUES ('$current_user_id','$post_id','',1,'$date_added')";
	if ($result = connect_database()->query($post_insert_query)) {
		$status = true;

		$count_query = "Select liked from tb_reactions where post_id = '$post_id' and liked='1'";
		$result = connect_database()->query($count_query)->fetch_all();
		$total_likes = count($result);

		mysqli_close(connect_database());
	} else {
		$total_likes = 0;
		$status = false;
	}
	echo json_encode(array('status' => $status, 'total_likes' => $total_likes));
	exit();
}

function post_upload_function($post_caption, $post_file, $user_id){
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
	echo json_encode(array('status' => $status,'image' => $target_file, 'file_type' => $FileType, 'post_caption' => $post_caption));
	exit();

	//'image' => $target_file, 'file_type' => $FileType, 'post_caption' => $post_caption
}


function mya_fileupload($image_file, $user_id){
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


function add_as_friend_func($people_id){
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
function friend_request_accept_helper($sender_id){
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
function friend_request_reject_helper($sender_id){
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

function update_data($name, $email, $phone, $address, $gender, $user_id){	$user_id = $_COOKIE['login_auth'];
	$update_query = "UPDATE tb_registration SET name = '$name', email='$email', phone='$phone', address='$address', gender='$gender' where id = '$user_id'";
	if ($result = connect_database()->query($update_query)) {
		$status = true;
	} else {
		$status = false;
	}
	mysqli_close(connect_database());
	echo json_encode(array('status' => $status,'name' => $name ,'email' => $email, 'phone' => $phone ,'address' => $address ,'gender' => $gender));
	exit();
}


