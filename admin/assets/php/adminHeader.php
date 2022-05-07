<?php
  
  session_start();
  if (!isset($_SESSION['userName'])) {
    header('location:index.php');
    
  }
?>

<!DOCTYPE html>
<html>
<head>
	<?php 
      $title = basename($_SERVER['PHP_SELF'],'.php');
	 ?>
	<title><?= ucfirst($title); ?> | Admin panel</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../js/font.1-web/css/all.min.css">
	
	<link rel="stylesheet" type="text/css" href="../sweetAlert/sweetalert2.min.css">
  <script type="text/javascript" src="../sweetAlert/sweetalert2.all.min.js"></script>
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.js"></script>

	<script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="../js/font.1-web/js/all.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#openNav").click(function(){
				$(".admin-nav").toggleClass('animate');
			})
		})
	</script>
	<style type="text/css">
		.admin-nav{
			width: 220px;
			min-height: 100vh;
			overflow: hidden;
			background-color: #343a60;
			transition: 0.3s all ease-in-out;
		}
		.admin-link{
			background-color: #343a60;
		}
		.admin-link:hover, .nav-active{
			background-color: #212529;
			text-decoration: none;
		}
		.animate{
			width: 0;
			transition: 0.3s all ease-in-out;
		}
	</style>
</head>
<body>
   <div class="container-fluid">
   	<div class="row">
   		<div class="admin-nav p-0">
   			<h4 class="text-light text-center p-2">Admin Panel</h4>

   			<div class="list-group list-group-flush">
   				<a href="Dashboard.php" class="list-group-item text-light admin-link <?= (basename($_SERVER['PHP_SELF'])=='Dashboard.php')?"nav-active":"" ?>"><i class="fas fa-chart-pie"></i>&nbsp;&nbsp; Dashboard</a>

   				<a href="users.php" class="list-group-item text-light admin-link <?= (basename($_SERVER['PHP_SELF'])=='users.php')?"nav-active":"" ?>"><i class="fas fa-user-friends"></i>&nbsp;&nbsp; Users</a>

   				<a href="requests.php" class="list-group-item text-light admin-link <?= (basename($_SERVER['PHP_SELF'])=='requests.php')?"nav-active":"" ?>"><i class="fas fa-sticky-note"></i>&nbsp;&nbsp; Requests</a>

   				<a href="feedback.php" class="list-group-item text-light admin-link <?= (basename($_SERVER['PHP_SELF'])=='feedback.php')?"nav-active":"" ?>"><i class="fas fa-comment"></i>&nbsp;&nbsp; Feedback</a>

   				<a href="notification.php" class="list-group-item text-light admin-link <?= (basename($_SERVER['PHP_SELF'])=='notification.php')?"nav-active":"" ?>"><i class="fas fa-bell"></i>&nbsp;&nbsp; Notification&nbsp;<span id="checkNotification"></span></a>

   				<a href="deactivatedUser.php" class="list-group-item text-light admin-link <?= (basename($_SERVER['PHP_SELF'])=='deletedUser.php')?"nav-active":"" ?>"><i class="fas fa-user-slash"></i>&nbsp;&nbsp; Deactivated Users</a>

   				<!--a href="" class="list-group-item text-light admin-link"><i class="fas fa-table"></i>&nbsp;&nbsp; Export Users</a-->

   				<a href="#" class="list-group-item text-light admin-link "><i class="fas fa-id-card"></i>&nbsp;&nbsp;Profile</a>

   				<a href="#" class="list-group-item text-light admin-link "><i class="fas fa-cog"></i>&nbsp;&nbsp; Settings</a>
   			</div>
   		</div>
   		<div class="col">
   			<div class="row">
   				<div class="col-lg-12 bg-success pt-2 justify-content-between d-flex">
   					<a href="#" class="text-light" id="openNav"><h3><i class="fas fa-bars"></i></h3></a>

   					<h4 class="text-light"><?= $title ?></h4>

   					<a href="assets/php/logout.php" class="text-light mt-1"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a>
   				</div>
   			</div>