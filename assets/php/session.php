<?php
 session_start();
 require_once 'auth.php';
 $userObject = new Auth();



 if (!isset($_SESSION['user'])) {
 	header('location:../index.php');
 	die;
 }

 $userEmail = $_SESSION['user'];

 $data = $userObject->currentUser($userEmail);
 $userId = $data['id'];
 $fullName = $data['name'];
 $userRole = $data['role'];
 $userDepartment= $data['department'];
 $userPhoto = $data['photo'];
 $userPhone = $data['phone'];
 $userGender = $data['gender'];
 $userPassword =$data['password'];
 $date = $data['createdAt'];

 $firstName = strtok($fullName," ");
 $verified = $data['verified'];

 if ($verified == 0) {
 	$verified = 'Not verified';
 }
 else{
 	$verified = 'verified';
 }
?>