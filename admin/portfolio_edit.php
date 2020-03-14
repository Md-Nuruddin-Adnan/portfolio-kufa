<?php
require_once('AUTH/auth.php');
require_once('../includes/db.php');
$title = 'Portfolio Edit' ;
require_once('includes/dashboard_header.php');
require_once('includes/top_nav.php');
require_once('includes/sidebar.php');

$portfolio_id = $_GET['portfolio_id'];

$portfolio_select_query = "SELECT * FROM portfolios WHERE id = $portfolio_id";
$portfolio_db = mysqli_query($db_connect, $portfolio_select_query);
$portfolio_assoc = mysqli_fetch_assoc($portfolio_db);

?>

<div class="row">
  <div class="col-md-4 m-auto">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb justify-content-center">
        <li class="breadcrumb-item"><a href="portfolio_view.php">Portfolio</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?=$portfolio_assoc['portfolio_name']?></li>
      </ol>
    </nav>
  </div>
</div>

<form method="POST" action="portfolio_edit_post.php"  enctype="multipart/form-data">
<div class="row">
  <div class="col-md-4 offset-md-2 bg-white py-4 pl-4">
    <div class="form-group">
      <div>
        <img src="../uploads/images/portfolios/<?=$portfolio_assoc['portfolio_image']?>" alt="<?=$portfolio_assoc['portfolio_image']?>" class="img-fluid"> 
      </div>
    </div>
  </div>
  
  <div class="col-md-4 bg-white py-4 pr-4">
    <div class="border px-3">
      <h4 class="text-center pt-3">Portfolio Edit</h4>
        <div class="form-group">
          <label for="portfolio_category">Portfolio category</label>
          <input type="hidden" name="portfolio_id" value="<?=$portfolio_assoc['id']?>">
          <input type="text" class="form-control" name="portfolio_category" id="portfolio_category" value="<?=$portfolio_assoc['portfolio_category']?>">
        </div>
        <div class="form-group">
          <label for="portfolio_name">Portfolio name</label>
          <input type="text" class="form-control" name="portfolio_name" id="portfolio_name" value="<?=$portfolio_assoc['portfolio_name']?>">
        </div>
        <div class="form-group">
          <label for="portfolio_information">Portfolio information</label>
          <textarea class="form-control" name="portfolio_information" id="portfolio_information" rows="4"><?=$portfolio_assoc['portfolio_information']?></textarea>
        </div>
        <div class="form-group">
          <label for="portfolio_image">portfolio image</label>
          <input type="file" class="form-control" name="portfolio_image" id="portfolio_image">
        </div>
        <div class="form-group text-center">
          <button type="sumbit" class="btn btn-success">Update</button>
        </div>
      </div>
    </div>
  </div>
</form>

<?php
  require_once('includes/copyright.php');
  require_once('includes/dashboard_footer.php');
?>
