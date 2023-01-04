<?php 
ini_set('display_errors',1); 
error_reporting(E_ALL);
include_once('db.php');
include('functions.php');

if(isset($_POST['action']) && $_POST['action']=='add_friend_action'){
	add_as_friend_func($_POST['people_id']);
}
if(isset($_POST['action']) && isset($_POST['name']) && $_POST['action']=='upload_image_action'){
	mya_fileupload($_POST['name'],$_POST['user_id']);
}





