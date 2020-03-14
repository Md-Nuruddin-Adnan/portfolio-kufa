<?php
require_once('AUTH/auth.php');
require_once('../includes/db.php');
$title = 'Banner Edit' ;
require_once('includes/dashboard_header.php');
require_once('includes/top_nav.php');
require_once('includes/sidebar.php');

$banner_id = $_GET['banner_id'];
$banner_select_query = "SELECT * FROM banners";
$banner_data = mysqli_fetch_assoc(mysqli_query($db_connect, $banner_select_query));

?>

<div class="row">
  <div class="col-md-4 m-auto">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="banner_view.php">Banner</a></li>
        <li class="breadcrumb-item active" aria-current="page">Baner Edit</li>
      </ol>
    </nav>
  </div>
</div>
  
<h2 class="text-center">Banner Edit</h2>
 
<form action="banner_edit_post.php" method="POST">
  <div class="row mb-4 bg-white shadow-sm">
    <div class="col-lg-6 m-auto">
      <div class="p-4 ">
        <div class="form-group">
          <label for="my_name">My Name:</label>
          <input type="text" name="my_name" id="my_name" class="form-control" value="<?=$banner_data['my_name']?>">
        </div>
        <div class="form-group">
          <label for="my_description">My Description:</label>
          <textarea name="my_description" id="my_description" class="form-control" rows="4"> <?=$banner_data['my_description']?> </textarea>
        </div>
        <div class="form-group text-center">
         <button class="btn btn-info">Update</button>
        </div>
      </div>
    </div>
  </div>
</form>

<?php
  require_once('includes/copyright.php');
  require_once('includes/dashboard_footer.php');
  
?>