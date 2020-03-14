<?php
session_start();
require_once('../includes/db.php');

$contact_information = trim(htmlentities($_POST['contact_information'], ENT_QUOTES));
$office_location = trim(htmlentities($_POST['office_location'], ENT_QUOTES));
$address = trim(htmlentities($_POST['address'], ENT_QUOTES));
$phone = trim($_POST['phone'], ENT_QUOTES);
$email = trim(htmlentities($_POST['email'], ENT_QUOTES));

if(empty($contact_information) || empty($office_location) || empty($address) || empty($phone) || empty($email)){
  $_SESSION['contact_edit_error'] = "Can't update empty value";
  header("location: contact_edit.php");
}
else if(!filter_var($phone, FILTER_SANITIZE_NUMBER_INT) || (strlen($phone) < 10)){
  $_SESSION['contact_edit_error'] = "please enter a valid number";
  header("location: contact_edit.php");
}
else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
  $_SESSION['contact_edit_error'] = "please enter a valid email";
  header("location: contact_edit.php");
}
else {
  $update_query = "UPDATE contacts SET contact_information = '$contact_information', office_location = '$office_location ', address = '$address', phone = '$phone', email = '$email'";
  mysqli_query($db_connect, $update_query);
  $_SESSION['contact_success'] = "Contact information update successfull";
  header("location: contact_view.php");
}
?>