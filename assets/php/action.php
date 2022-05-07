<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

require_once 'auth.php';
$user = new Auth();

//Handle register ajax request
if(isset($_POST['action']) && $_POST['action'] =='register')

{ 
	$role = $user->test_input($_POST['role']);
	$name = $user->test_input($_POST['name']);
	$email = $user->test_input($_POST['email']);
	$pass = $user->test_input($_POST['password']);
	$department = $user->test_input($_POST['department']);
	$gender = $user->test_input($_POST['gender']);
	$phone = $user->test_input($_POST['phone']);



	

	if ($user->user_exist($email)) {
		echo $user->showMessage('warning','This E-mail is already registered!');
	}
	else{
		if ($user->register($role,$name,$email,$phone,$gender,$department,$pass)) {
			$loggedInUser = $user->login($email);
	      if ($loggedInUser != null) {
		     if ($pass === $loggedInUser['password']) {
		    	if (!empty($_POST['rem'])) {
		 		setcookie("email",$email, time()+(30*24*60*60),'/');
		 		setcookie("password",$pass, time()+(30*24*60*60),'/');
		 	}
            else{
            	setcookie("email","",1,'/');
            	setcookie("password","",1,'/');

            }
            echo $loggedInUser['role'];
            $_SESSION['user'] = $loggedInUser['email'];
		 }
		 else{
		 	echo $user->showMessage('danger','Password is incorrect');
		 }
	}
	else{
		echo $user->showMessage('danger','User not found!');
	}

		}
		else{
			echo $user->showMessage('danger','Something went wrong! try again later');
		}
	}

}

//Handle login ajax request
if (isset($_POST['action']) && $_POST['action'] == 'login')
{
	$email = $user->test_input($_POST['email']);
	$pass = $user->test_input($_POST['password']);

	$loggedInUser = $user->login($email);
	if ($loggedInUser != null) {
		 if ($pass === $loggedInUser['password']) {
		 	if (!empty($_POST['rem'])) {
		 		setcookie("email",$email, time()+(30*24*60*60),'/');
		 		setcookie("password",$pass, time()+(30*24*60*60),'/');
		 	}
            else{
            	setcookie("email","",1,'/');
            	setcookie("password","",1,'/');

            }

            echo $loggedInUser['role'];
            $_SESSION['user'] = $loggedInUser['email'];
		 }
		 else{
		 	echo $user->showMessage('danger','Password is incorrect');
		 }
	}
	else{
		echo $user->showMessage('danger','User not found!');
	}
}


//handle forgot password ajax request
if (isset($_POST['action']) && $_POST['action'] == 'forgot') {
	$email = $user->test_input($_POST['email']);
	$userFound = $user->currentUser($email);

	if ($userFound != null) {
		$token =uniqid();
		$token =str_shuffle($token);

		$user->forgot_password($token,$email);

		try {
			$mail->isSMTP();
			$mail->Host = 'smtp.gmail.com';
			$mail->SMTPPath = true;
			$mail->Username = Database::USERNAME;
			$mail->Password = Database::PASSWORD;
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
			$mail->Port = 587;

			$mail->setFrom(Database::USERNAME,'MPMS');
			$mail->addAddress($email);

			$mail->isHTML(true);
			$mail->subject = 'Reset password';
			$mail->Body = '<h3>click the below link to reset your password<br><a href="http://localhost/sec/resetPassword.php?email='.$email.'&token='.$token.'">href="http://localhost/sec/resetPassword.php?email='.$email.'&token='.$token.'</a><br>Regards<br>MPMS!</h3>';

			$mail->send();
			echo $user->showMessage('success','we have sent you the reset link in your E-mail ID, please check your E-mail');

			
		} catch (Exception $e) {
			echo $user->showMessage('danger','Something went wrong please try again  later!');
		}
	}
	else{
		echo $user->showMessage('info','This E-mail is not registered!');
	}

}

?>

