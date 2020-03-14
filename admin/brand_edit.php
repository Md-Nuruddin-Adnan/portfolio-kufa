<?php
require_once('AUTH/auth.php');
require_once('includes/role.php');
require_once('../includes/db.php');
$title = 'Brand Edit' ;
require_once('includes/dashboard_header.php');
require_once('includes/top_nav.php');
require_once('includes/sidebar.php');

$brand_id = $_GET['brand_id'];

$brand_select_query = "SELECT * FROM brands WHERE id = $brand_id";
$brand_db = mysqli_query($db_connect, $brand_select_query);
$brand_assoc = mysqli_fetch_assoc($brand_db);
?>

<div class="row">
  <div class="col-md-4 m-auto">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb justify-content-center">
        <li class="breadcrumb-item"><a href="brand_view.php">Brand</a></li>
        <li class="breadcrumb-item active" aria-current="page">Brand Edit</li>
      </ol>
    </nav>
  </div>
</div>

<form method="POST" action="brand_edit_post.php"  enctype="multipart/form-data">
<div class="row">
  <div class="col-xl-4 col-lg-8 bg-white p-4 m-auto">
    <div class="border px-3">
      <h4 class="text-center pt-3">Brand Edit</h4>
        <div class="form-group>
          <label for="brand_image">Brand Image</label>
          <div class="text-center py-3">
            <img src="../uploads/images/brands/<?=$brand_assoc['brand_image']?>" alt="<?=$brand_assoc['brand_image']?>" class="img-fluid">
          </div>
          <input type="hidden" name="brand_id" value="<?=$brand_assoc['id']?>">
          <input type="file" class="form-control my-2" name="brand_image" id="brand_image">
        </div>


        <div class="form-group text-center">
          <button type="sumbit" class="btn btn-success btn-block">Update</button>
        </div>
      </div>
    </div>
  </div>
</form>


<?php
  require_once('includes/copyright.php');
  require_once('includes/dashboard_footer.php');
?>