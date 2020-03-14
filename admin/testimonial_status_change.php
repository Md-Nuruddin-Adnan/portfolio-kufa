<?php
require_once('AUTH/auth.php');
require_once('../includes/db.php');

$customer_id = $_GET['customer_id'];

$active_testimonial_query = "SELECT COUNT(*) AS active_count FROM testimonials WHERE testimonial_status = 2";
$active_count = mysqli_fetch_assoc(mysqli_query($db_connect, $active_testimonial_query));

if($_GET['btn'] == 'active'){
  if($active_count['active_count'] < 6) {
    $update_query = "UPDATE testimonials SET testimonial_status = 2 WHERE id = '$customer_id'";
  }
  else {
    $_SESSION['active_status'] = "You can't active more than 6 testimonial";
  }
}
else {
  $update_query = "UPDATE testimonials SET testimonial_status = 1 WHERE id = '$customer_id'";
}

mysqli_query($db_connect, $update_query);
header("location: testimonial_view.php");
?>