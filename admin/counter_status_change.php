<?php
require_once('AUTH/auth.php');
require_once('../includes/db.php');

$counter_id = $_GET['counter_id'];

$active_counter_query = "SELECT COUNT(*) AS active_count FROM counters WHERE counter_status = 2";
$active_count =  mysqli_fetch_assoc(mysqli_query($db_connect, $active_counter_query));

if($_GET['btn'] == 'active'){
  if($active_count['active_count'] < 4){
    $update_query = "UPDATE counters SET counter_status = 2 WHERE id = '$counter_id'";
  }
  else {
    $_SESSION['active_status'] = "You can't active more than 4 counters";
  }
}
else {
  $update_query = "UPDATE counters SET counter_status = 1 WHERE id = '$counter_id'";
}

mysqli_query($db_connect, $update_query);
header("location: counter_view.php");
?>