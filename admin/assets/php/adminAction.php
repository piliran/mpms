<?php
  
  require_once 'adminDb.php';
  $admin = new Admin();
  session_start();

  //handle admin login ajax request
  if (isset($_POST['action']) && $_POST['action'] == 'adminLogin') {
  	$userName = $admin->test_input($_POST['userName']);
  	$password = $admin->test_input($_POST['password']);

  	$hpassword = sha1($password);

  	$loggedInAdmin = $admin->adminLogin($userName,$hpassword);

  	if ($loggedInAdmin != null) {
  		echo "adminLogin";
  		$_SESSION['userName'] = $userName;
  	}
  	else{
  		echo $admin->showMessage('danger','Username or password is incorrect!');
  	}

  }

  //handle fetch all users ajax request
  if (isset($_POST['action']) && $_POST['action'] == 'fetchAllUsers') {
    $output = '';
    $data = $admin->fetchAllUsers(0);
    $path = '../assets/php/';

    if ($data) {
      $output .= '<table class="table table-striped table-bordered text-center">
                  <thead>
                  <tr>
                  <th>#</th>
                  <th>Image</th>
                  <th>Name</th>
                  <th>E-Mail</th>
                  <th>Phone</th>
                  <th>Gender</th>
                  <th>Department</th>
                  <th>Role</th>
                  <th>Verified</th>
                  <th>Action</th>
                  </tr>
                  </thead><tbody>';
                  foreach ($data as $row) {
                    if ($row['photo'] != '') {
                      $photo = $path.$row['photo'];
                    }
                    else{
                      $photo = '../assets/php/pja.png';
                    }
                    $output .='<tr>
                               <td>'.$row['id'].'</td>
                               <td><img src="'.$photo.'" class="rounded-circle" width="40px"></td>
                               <td>'.$row['name'].'</td>
                               <td>'.$row['email'].'</td>
                               <td>'.$row['phone'].'</td>
                               <td>'.$row['gender'].'</td>
                               <td>'.$row['department'].'</td>
                               <td>'.$row['role'].'</td>
                               <td>'.$row['verified'].'</td>
                               <td>
                               <a href="#" id="'.$row['id'].'" title="View Details" class="text-primary userDetailsIcon" data-toggle="modal" data-target="#showUserDetailModal"><i class="fas fa-info-circle fa-lg"></i></a>&nbsp;&nbsp;



                               <a href="#" id="'.$row['id'].'" title="Deactivate User" class="text-danger deleteUserIcon"><i class="fas fa-user-slash"></i></a>&nbsp;&nbsp;
                               </td>
                               </tr>';
                  }
                  $output .= '</tbody>
                              </table>';
                  
                  
                  echo $output;
    }
    else{
      echo '<h3 class="text-center text-secondary">No user registered!</h3>';
    }
  }

  //handle display user details ajax request
  if (isset($_POST['detailsId'])) {
    $id = $_POST['detailsId'];

    $data = $admin->fetchUserDetails($id);

   echo json_encode($data);
  }

  //handle delete a user ajax request
  if (isset($_POST['deleteId'])) {
    $id = $_POST['deleteId'];

    $admin->userAction($id,0);
  }

  //handle fetch all deleted users ajax request
  if (isset($_POST['action']) && $_POST['action'] == 'fetchAllDeletedUsers') {
    $output = '';
    $data = $admin->fetchAllUsers(1);
    $path = '../assets/php/';

    if ($data) {
      $output .= '<table class="table table-striped table-bordered text-center">
                  <thead>
                  <tr>
                  <th>#</th>
                  <th>Image</th>
                  <th>Name</th>
                  <th>E-Mail</th>
                  <th>Phone</th>
                  <th>Gender</th>
                  <th>Department</th>
                  <th>Role</th>
                  <th>Verified</th>
                  <th>Action</th>
                  </tr>
                  </thead><tbody>';
                  foreach ($data as $row) {
                    if ($row['photo'] != '') {
                      $photo = $path.$row['photo'];
                    }
                    else{
                      $photo = '../assets/php/pja.png';
                    }
                    $output .='<tr>
                               <td>'.$row['id'].'</td>
                               <td><img src="'.$photo.'" class="rounded-circle" width="40px"></td>
                               <td>'.$row['name'].'</td>
                               <td>'.$row['email'].'</td>
                               <td>'.$row['phone'].'</td>
                               <td>'.$row['gender'].'</td>
                               <td>'.$row['department'].'</td>
                               <td>'.$row['role'].'</td>
                               <td>'.$row['verified'].'</td>
                               <td>
                              

                               <a href="#" id="'.$row['id'].'" title="Restore User" class="text-white RestoreUserIcon badge badge-dark p-2">Activate</a>
                               </td>
                               </tr>';
                  }
                  $output .= '</tbody>
                              </table>';
                  
                  
                  echo $output;
    }
    else{
      echo '<h3 class="text-center text-secondary">No user deactivated!</h3>';
    }
  }

  //handle restore deleted user ajax request
  if (isset($_POST['RestoreId'])) {
      
       $id = $_POST['RestoreId'];
    
       $admin->userAction($id,1);
    }

    //handle fetch all requests
    if (isset($_POST['action']) && $_POST['action'] == 'fetchAllRequests') {
    $output = '';
    $requests = $admin->fetchAllRequests();
   

    if ($requests) {
      $output .= '<table class="table table-striped table-bordered text-center">
                  <thead>
                  <tr>
                  <th>#</th>
                  <th>User Name</th>
                  <th>E-Mail</th>
                  <th>Item Name</th>
                  <th>Item Quantity</th>
                  <th>Item Quality</th>
                  <th>Requested On</th>
                  <th>Action</th>
                  </tr>
                  </thead><tbody>';
                  foreach ($requests as $row) {
                   
                    $output .='<tr>
                               <td>'.$row['id'].'</td>
                               <td>'.$row['name'].'</td>
                               <td>'.$row['email'].'</td>
                               <td>'.$row['itemName'].'</td>
                               <td>'.$row['itemQuantity'].'</td>
                               <td>'.$row['itemQuality'].'</td>
                               <td>'.$row['createdAt'].'</td>

                               <td>
                               <a href="#" id="'.$row['id'].'" title="Delete Request" class="text-danger deleteRequestIcon"><i class="fas fa-trash-alt fa-lg"></i></a>
                    
                               </td>
                               </tr>';
                  }
                  $output .= '</tbody>
                              </table>';
                  
                  
                  echo $output;
    }
    else{
      echo '<h3 class="text-center text-secondary">No request available!</h3>';
    }
  }

  //handle delete request 
  if (isset($_POST['requestId'])) {
    $id = $_POST['requestId'];

    $admin->deleteRequest($id);
  }

   //handle fetch notification
  if (isset($_POST['action']) && $_POST['action'] == 'fetchNotification') {
    $notification = $admin->fetchNotification();
    $output = '';

    if ($notification) {
      foreach ($notification as $row) {
        $output .= '<div class="alert alert-secondary" role="alert">
          <button type="button" id="'.$row['id'].'" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="alert-heading">New Notification</h4>
          <p class="mb-0 lead">'.$row['message'].' by '.$row['name'].'</p>
          <hr class="my-2">
          <p class="mb-0 float-left"><b>User E-mail :</b>'.$row['email'].'</p>
          <p class="mb-0 float-right">'.$admin->timeInAgo($row['createdAt']).'</p>
          <div class="clearfix"></div>
        </div>';
      }
      echo $output;
    }
    else{
      echo '<h3 class="text-center text-secondary mt-5">No any new notification!</h3>';
    }
  }

   //check notification
  if (isset($_POST['action']) && $_POST['action'] == 'checkNotification') {
    if ($admin->fetchNotification()) {
      echo '<i class="fas fa-circle fa-sm text-danger"></i>';
    }
    else{
      echo "";
    }
  }

  if (isset($_POST['notificationID'])) {
    $id = $_POST['notificationID'];

    $admin->removeNotification($id);
  }

  //handle register user
  if(isset($_POST['action']) && $_POST['action'] =='register')

{ 

  $role = $admin->test_input($_POST['role']);
  $name = $admin->test_input($_POST['name']);
  $email = $admin->test_input($_POST['email']);
  $pass = $admin->test_input($_POST['password']);
  $department = $admin->test_input($_POST['department']);
  $gender = $admin->test_input($_POST['gender']);
  $phone = $admin->test_input($_POST['phone']);

  $hpass = $pass;//password_hash($pass, PASSWORD_DEFAULT);

  if ($admin->user_exist($email)) {
    echo $admin->showMessage('warning','This E-mail is already registered!');
  }
  else{
    if ($admin->register($role,$name,$email,$phone,$gender,$department,$hpass)) {
      echo "successful";

    }
    else{
      echo $admin->showMessage('danger','Something went wrong! try again later');
    }
  }

}

//handle get password ajax request
if (isset($_POST['action']) && $_POST['action'] == 'getPassword') {
  
  //$admin->generateRandomPassword(10,1,"lowerCase,upperCase,specialSymbols");
  $admin->getPassword();
}
?>