<?php
  
  session_start();
  if (isset($_SESSION['userName'])) {
    header('location:Dashboard.php');
    exit();
  }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login | admin</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../js/font.1-web/css/all.min.css">
	<script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="../js/font.1-web/js/all.min.js"></script>
	<style type="text/css">
		html,body{
			height: 100%;
		}
	</style>
</head>




<body class="bg-dark">
  <div class="container h-100">
  	<div class="row h-100 align-items-center justify-content-center">
  		<div class="col-lg-5"> 
  			<div class="card border-success shadow-lg ">
  				<div class="card-header bg-success">
  					<h3 class="m-0 text-white"><i class="fas fa-user-cog"></i>&nbsp;Admin Login Panel
  					
  				</h3>
  				</div>
  				
  				<div class="card-body">
  					<form action="" method="post" class="px-3" id="adminLoginForm">
              <div id="adminLoginAlert"></div>
  						<div class="form-group">
  							<input type="text" name="userName" class="form-control form-control-lg rounded-0" placeholder="Username" required autofocus>
  						</div>
  						<div class="form-group">
  							<input type="password" name="password" class="form-control form-control-lg rounded-0" placeholder="Password" required >
  						</div>

  						<div class="form-group">
  							<input type="submit" name="adminLogin" class="btn btn-success btn-block btn-lg rounded-0" value="Login" id="loginBtn">
  						</div>
  					</form>
  				</div>
  			</div>
  		</div>
  	</div>
  </div>
  <script type="text/javascript">
  	$(document).ready(function(){

  		$("#loginBtn").click(function(e){
  			if ($("#adminLoginForm")[0].checkValidity()) {
  				e.preventDefault();

  				$(this).val('Please Wait...');

  				$.ajax({
  					url: 'assets/php/adminAction.php',
            method: 'post',
            data: $("#adminLoginForm").serialize()+'&action=adminLogin',
            success:function(response){
              if (response === 'adminLogin') {
                window.location = 'Dashboard.php';
              }
              else{
                $("#adminLoginAlert").html(response);
              }
              $("#loginBtn").val('Login');
            }
  				})
  			}
  		});
  	});
  </script>
</body>
</html>