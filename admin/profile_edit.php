<?php
require_once('AUTH/auth.php');
require_once('../includes/db.php');
$title = 'Profile Edit' ;
require_once('includes/dashboard_header.php');
require_once('includes/top_nav.php');
require_once('includes/sidebar.php');
?>

<div class="row">
  <div class="col-md-6 col-sm-12 m-auto">
    <div class="card">
      <div class="card-header bg-white text-center">
        <h1>Edit Profile</h1>
      </div>
      <div class="card-body">
        <form action="profile_edit_post.php" method="POST">
          <div class="form-group">
            <label for="old_password">Old Password</label>
            <input type="password" id="old_password" class="form-control" name="old_password">
          </div>
          <div class="form-group">
            <label for="new_password">New Password</label>
            <input type="password" id="new_password" class="form-control" name="new_password">
          </div>
          <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" class="form-control" name="confirm_password">
          </div>
          
          <?php if(isset($_SESSION['password_error'])):?>
          <div class="alert alert-danger"><?=$_SESSION['password_error']?></div>
          <?php endif; unset($_SESSION['password_error']);?>

          <?php if(isset($_SESSION['password_update_success'])):?>
          <div class="alert alert-success"><?=$_SESSION['password_update_success']?></div>
          <?php endif; unset($_SESSION['password_update_success']);?>

          <div class="form-group text-center">
            <button class="btn btn-success">Save Change</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



<?php
  require_once('includes/copyright.php');
  require_once('includes/dashboard_footer.php');
?>