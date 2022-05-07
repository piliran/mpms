<!DOCTYPE html>
<html>
<head>
	<style>
	
	</style>
	<title><?= ucfirst(basename($_SERVER['PHP_SELF'],'.php')); ?></title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../js/font.1-web/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="../js/font.1-web/js/all.min.js"></script>
</head>
<body>

<div class="title">

    <h1 style="text-align: center; float: left color:green; "><img src="logo.jpg" style="width:8%">MZUZU UNIVERSITY PROCUREMENT MANAGEMENT SYSTEM</h1>
</div>

  <!--   <nav class="navbar navbar-expand-md bg-success navbar-dark">
 
  <a class="navbar-brand" href="#"><i class="fas fa-code fa-lg"></i>&nbsp;&nbsp;MPMS</a>

  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

 
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav ml-auto">      
      <li class="nav-item">
        <button type="button" class="btn btn-success" id="login-btn" data-toggle="modal" data-target="#myModal"><h4>Log In</h4>
    
  </button>
      </li>
    </ul>
  </div>
</nav>  -->


<!-- The Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header ">
        <h4 class="modal-title text-center">Sign In</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        
	<div class="container fluid">
		<!--Login form starts here-->
	<div class="row justfy-content-center wrapper" id="login-box">
		<div class="col-lg-10 my-auto">
			<div class="card-group myShadow">
				<div class="card rounded-left p-4" style="flex-grow: 1.4">
					<!--h1 class="text-center font-weight-bold text-success">Sign In to account</h1>
					<hr class="my-3"-->
					<form action="#" method="POST" class="px-3" id="login-form">
						<div id="loginAlert"></div>
					 <div class="input-group input-group-lg form-group">
					 	<div class="input-group-prepend">
					 		<span class="input-group-text rounded-0" >
					 			<i class="far fa-envelope fa-lg"></i>
					 		</span>
					 	</div>
					 	 <input type="email" name="email" id="email" class="form-control rounded-0" placeholder="E-Mail" required value="<?php if(isset($_COOKIE['email'])) {echo $_COOKIE['email']; } ?>">
					 </div>
					 <div class="input-group input-group-lg form-group">
					 	<div class="input-group-prepend">
					 		<span class="input-group-text rounded-0" >
					 			<i class="fas fa-key fa-lg"></i>
					 		</span>
					 	</div>
					 	 <input type="password" name="password" id="password" class="form-control rounded-0" placeholder="Password" required value="<?php if(isset($_COOKIE['password'])) {echo $_COOKIE['password']; } ?>">
					 </div>
					 <div class="form-group">
					 	<div class="custom-control custom-checkbox float-left">
					 		<input type="checkbox" name="rem" class="custom-control-input" id="customCheck" <?php if(isset($_COOKIE['email'])) { ?>checked <?php } ?>>
					 		<label for="customCheck" class="custom-control-label">Remember Me
					 		</label>
					 	</div>
					 	<div class="forgot float-right">
					 		<a href="#" id="forgot-link">forgot password?</a>
					 	</div>
					 	<div class="clearfix"></div>
					 </div>
					 <div class="form-group">
					 	<input type="submit" value="Sign In" id="login-btn" class="btn btn-success btn-lg btn-block myBtn">
					 </div>
				 </form>
				</div>
				<!--div class="card justify-content-center rounded-right bg-secondary p-4" id="test">
					
					
					<button class="btn btn-outline btn-success align-self-center font-weght-bolder mt-4 mylinkBtn" id="register-link">Sign Up</button>
				</div-->
			</div>
		</div>
	</div>
	<!-- Login form end here-->

    <!-- Register form start here-->
     <!--div class="row justfy-content-center wrapper" id="register-box" style="display: none;">
		<div class="col-lg-10 my-auto">
			<div class="card-group myShadow">
					<div class="card justify-content-center rounded-left bg-secondary p-4" id="test">
					
					
					<button class="btn btn-outline btn-lg btn-success align-self-center font-weght-bolder mt-4 mylinkBtn" id="login-link">Sign In</button>
				</div>
				<div class="card rounded-right p-4" style="flex-grow: 1.4">
					
					<form action="#" method="POST" class="px-3" id="register-form">
						<div id="regAlert"></div>
						<div class="input-group input-group-lg form-group">
					 	<div class="input-group-prepend">
					 		<span class="input-group-text rounded-0" >
					 			<i class="far fa-user fa-lg"></i>
					 		</span>
					 	</div>
			    <select name="role"  id="role" class="form-control rounded-0" required onchange="checkRole()">
                <option selected value=''>select role</option>
                <option value="viceChancellor">vice chancellor</option>
                <option value="registrar">registrar</option>
                <option value="dean">dean</option>
                <option value="departmentalHead">departmental head</option>
                <option value="procurementOfficer">procurement officer</option>
                <option value="supplier">supplier</option>
                <option value="student">student</option>
                <option value="financeDirector">finance director</option>
            </select>
					 </div>

					 <div class="input-group input-group-lg form-group">
					 	<div class="input-group-prepend">
					 		<span class="input-group-text rounded-0" >
					 			<i class="far fa-user fa-lg"></i>
					 		</span>
					 	</div>
			    <select name="gender"  id="gender" class="form-control rounded-0" required>
                <option value='' selected>Select gender</option>
				<option value="Male">Male</option>
				<option value="Female">Female</option>
            </select>
					 </div>
						 <div class="input-group input-group-lg form-group">
					 	<div class="input-group-prepend">
					 		<span class="input-group-text rounded-0" >
					 			<i class="far fa-user fa-lg"></i>
					 		</span>
					 	</div>
					 	 <input type="text" name="name" id="name" class="form-control rounded-0" placeholder="Full Name" required>
					 </div>
					 <div class="input-group input-group-lg form-group">
					 	<div class="input-group-prepend">
					 		<span class="input-group-text rounded-0" >
					 			<i class="far fa-envelope fa-lg"></i>
					 		</span>
					 	</div>
					 	 <input type="email" name="email" id="remail" class="form-control rounded-0" placeholder="E-Mail" required>
					 </div>

					 <div class="input-group input-group-lg form-group">
					 	<div class="input-group-prepend">
					 		<span class="input-group-text rounded-0" >
					 			<i class="fas fa-phone fa-lg"></i>
					 		</span>
					 	</div>
					 	 <input type="tel" name="phone" id="phone" class="form-control rounded-0" placeholder="Phone" required>
					 </div>

					 <div class="input-group input-group-lg form-group" id="departmentDiv" style="display: none">
					 	<div class="input-group-prepend">
					 		<span class="input-group-text rounded-0" >
					 			<i class="fas fa-home fa-lg"></i>
					 		</span>
					 	</div>
					 	 <input type="text" name="department" id="department" class="form-control rounded-0" placeholder="Department">
					 </div>

                      
					 <div class="input-group input-group-lg form-group">
					 	<div class="input-group-prepend">
					 		<span class="input-group-text rounded-0" >
					 			<i class="fas fa-key fa-lg"></i>
					 		</span>
					 	</div>
					 	 <input type="password" name="password" id="rpassword" class="form-control rounded-0" placeholder="Password" required minlength="5">
					 </div>
					  <div class="input-group input-group-lg form-group">
					 	<div class="input-group-prepend">
					 		<span class="input-group-text rounded-0" >
					 			<i class="fas fa-key fa-lg"></i>
					 		</span>
					 	</div>
					 	 <input type="password" name="cpassword" id="cpassword" class="form-control rounded-0" placeholder="Confirm Password" required minlength="5">
					 </div>
					 <div class="form-group">
					 	<div id="passErr" class="text-danger font-weght-bold"></div>
					 </div>
					 
					 <div class="form-group">
					 	<input type="submit" value="Sign Up" id="register-btn" class="btn btn-success btn-lg btn-block myBtn">
					 </div>
				 </form>
				</div>

			</div>
		</div>
	</div-->
	<!-- Register form end here-->

	<!--forgot password form starts here-->
     <div class="row justfy-content-center wrapper" id="forgot-box" style="display: none;">
		<div class="col-lg-10 my-auto">
			<div class="card-group myShadow">
				<div class="card justify-content-center rounded-left myColor p-4" id="test">
					<!--h1 class="text-center font-weight-bold text-black">Reset password</h1>
					<hr class="my-3 bg-light myHr"-->
					
					<button class="btn btn-outline-dark btn-lg align-self-center font-weght-bolder mt-4 mylinkBtn" id="back-link">Back</button>
				</div>
				<div class="card rounded-right p-4" style="flex-grow: 1.4">
					<h1 class="text-center font-weight-bold text-success">Forgot your password</h1>
					<hr class="my-3">
					<p class="lead text-center text-secondary">To reset your password enter the registered E-mail address and we will send you the rest instructions on your E-mail</p>
					<form action="#" method="POST" class="px-3" id="forgot-form">
						<div id="forgotAlert"></div>
					 <div class="input-group input-group-lg form-group">
					 	<div class="input-group-prepend">
					 		<span class="input-group-text rounded-0" >
					 			<i class="far fa-envelope fa-lg"></i>
					 		</span>
					 	</div>
					 	 <input type="email" name="email" id="femail" class="form-control rounded-0" placeholder="E-Mail" required>
					 </div>
					
					 
					 <div class="form-group">
					 	<input type="submit" value="Reset Password" id="forgot-btn" class="btn btn-success btn-lg btn-block myBtn">
					 </div>
				 </form>
				</div>
				
			</div>
		</div>
	</div>
      </div>

      <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>

    </div>
  </div>
