<?php
require_once('../includes/db.php');

$id = $_GET['social_link_id'];
$delete_query = "DELETE FROM social_links WHERE id = $id";
mysqli_query($db_connect, $delete_query);
header('location: banner_view.php#social_link_section');
?>