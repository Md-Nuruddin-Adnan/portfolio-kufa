<?php
require_once('AUTH/auth.php');
require_once('../includes/db.php');
$title = 'Portfolio' ;
require_once('includes/dashboard_header.php');
require_once('includes/top_nav.php');
require_once('includes/sidebar.php');

$about_selet_query = "SELECT * FROM about";
$about_information = mysqli_fetch_assoc(mysqli_query($db_connect, $about_selet_query));
?>

<div class="row">
  <div class="col-md-4 m-auto">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb justify-content-center">
        <li class="breadcrumb-item"><a href="about_view.php">About</a></li>
        <li class="breadcrumb-item active" aria-current="page">About Edit</li>
      </ol>
    </nav>
  </div>
</div>

<h2 class="text-center">About Edit</h2>

<form action="about_edit_post.php" method="POST" enctype="multipart/form-data">
  <div class="row bg-white p-4">
    <div class="col-lg-4">
      <div class="about_image">
        <img src="../uploads/images/about/<?=$about_information['about_image']?>" alt="<?=$about_information['about_image']?>" class="img-fluid">
      </div>
    </div>
    <div class="col-lg-8 mt-5">
      <div class="about_inner">
        <div class="form-group">
          <input type="hidden" name="about_id" value="<?=$about_information['id']?>">
          <label for="about_image">About Image:</label>
          <input type="file" name="about_image" id="about_image" class="form-control">
        </div>
        <div class="form-group">
          <label for="about_description">About Description:</label>
          <textarea name="about_description" id="about_description" class="form-control" rows="4"><?=$about_information['about_description']?> </textarea>
        </div>
        <button type="submit" class="btn btn-info">Update</a>
      </div>
    </div>
  </div>
</form>

<?php
  require_once('includes/copyright.php');
  require_once('includes/dashboard_footer.php');
?>
