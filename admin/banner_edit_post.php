<?php
require_once('AUTH/auth.php');
require_once('../includes/db.php');

$my_name = htmlentities($_POST['my_name'], ENT_QUOTES);
$my_description = htmlentities($_POST['my_description'], ENT_QUOTES);

if(empty($my_name) || empty($my_description)){
  $_SESSION['banner_edit_error'] = "Can't update an empty value";
}
else {
  $update_query = "UPDATE banners SET my_name = '$my_name', my_description = '$my_description'";
  mysqli_query($db_connect, $update_query);
  $_SESSION['banner_edit_success'] = "Banner update successfully";
}

header('location: banner_view.php');

?>