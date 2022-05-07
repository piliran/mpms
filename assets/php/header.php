<?php
require_once 'session.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title><?= ucfirst(basename($_SERVER['PHP_SELF'],'.php')); ?></title>
 
   

	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../js/font.1-web/css/all.min.css">

  
 
  <link rel="stylesheet" type="text/css" href="../sweetAlert/sweetalert2.min.css">
  <script type="text/javascript" src="../sweetAlert/sweetalert2.all.min.js"></script>
 
  <script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="../js/font.1-web/js/all.min.js"></script>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.js"></script>
</head>
<body>
 <nav class="navbar navbar-expand-md bg-success navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="#"><i class="fas fa-code fa-lg"></i>&nbsp;&nbsp;MPMS</a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == "initiate.php")? "active": ""; ?>" href="initiate.php"><i class="fas fa-plus-circle fa-lg"></i>&nbsp;Initiate</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == "profile.php")? "active": ""; ?>" href="profile.php"><i class="fas fa-user-circle fa-lg"></i>&nbsp;Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == "feedback.php")? "active": ""; ?>" href="feedback.php"><i class="fas fa-comment-dots fa-lg"></i>&nbsp;Feedback</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == "notification.php")? "active": ""; ?>" href="notification.php"><i class="fas fa-bell fa-lg"></i>&nbsp;Notification&nbsp;<span id="checkNotification"></span></a>
      </li>
     <!--  <li class="nav-item dropdown">
        <a class="nav-link" href="#" class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown"><i class="fas fa-user-cog fa-lg"></i>&nbsp;&nbsp;Hi! <?= $firstName; ?></a>
        <div class="dropdown-menu">
        	<a href="#" class="dropdown-item"><i class="fas fa-cog"></i>&nbsp;Settings</a>
        	<a href="php/logout.php" class="dropdown-item"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a>
        </div>
      </li> -->
      <li class="nav-item">
        <a href="php/logout.php" class="nav-link text-light mt-1"><i class="fas fa-sign-out-alt fa-lg"></i>&nbsp;Logout</a>
      </li>

    </ul>
  </div>
</nav> 


