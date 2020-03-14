<?php
session_start();
require_once('../includes/db.php');

$counter_icon = htmlentities($_POST['counter_icon'], ENT_QUOTES);
$counter_count = htmlentities($_POST['counter_count'], ENT_QUOTES);
$counter_name = htmlentities( $_POST['counter_name'], ENT_QUOTES);

if(empty($counter_icon) || empty($counter_count) || empty($counter_name)){
 $_SESSION['counter_add_error'] = "Please fill out the field properly";
}
else{
  $counter_insert_query = "INSERT INTO counters (counter_icon, counter_count, counter_name) VALUES ('$counter_icon', '$counter_count', '$counter_name')";
  mysqli_query($db_connect, $counter_insert_query);
  $_SESSION['counter_add_success'] = "One new counter add successfully";
}

header('location: counter_view.php');

?>