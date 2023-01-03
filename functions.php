<?php

function sm_login_user($email_address,$password){
    $query = "SELECT * FROM tb_registration where email='$email_address' and password='$password'";
    if ($result = connect_database()->query($query)) {
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $name = $row['name'];
            $id = $row['id'];
            setcookie('login_auth', $id, time() + (86400 * 30), "/");
            $message = true;
        } else {
           $message = false;
        }
    } else {
        $message = false;
    }
    mysqli_close(connect_database());

    return $message;
}



function reg_validation_check($fullname,$email_address,$password,$phone_number,$address,$gender) {
    $VALID_EMAIL_PATTERN = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
    $VALID_PHONE_PATTERN = "/^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[6789]\d{9}$/";
    $VALID_NAME_PATTERN = "/^([a-zA-Z' ]+)$/";

    if($fullname=='' || $email_address=='' || $password=='' || $phone_number=='' || $address=='' || $gender==''){
        $message = 'Please fill up the Required Fields';
        $status = false;
    } else if(!preg_match($VALID_NAME_PATTERN, $_POST['name'])) {
        $message = 'Please check the Name Field';
        $status = false;
    } else if(!preg_match($VALID_EMAIL_PATTERN, $_POST['email'])) {
        $message = 'Please check the Email Field';
        $status = false;
    } else if(strlen($_POST['password']) > 0 && strlen($_POST['password']) < 8) {
        $message = 'Should be at least 8 characters';
        $status = false;
    } else if(!preg_match($VALID_PHONE_PATTERN, $_POST['phone'])) {
        $message = 'Only Indian Format Phone Number allowed';
        $status = false;
    } else {
      $message = 'Validation Successfull. Ready for Register';
      $status = true;
    }
    $response = array('status'=>$status, 'message'=> $message);
    return $response;
}

function insert_registration_data($fullname,$email_address,$password,$phone_number,$address,$gender){
    $profile_image = 'demo.png';
    $sql = "SELECT * FROM tb_registration WHERE email='$email_address'";
    $result = connect_database()->query($sql);
    if ($result->num_rows > 0) {
      $status = false;
      $message = "Email Already Registered";
    } else {
      $insert_query = "INSERT INTO tb_registration (name, email, password, phone, address, gender, profile_image) VALUES ('$fullname', '$email_address', '$password', '$phone_number', '$address', '$gender','$profile_image')";
      if ($result = connect_database()->query($insert_query)) {
        $status = true;
        $message = 'User Successfully Registered';
      } else {
        $status = false;
        $message = 'Failed' . connect_database()->error;
      }
    }
    mysqli_close(connect_database());
    $response = array('status'=>$status, 'message'=> $message);
    return $response;
}


function retrive_data($id){
    $query = "Select * from tb_registration where id='$id'";
    $result = connect_database()->query($query);
    $row = $result->fetch_assoc();
    return $row;
}




function fileupload($file){
    if (isset($file)) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($file["file"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($file["file"]["tmp_name"]);
        if ($check !== false) {
          if (move_uploaded_file($file["file"]["tmp_name"], $target_file)) {
    
            $profile_image = htmlspecialchars(basename($file["file"]["name"]));
            $image_upload_query = "update tb_registration set profile_image='$profile_image' where id='$id' ";
            connect_database()->query($image_upload_query);
          } else {
            $file_error = true;
            return $file_error;
          }
    
          $uploadOk = 1;
        } else {
            $file_error = "File is not an image.";
            return $file_error;
            $uploadOk = 0;
        }
      } else {
        $file_error = "required";
        return $file_error;
      }
}
?>
