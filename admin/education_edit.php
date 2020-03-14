<?php
require_once('AUTH/auth.php');
require_once('../includes/db.php');
$title = 'Education Edit' ;
require_once('includes/dashboard_header.php');
require_once('includes/top_nav.php');
require_once('includes/sidebar.php');

$id = $_GET['education_id'];

$education_select_query = "SELECT * FROM educations WHERE id = $id ";
$education = mysqli_fetch_assoc(mysqli_query($db_connect, $education_select_query));
?>


<div class="row">
  <div class="col-md-4 m-auto">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb justify-content-center">
        <li class="breadcrumb-item"><a href="about_view.php#education_section">Education</a></li>
        <li class="breadcrumb-item active" aria-current="page">Education Edit</li>
      </ol>
    </nav>
  </div>
</div>

<h2 class="text-center">Education Edit</h2>

<div class="row">
  <div class="col-lg-4 m-auto bg-white p-4">
    <form action="education_edit_post.php" method="POST" class="p-4 border">
      <div class="form-group">
        <label for="education_name">Education Name:</label>
        <input type="hidden" name="education_id" value="<?=$education['id']?>">
        <input name="education_name" id="education_name" type="text" class="form-control" value="<?=$education['education_name']?>">
      </div>
      <div class="form-group">
        <label for="passing_year">Passing Year:</label>
        <input name="passing_year" id="passing_year" type="number" class="form-control" value="<?=$education['passing_year']?>">
      </div>
      <div class="form-group flex-nowrap">
        <label for="progress">Progress:</label>
        <input name="progress" id="progress" type="number" class="form-control" value="<?=$education['progress']?>">
      </div>
      <div class="form-group text-center">
       <button type="submit" class="btn btn-info">Update</button>
      </div>
    </form>
  </div>
</div>


<?php
  require_once('includes/copyright.php');
  require_once('includes/dashboard_footer.php');
?>
