<?php 
   require_once 'php/session.php';
    if (!isset($_SESSION['user'])) {
   	header('location: index.php');
   }
   
 ?>

<!DOCTYPE html>
<html>
<head>
	<title><?= ucfirst(basename($_SERVER['PHP_SELF'],'.php')); ?></title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../js/font.1-web/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="../datatable/css/jquery.dataTables.min.css">

  <link rel="stylesheet" type="text/css" href="../sweetAlert/sweetalert2.min.css">
  <script type="text/javascript" src="../sweetAlert/sweetalert2.all.min.js"></script>
 <script type="text/javascript" src="../datatable/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="../datatable/js/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="../js/font.1-web/js/all.min.js"></script>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.js"></script>
</head>
<body>
 <nav class="navbar navbar-expand-md bg-success navbar-dark">
  <!-- Brand -->
   <a class="navbar-brand  <?= (basename($_SERVER['PHP_SELF']) == "supplier.php")? "active": ""; ?>" href="supplier.php"><i class="fas fa-home fa-lg"></i>&nbsp;Home</a>
  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav ml-auto">
      
      <li class="nav-item">
        <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == "supplierProfile.php")? "active": ""; ?>" href="supplierProfile.php"><i class="fas fa-user-circle fa-lg"></i>&nbsp;Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == "supplierFeedback.php")? "active": ""; ?>" href="supplierFeedback.php"><i class="fas fa-comment-dots fa-lg"></i>&nbsp;Feedback</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == "supplierNotification.php")? "active": ""; ?>" href="supplierNotification.php"><i class="fas fa-bell fa-lg"></i>&nbsp;Notification&nbsp;<span id="checkNotification"></span></a>
      </li>
      <li class="nav-item">
        <a href="php/logout.php" class="nav-link text-light mt-1"><i class="fas fa-sign-out-alt fa-lg"></i>&nbsp;Logout</a>
      </li>
    

    </ul>
  </div>
</nav> 

 <div class="container">
    <div class="row justify-content-center my-2">
      <div class="col-lg-6 mt-4" id="showAllNotification">
        
      </div>
    </div>
   </div>

<script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="../js/font.1-web/js/all.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){


    //fetch notification of a user
    fetchNotification();
    function fetchNotification(){
      $.ajax({
        url: 'php/process.php',
        method: 'post',
        data: {action : 'fetchSupplierNotification'},
        success:function(response){
          $("#showAllNotification").html(response);
        }
      })
    }

    //view resource request of a user ajax request
    $("body").on("click",".infoBtn",function(e){
      e.preventDefault();

      supplyInfoID= $(this).attr('id');

      $.ajax({
        url: 'php/process.php',
        method: 'post',
        data: {supplyInfoID:supplyInfoID},
        success:function(response){
          data = JSON.parse(response);
          swal.fire({
            // title: '<strong>Resources</strong>',
            type: 'info',
            html: '<b>Resource: </b>'+data.resourceName+'<br><br><b>Sent On: </b>'+data.dateSent,
            showCloseButton: true,
          })

        }
      });
    })

    //check supplier notification
    checkNotification();
    function checkNotification(){
      $.ajax({
        url: 'php/process.php',
        method: 'post',
        data: {action : 'checkSupplierNotification'},
        success:function(response){
          $("#checkNotification").html(response);
        }
      })
    }

    //remove notification
    $("body").on("click",".close", function(e){
      e.preventDefault();

      supplierNotificationId = $(this).attr('id');

      $.ajax({
        url: 'php/process.php',
        method: 'post',
        data: {supplierNotificationId : supplierNotificationId},
        success:function(response){
          checkNotification();
          fetchNotification();
        }
      })
    })
  })
</script>
</body>
</html>