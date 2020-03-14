<?php
require_once('AUTH/auth.php');
require_once('../includes/db.php');
$title = 'logo' ;
require_once('includes/dashboard_header.php');
require_once('includes/top_nav.php');
require_once('includes/sidebar.php');
?>

<h2 class="text-center my-5">Logo</h2>

<div class="row">
  <!-- logo Dark start -->
  <div class="col-lg-4 col-md-6 mb-4 offset-lg-2 offset-md-0">
    <div class="dark-logo bg-white text-center p-lg-4 p-3 shadow">
      <div class="logo mb-3">
        <?php 
         $dark_logo_query = "SELECT * FROM logos WHERE logo_color = 'dark'";
         $dark_logo_name = mysqli_fetch_assoc(mysqli_query($db_connect, $dark_logo_query))['logo_image'];
        ?>
        <img src="../uploads/images/logo/<?=$dark_logo_name?>" alt="logo" class="img-fluid">
      </div>
      <?php if(isset($_SESSION['logo_dark_edit_success'])): ?>
        <div class="alert alert-success"><?=$_SESSION['logo_dark_edit_success']?></div>
      <?php endif; unset($_SESSION['logo_dark_edit_success'])?>

      <?php if(isset($_SESSION['logo_dark_edit_error'])): ?>
        <div class="alert alert-danger"><?=$_SESSION['logo_dark_edit_error']?></div>
      <?php endif; unset($_SESSION['logo_dark_edit_error'])?>
      <p>
        <button id="dl-btn" class="btn btn-info" type="button" data-toggle="collapse" data-target="#dark_logo_accordion" onclick="document.getElementById('dl-btn').style.display = 'none'">
          Edit
        </button>
      </p>
      <div class="collapse" id="dark_logo_accordion">
        <div class="card card-body">
          <form action="logo_dark_post.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <input type="file" name="logo_image" class="form-control">
            </div>
            <div class="form-group">
              <button class="btn btn-info">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- logo Dark end -->

  <!-- logo light start -->
  <div class="col-lg-4 col-md-6">
    <div class="light-logo bg-dark text-center p-lg-4 p-3 shadow">
      <div class="logo mb-3">
        <?php 
         $light_logo_query = "SELECT * FROM logos WHERE logo_color = 'light'";
         $light_logo_name = mysqli_fetch_assoc(mysqli_query($db_connect, $light_logo_query))['logo_image'];
        ?>
        <img src="../uploads/images/logo/<?=$light_logo_name?>" alt="logo" class="img-fluid">
      </div>
      <?php if(isset($_SESSION['logo_light_edit_success'])): ?>
        <div class="alert alert-success text-white"><?=$_SESSION['logo_light_edit_success']?></div>
      <?php endif; unset($_SESSION['logo_light_edit_success'])?>

      <?php if(isset($_SESSION['logo_light_edit_error'])): ?>
        <div class="alert alert-danger text-white"><?=$_SESSION['logo_light_edit_error']?></div>
      <?php endif; unset($_SESSION['logo_light_edit_error'])?>
      <p>
        <button id="ll-btn" class="btn btn-info" type="button" data-toggle="collapse" data-target="#light_logo_accordion" onclick="document.getElementById('ll-btn').style.display = 'none'">
          Edit
        </button>
      </p>
      <div class="collapse" id="light_logo_accordion">
        <div class="card card-body">
          <form action="logo_light_post.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <input type="file" name="logo_image" class="form-control">
            </div>
            <div class="form-group">
              <button class="btn btn-info">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- logo light end -->
</div>


<?php
  require_once('includes/copyright.php');
  require_once('includes/dashboard_footer.php');
  
?>