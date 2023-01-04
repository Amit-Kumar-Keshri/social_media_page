<?php 
ini_set('display_errors',1); 
error_reporting(E_ALL);
include_once('db.php');

if(isset($_POST['action']) && $_POST['action']=='add_friend_action'){
	add_as_friend_func($_POST['people_id']);
}


function add_as_friend_func($people_id) {
	
	$current_user_id = $_COOKIE['login_auth'];
	$date_added = date("l jS \of F Y h:i:s A");

    $insert_query = "INSERT INTO tb_request (added_by, requested_to, date_of_added) VALUES ('$current_user_id', '$people_id', '$date_added')";
    if ($result = connect_database()->query($insert_query)) {
        $status = true;
        $message = 'User Successfully Registered';
    } else {
        $status = false;
        $message = 'Failed' . connect_database()->error;
    }
    mysqli_close(connect_database());

	echo json_encode(array('status'=> $status,));
	exit();
}


