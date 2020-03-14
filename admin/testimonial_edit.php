<?php
require_once('AUTH/auth.php');
require_once('includes/role.php');
require_once('../includes/db.php');
$title = 'Testimonial Edit' ;
require_once('includes/dashboard_header.php');
require_once('includes/top_nav.php');
require_once('includes/sidebar.php');

$customer_id = $_GET['customer_id'];

$testimonial_select_query = "SELECT * FROM testimonials WHERE id = $customer_id";
$testimonial_db = mysqli_query($db_connect, $testimonial_select_query);
$testimonial_assoc = mysqli_fetch_assoc($testimonial_db);
?>
<div class="row">
  <div class="col-md-4 m-auto">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb justify-content-center">
        <li class="breadcrumb-item"><a href="testimonial_view.php">Testimonial</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?=$testimonial_assoc['customer_name']?></li>
      </ol>
    </nav>
  </div>
</div>

<form method="POST" action="testimonial_edit_post.php"  enctype="multipart/form-data">
<div class="row">
  <div class="col-xl-4 col-lg-8 bg-white p-4 m-auto">
    <div class="border px-3">
      <h4 class="text-center pt-3">Testimonial Edit</h4>
        <div class="form-group">
          <label for="customer_name">Customer Name</label>
          <input type="hidden" name="customer_id" value="<?=$customer_id?>">
          <input type="text" class="form-control" name="customer_name" id="customer_name" value="<?=$testimonial_assoc['customer_name']?>">
        </div>
        <div class="form-group">
          <label for="customer_designation">Customer Designation</label>
          <input type="text" class="form-control" name="customer_designation" id="customer_designation" value="<?=$testimonial_assoc['customer_designation']?>">
        </div>
        <div class="form-group">
          <label for="customer_review">Customer Review</label>
          <textarea type="text" class="form-control" name="customer_review" rows="4" id="customer_review"><?=$testimonial_assoc['customer_review']?></textarea>
        </div>
          <div class="form-group">
            <label for="customer_image">Customer Image</label>
            <div class="text-center">
              <img src="../uploads/images/testimonials/<?=$testimonial_assoc['customer_image']?>" alt="<?=$testimonial_assoc['customer_image']?>" class="img-fluid">
            </div>
          <input type="file" class="form-control" name="customer_image" id="customer_image">
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