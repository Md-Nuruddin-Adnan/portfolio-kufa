<?php
  require_once('AUTH/auth.php');
  require_once('../includes/db.php');

  if(isset($_POST['service_submit'])){
    $section_name = htmlentities($_POST['service_name'], ENT_QUOTES);
    $top_heading = htmlentities($_POST['top_heading'], ENT_QUOTES);
    $main_heading = htmlentities($_POST['main_heading'], ENT_QUOTES);

    if(empty($top_heading) || empty($main_heading)){
      $_SESSION['heading_error'] = "Please fill the field properly";
      header('location: service_heading_edit.php');
    }
    else {
      $service_heading_update_query = "UPDATE sections_heading SET top_heading = '$top_heading', main_heading = '$main_heading' WHERE section_name = '$section_name'";
      mysqli_query($db_connect,  $service_heading_update_query);
      $_SESSION['heading_success'] = "Heading update successfully";
      header('location: services.php');
    }
  }

?>