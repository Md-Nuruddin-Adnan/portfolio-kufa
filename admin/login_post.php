<?php
session_start();
require_once('../includes/db.php');

$user_email = $_POST['user_email'];
$user_password = md5($_POST['user_password']);

$user_select_query = "SELECT * FROM users WHERE user_email = '$user_email' AND user_password = '$user_password'";
$user_to_db = mysqli_query($db_connect, $user_select_query);
$user_assoc = mysqli_fetch_assoc($user_to_db);

if($user_to_db->num_rows == 1){
 $_SESSION['login_success'] = "Login Successfull";
 $_SESSION['user_name'] = $user_assoc['user_name'];
 $_SESSION['user_email'] = $user_assoc['user_email'];
 $_SESSION['user_role'] = $user_assoc['role'];

 header("location: index.php");
}
else{
  $_SESSION['login_error'] = "User Name or Password is worng";
  header("location: login.php");
}



?>