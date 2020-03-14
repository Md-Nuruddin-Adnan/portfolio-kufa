<?php
session_start();
require_once('../includes/db.php');

$counter_id = $_POST['counter_id'];
$counter_icon = htmlentities($_POST['counter_icon'], ENT_QUOTES);
$counter_count = htmlentities($_POST['counter_count'], ENT_QUOTES);
$counter_name = htmlentities( $_POST['counter_name'], ENT_QUOTES);

if(empty($counter_icon) || empty($counter_count) || empty($counter_name)){
  $_SESSION['counter_update_error'] = "Something is wrong!";
}
else {
  echo $update_query = "UPDATE counters SET counter_icon = '$counter_icon', counter_count = '$counter_count', counter_name = '$counter_name' WHERE id = '$counter_id'";
  mysqli_query($db_connect, $update_query);
  $_SESSION['counter_update_success'] = "One counter update successfully";
}
header("location: counter_view.php");
?>