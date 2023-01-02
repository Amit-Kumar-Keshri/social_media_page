<?php



function validation_check(){

    
    if (empty($_POST['name'])) {
        $name_error = 'Required';
      } else if (preg_match($VALID_NAME_PATTERN, $_POST['name'])) {
        $name_error = "";
        $name = $_POST['name'];
      } else {
        $name_error = 'Name Should not include number';
      }
    
      if (empty($_POST['email'])) {
        $email_error = 'Required';
      } else if (preg_match($VALID_EMAIL_PATTERN, $_POST['email'])) {
        $email_error = "";
        $email = $_POST['email'];
      } else {
        $email_error = 'Enter a Valid Mail ID';
      }
    
    
      if (empty($_POST['password'])) {
        $password_error = 'Required';
      } else if (strlen($_POST['password']) > 0 && strlen($_POST['password']) < 8) {
        $password_error = 'Should be at least 8 characters';
      } else {
        $password_error = "";
        $password = md5($_POST['password']);
      }
    
    
      if (empty($_POST['phone'])) {
        $phone_error = 'Required';
      } else if (preg_match($VALID_PHONE_PATTERN, $_POST['phone'])) {
        $phone_error = "";
        $phone = $_POST['phone'];
      } else {
        $phone_error = 'Only a Indian Phone No allowed';
      }
    
    
      if (empty($_POST['address'])) {
        $address_error = 'Required';
      } else {
        $address_error = "";
        $address = $_POST['address'];
      }
    
      if (empty($_POST['gender'])) {
        $gender_error = 'Required';
      } else {
        $gender_error = "";
        $gender = $_POST['gender'];
      }
}

function update_data(){
    
}


function validation(){

}
?>
