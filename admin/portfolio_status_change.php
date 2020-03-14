<?php
require_once('AUTH/auth.php');
require_once('../includes/db.php');

$portfolio_id = $_GET['portfolio_id'];

$active_portfolio_query = "SELECT COUNT(*) AS active_count FROM portfolios WHERE portfolio_status = 2";
$active_count = mysqli_fetch_assoc(mysqli_query($db_connect, $active_portfolio_query));

if($_GET['btn'] == 'active'){
  if($active_count['active_count'] < 9) {
    $update_query = "UPDATE portfolios SET portfolio_status = 2 WHERE id = $portfolio_id";
  }
  else {
    $_SESSION['active_status'] = "You can't active more than 9 testimonial";
  }
}
else {
  $update_query = "UPDATE portfolios SET portfolio_status = 1 WHERE id = $portfolio_id";
}

mysqli_query($db_connect, $update_query);
header("location: portfolio_view.php");
?>