</div>





	<!--forgot password form ends here-->
</div>

<header>
    
    <img src="back.png" class="image">
    <iframe src="advert.php">Advert</iframe>

</header>


	

	<script type="text/javascript">
		function checkRole(){
			$("#role").val() === "student" || $("#role").val() === "departmentalHead"? $("#departmentDiv").show(): $("#departmentDiv").hide()
		}
	$(document).ready(function(){
	$("#register-link").click(function(){
       $("#login-box").hide();
       $("#register-box").show();
	});
	$("#login-link").click(function(){
       $("#register-box").hide();
       $("#login-box").show();
	});
	$("#forgot-link").click(function(){
       $("#login-box").hide();
       $("#forgot-box").show();
	});
	$("#back-link").click(function(){
       $("#forgot-box").hide();
       $("#login-box").show();
	});

	//register ajax request
	$("#register-btn").click(function(e){
        if($("#register-form")[0].checkValidity()){
        	e.preventDefault();
        	$("#register-btn").val("Please wait...");
        	if($("#rpassword").val() != $("#cpassword").val()){
        		$("#passErr").text("* Password did not match");
        		$("#register-btn").val("Sign Up");
        	}
        	else{
        		$("#passErr").text("");
        		$.ajax({
                  url: 'php/action.php',
                  method: 'post',
                  data: $("#register-form").serialize()+'&action=register',
                  success: function(response){
                  $("#register-btn").val("Sign Up");
                  var resp3=response.trim();

                 switch(resp3){
                   		case 'student':
                   		    window.location = 'student.php';
                   		    break;
                   		case 'dean':
                   		    window.location = 'dean.php';
                   		    break;
                   		
                   		case 'registrar':
                   		    window.location = 'registrar.php';
                   		    break;                   		 
                   		case 'supplier':
                   		    window.location = 'supplier.php';
                   		    break;
                   		case 'viceChancellor':
                        window.location = 'ViceChancellor.php';
                            break;
                       case 'departmentalHead':
                        window.location = 'headOfDepartment.php';
                            break;
                        case 'procurementOfficer':
                        window.location = 'procurementOfficer.php';
                            break;
                        case 'financeDirector':
                        window.location = 'DirectorOfFinance.php';
                            break;
                   		default:
                   		    $("#regAlert").html(response);
                       
                   	}
                  
                  }
        		});
        	}
        }
	});

//login ajax request
$("#login-form").on("submit",function(){
	var pass=$("#password").val();
	var email=$("#email").val();
	$.ajax({
  method:"post",
  data:{email:email,password:pass,action:"login"},
  url:"php/action.php",
  success:function(res){
  	var res2=res.trim();
  	
switch(res2){
                   		case 'student':
                   		    window.location = 'initiate.php';
                   		    break;
                   		case 'dean':
                   		    window.location = 'dean.php';
                   		    break;
                   		
                   		case 'registrar':
                   		    window.location = 'registrar.php';
                   		    break;                   		 
                   		case 'supplier':
                   		    window.location = 'supplier.php';
                   		    break;
                   		case 'viceChancellor':
                        window.location = 'ViceChancellor.php';
                            break;
                       case 'departmentalHead':
                        window.location = 'headOfDepartment.php';
                            break;
                        case 'procurementOfficer':
                        window.location = 'Dashboard.php';
                            break;
                        case 'financeDirector':
                        window.location = 'DirectorOfFinance.php';
                            break;
                   		default:
                   		    $("#loginAlert").html(res2);
                       
                   	}
  	
  }
	});
return false;
});

/*
	//login ajax request
	$("#login-btn").click(function(e){
        if ($("#login-form")[0].checkValidity()) {
        	e.preventDefault();

        	$("#login-btn").val('please wait...');
        	$.ajax({
                   url:'php/action.php',
                   method: 'post',
                   data: $("#login-form").serialize()+'&action=login',
                   success: function(response){
                   	$("#login-btn").val('Sign In');
                   	var resp3 = response.trim();
                     switch(resp3){
                   		case 'student':
                   		    window.location = 'student.php';
                   		    break;
                   		case 'dean':
                   		    window.location = 'dean.php';
                   		    break;
                   		
                   		case 'registrar':
                   		    window.location = 'registrar.php';
                   		    break;                   		 
                   		case 'supplier':
                   		    window.location = 'supplier.php';
                   		    break;
                   		case 'viceChancellor':
                        window.location = 'ViceChancellor.php';
                            break;
                       case 'departmentalHead':
                        window.location = 'headOfDepartment.php';
                            break;
                        case 'procurementOfficer':
                        window.location = 'procurementOfficer.php';
                            break;
                        case 'financeDirector':
                        window.location = 'DirectorOfFinance.php';
                            break;
                   		default:
                   		    $("#loginAlert").html(response);
                       
                   	}
     

                   }
        	});
        }
	});
	*/

	//forgot password ajax request
	$("#forgot-btn").click(function(e){
		if($("#forgot-form")[0].checkValidity()){
			e.preventDefault();

			$("#forgot-btn").val('Please wait..');

			$.ajax({
				url: 'php/action.php',
				method: 'post',
				data: $("#forgot-form").serialize()+'&action=forgot',
				success:function(response){
				$("#forgot-btn").val('reset password');
                 $("#forgot-form")[0].reset();
                 $("forgotAlert").html(response);
				}
			});
		}
	});
	
});


</script>

<?php
 require_once 'footer.php';
?>