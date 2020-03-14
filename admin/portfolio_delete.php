<?php
require_once('../includes/db.php');
$portfolio_id = $_GET['portfolio_id'];

// old photo delete start
$photo_name_query = "SELECT portfolio_image FROM portfolios WHERE id = $portfolio_id";
$old_photo_name = mysqli_fetch_assoc(mysqli_query($db_connect, $photo_name_query))['portfolio_image'];
$old_photo_location = "../uploads/images/portfolios/$old_photo_name";
unlink($old_photo_location);
// end of old photo delete

// delete from database start
$portfolio_delete_query = "DELETE FROM portfolios WHERE id = $portfolio_id";
mysqli_query($db_connect, $portfolio_delete_query);

header('location: portfolio_view.php');
// delete from database end

?>