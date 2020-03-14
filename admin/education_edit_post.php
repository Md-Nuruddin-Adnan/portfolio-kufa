<?php
session_start();
require_once('../includes/db.php');

$id = $_POST['education_id'];
$education_name = htmlentities($_POST['education_name'], ENT_QUOTES);
$passing_year = $_POST['passing_year'];
$progress = $_POST['progress'];

if(empty($education_name) || empty($passing_year) | empty($progress)){
 $_SESSION['education_edit_error'] = "Please fill out all the field";
}
else if(!filter_var($passing_year, FILTER_SANITIZE_NUMBER_INT) || strlen($passing_year) != 4){
 $_SESSION['education_edit_error'] = "Please enter a valid year";
}
else if(!filter_var($progress, FILTER_SANITIZE_NUMBER_INT) || $progress > 100 || $progress < 1){
 $_SESSION['education_edit_error'] = "Please enter a valid progress between 1 - 100";
}
else {
  $update_query = "UPDATE educations SET education_name = '$education_name', passing_year = '$passing_year', progress = '$progress' WHERE id = $id";
  mysqli_query($db_connect, $update_query);
  $_SESSION['education_edit_success'] = "Education edit successfully";
}
header("location: about_view.php#education_section");
?>