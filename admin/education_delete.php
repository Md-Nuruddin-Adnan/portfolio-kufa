<?php
require_once('../includes/db.php');

$id = $_GET['education_id'];
$delete_query = "DELETE FROM educations WHERE id = $id";
mysqli_query($db_connect, $delete_query);
header('location: about_view.php#education_section');
?>