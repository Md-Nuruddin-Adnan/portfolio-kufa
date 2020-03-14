<?php
session_start();
require_once('../includes/db.php');

$new_password = md5(($_POST['new_password']));

if(empty($_POST['old_password']) || empty($_POST['new_password']) || empty($_POST['confirm_password'])){
  $_SESSION['password_error'] = "Plese fill out all the field";
}
else if(!($_POST['new_password'] == $_POST['confirm_password'])){
  $_SESSION['password_error'] = "New passord and Confirm password doesn't match";
} 
else if($_POST['old_password'] == $_POST['new_password']){
  $_SESSION['password_error'] = "New passord and Old password are same";
} 
else{
  $old_password = md5(($_POST['old_password']));
  $user_email = $_SESSION['user_email'];

  $check_query = "SELECT COUNT(*) AS user_information FROM users WHERE user_password = '$old_password' AND user_email = '$user_email'";
  $from_db = mysqli_query($db_connect, $check_query);

  if(mysqli_fetch_assoc($from_db)['user_information'] == 1){
      $new_password_sanitize = str_replace(' ', '', $new_password);

      $password_update_query = "UPDATE users SET user_password = '$new_password_sanitize' WHERE user_email = '$user_email'";
      mysqli_query($db_connect, $password_update_query);
      $_SESSION['password_update_success'] = "password update successfull";
  }
  else {
    $_SESSION['password_error'] = "Your Password is Incorrect";
  }
  
}

header("location: profile_edit.php");



?>