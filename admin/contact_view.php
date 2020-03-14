<?php
require_once('AUTH/auth.php');
require_once('../includes/db.php');
$title = 'Contact' ;
require_once('includes/dashboard_header.php');
require_once('includes/top_nav.php');
require_once('includes/sidebar.php');
$contact_select_query = "SELECT * FROM contacts";
$contact_information = mysqli_fetch_assoc(mysqli_query($db_connect, $contact_select_query));
?>

<style>
  .contact-content span {
    padding-right: 10px;
    font-weight: 700;
  }

  .contact-list li {
    list-style: none;
  }

  .contact-list ul li i {
    color: #8cc090;
    font-size: 14px;
    margin-right: 10px;
  }

  .table tr td {
    line-height: 1.4;
  }
</style>

<div class="card ">
  <div class="card-header text-center bg-white">
    <h2>Contact</h2>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-xl-6 col-lg-8 m-auto">
        <?php if(isset($_SESSION['contact_success'])):?>
          <div class="alert alert-success"><?=$_SESSION['contact_success']?></div>
        <?php endif; unset($_SESSION['contact_success']);?>
        <div class="section-title mb-20">
          <h3>Contact Information</h3>
        </div>
        <div class="contact-content">
          <p><?=$contact_information['contact_information']?></p>
          <h5> <span>OFFICE IN:</span> <?=$contact_information['office_location']?></h5>
          <div class="contact-list">
            <ul class="pl-0">
              <li><span><i class="fas fa-map-marker"></i>Address: </span> <?=$contact_information['address']?></li>
              <li><span><i class="fas fa-headphones"></i>Phone: </span>+880 <?=$contact_information['phone']?></li>
              <li><span><i class="fas fa-globe-asia"></i>e-mail: </span> <?=$contact_information['email']?></li>
            </ul>
          </div>
        </div>
        <a href="contact_edit.php?contact_id=<?=$contact_information['id']?>" class="btn btn-info">Edit</a>
      </div>
    </div>
  </div>
</div>


<!--=== Visitor List start ===-->
<div class="card mt-4">
  <div class="card-header bg-white text-center">
    <?php
    $visitor_count_query = "SELECT COUNT(*) AS total_visitor FROM visitors";
    $total_visitor_to_db = mysqli_query($db_connect, $visitor_count_query);
    ?>
    <h2>Visitor List (<?=mysqli_fetch_assoc($total_visitor_to_db)['total_visitor']?>)</h2>
  </div>
  <div class="card-body">
    <?php 
    $visitor_select_query = "SELECT * FROM visitors";
    $visitor_datas = mysqli_query($db_connect, $visitor_select_query);
    ?>
    <table class="table" id="visitor_table">
      <thead>
        <tr class="text-nowrap">
          <th>Sl. No</th>
          <th>Visitor Name</th>
          <th>Visitor Email</th>
          <th>Visitor Message</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $serial = 1;
          foreach($visitor_datas as $visitor):
        ?>
        <tr>
          <td><?=$serial++?></td>
          <td class="text-nowrap"><?=$visitor['visitor_name']?></td>
          <td class="text-nowrap"><?=$visitor['visitor_email']?></td>
          <td><?=$visitor['visitor_message']?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<!--===// Visitor List end ===-->


<?php
  require_once('includes/copyright.php');
  require_once('includes/dashboard_footer.php');
?>


<script>
  $(document).ready(function(){
    $('#visitor_table').DataTable({
      pageLength : 10,
      lengthMenu: [[10, 20, -1], [10, 20, 'All']]
    });
  })
</script>