<?php
require_once('AUTH/auth.php');
require_once('../includes/db.php');
require_once('includes/role.php');
$title = 'Social Link Edit' ;
require_once('includes/dashboard_header.php');
require_once('includes/top_nav.php');
require_once('includes/sidebar.php');

$social_link_id = $_GET['social_link_id'];

$social_link_query = "SELECT * FROM social_links WHERE id = $social_link_id";
$social_link_information = mysqli_fetch_assoc(mysqli_query($db_connect, $social_link_query));


?>

<div class="row">
  <div class="col-md-4 m-auto">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="banner_view.php#social_link_section">Banner</a></li>
        <li class="breadcrumb-item active" aria-current="page">Social Link Edit</li>
      </ol>
    </nav>
  </div>
</div>

<div class="col-lg-4 m-auto bg-white">
  <div class="my-3 p-3 border">
    <div class="text-center">
      <h3>Social Link Edit</h3>
    </div>
    <form action="social_link_edit_post.php" method="POST">
      <div class="form-group">
        <label for="social_icon">Social Icon</label>
        <input type="hidden" name="social_link_id" value="<?=$social_link_id?>">
        <input type="text" name="social_icon" id="social_icon" class="form-control" value="<?=$social_link_information['social_icon']?>">
      </div>
      <div class="form-group">
        <label for="social_link">Social Link</label>
        <input type="text" name="social_link" id="social_link" class="form-control" value="<?=$social_link_information['social_link']?>">
      </div>
      <div class="form-group text-center">
        <button type="sumbit" class="btn btn-info">Add</button>
      </div>
    </form>
  </div>
</div>



<?php
  require_once('includes/copyright.php');
  require_once('includes/dashboard_footer.php');
?>