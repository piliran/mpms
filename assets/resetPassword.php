<?php
   require_once 'php/auth.php';

   $user = new auth();
   $msg = ''; 
   if(isset($_GET['email']) && isset($_GET['token'])){
   $email = $user->test_input($_GET['email']);
   $token = $user->test_input($_GET['token']);

   $authUser = $user->reset_pass_auth($email,$token);

   if($authUser!=null){
     if(isset($_POST['submit'])){
     $newpass = $_POST['pass'];
     $cnewpass = $_POST['cpass'];

     $hnewpass = password_hash($newpass, PASSWORD_DEFALT);

     if($newpass == $cnewpass){
     $user->update_new_pass($hnewpass,$email);
     $message = 'Password changed successfully!<br><a href="index.php">Login Here!</a>';

 }
 else{
 $msg = 'password did not matched!';
}
 }
}
else{
	header('location:index.php');
	exit();
}

}
else{
	header('location:index.php');
	exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <style>
    .myColor{
      background-color: green: 
    }
  </style>
  <title><?= ucfirst(basename($_SERVER['PHP_SELF'],'.php')); ?></title>
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../js/font.1-web/css/all.min.css">
</head>
<body>
  <div class="container">
    <!--Login form starts here-->
  <div class="row justfy-content-center wrapper">
    <div class="col-lg-10 my-auto">
      <div class="card-group myShadow">
                <div class="card justify-content-center rounded-left myColor p-4" id="test">
          <h1 class="text-center font-weight-bold text-black">Reset your password here</h1>
          
        </div>

        <div class="card rounded-right p-4" style="flex-grow: 2">
          <h1 class="text-center font-weight-bold text-success">Enter new password</h1>
          <hr class="my-3">
          <form action="#" method="POST" class="px-3">
            <div class="text-center lead my-2"><? $msg; ?></div>
           
           <div class="input-group input-group-lg form-group">
            <div class="input-group-prepend">
              <span class="input-group-text rounded-0" >
                <i class="fas fa-key fa-lg"></i>
              </span>
            </div>
             <input type="password" name="pass" class="form-control rounded-0" placeholder="New Password" required minlength="5">
           </div>

           <div class="input-group input-group-lg form-group">
            <div class="input-group-prepend">
              <span class="input-group-text rounded-0" >
                <i class="fas fa-key fa-lg"></i>
              </span>
            </div>
             <input type="password" name="cpass" class="form-control rounded-0" placeholder="confirm New Password" required minlength="5">
           </div>
           
           <div class="form-group">
            <input type="submit" value="Reset passowrd" name="submit" class="btn btn-success btn-lg btn-block myBtn">
           </div>
         </form>
        </div>
        
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
  <script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="../js/font.1-web/js/all.min.js"></script>


</body>
</html>
