<?php
  
  require_once 'session.php';
  require_once '../../fpdf/fpdf.php';
  
   $pdf = new FPDF('p','mm','A4');

 
  //handle add new request ajax request
if(isset($_POST['action']) && $_POST['action'] =='addrequest'){
	
  	$name = $userObject->test_input($_POST['itemName']);
  	$quantity = $userObject->test_input($_POST['itemQuantity']);
  	$quality = $userObject->test_input($_POST['itemQuality']);

  
  $userObject->add_new_request($userId, $name, $quantity, $quality);
  
    
  }

  //handle display all requests of a user
if(isset($_POST['action']) && $_POST['action'] =='displayRequests'){
$output = '';

$requests = $userObject->get_resource_requests($userId);
if ($requests) {
  $output .='<table class="table table-striped text-center">
          <thead>
            <tr>
              
              <th>Request</th>
              <th>Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>';
          foreach ($requests as $row) {
            $output .= '<tr>
              <td>'.$row['itemName'].'</td>
             <td>'.$row['createdAt'].'</td>
              <td>
                <a href="#" title="View Request" id="'.$row['id'].'" class="text-success infoBtn"><i class="fas fa-info-circle fa-lg" ></i></a>&nbsp;

                <a href="#" title="Edit Request" id="'.$row['id'].'" class="text-primary editBtn"><i class="fas fa-edit fa-lg" data-toggle="modal" data-target="#editRequestModal"></i></a>&nbsp;

                
              </td>
            </tr>';
          }
          $output .= '</tbody></table>';
          echo $output;
}
else{
  echo '<h3 class="text-center text-secondary">You have not yet sent any request!</h3>';
}

}

//handle edit resource request of a user ajax request
if(isset($_POST['editId'])){

  $id = $_POST['editId'];

  $row = $userObject->edit_resource_request($id);
  echo json_encode($row);
}

//handle update resource request of a user ajax request

if(isset($_POST['action']) && $_POST['action'] =='updateRequest'){
 
 $id = $userObject->test_input($_POST['id']);
 $name = $userObject->test_input($_POST['itemName']);
 $quantity = $userObject->test_input($_POST['itemQuantity']);
 $quality = $userObject->test_input($_POST['itemQuality']);

 $userObject->update_resource_request($id,$name,$quantity,$quality);

}

//handle delete resource request of a user
if (isset($_POST['deleteId'])) {

 $id =$_POST['deleteId'];

  $userObject->delete_resource_request($id);
 

}

//handle view resource request of a user
if (isset($_POST['infoId'])) {
   $id =$_POST['infoId'];
   
   $row = $userObject->viewRequest($id);
  echo json_encode($row);
}

//handle view supplied resource  of a supplier
if (isset($_POST['supplyInfoID'])) {
   $id =$_POST['supplyInfoID'];
   
   $row = $userObject->viewSuppliedResource($id);
  echo json_encode($row);
}

 //handle profile update ajax request
  if (isset($_FILES['image'])) {
$name = $userObject->test_input($_POST['name']);
  $department = $userObject->test_input($_POST['department']);
  $gender = $userObject->test_input($_POST['gender']);
  $phone = $userObject->test_input($_POST['phone']);

  $oldImage = $_POST['oldImage'];
  $folder = 'uploads/';

  if (isset($_FILES['image']['name']) && ($_FILES['image']['name'] != "")) {
    $newImage = $folder.$_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], $newImage);

    if ($oldImage != null) {
      unlink($oldImage);
    }
  }
  else{
    $newImage = $oldImage;
    }
    $userObject->update_profile($newImage,$name,$gender,$phone,$department,$userId);
    $userObject->notification($userId,'admin','Profile Updated');
  }

  //handle fetch notification
  if (isset($_POST['action']) && $_POST['action'] == 'fetchNotification') {
    $notification = $userObject->fetchNotification($userId);
    $output = '';

    if ($notification) {
      foreach ($notification as $row) {
        $output .= '<div class="alert alert-success" role="alert">
          <button type="button" id="'.$row['id'].'" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="alert-heading">Notification</h4>
          <p class="mb-0 lead">'.$row['message'].'</p>
           <a href="#" id="'.$row['requestID'].'" class="badge badge-primary infoBtn" >View Request</a>&nbsp;
          <hr class="my-2">
          <p class="mb-0 float-left">Reply from '.$row['type'].'</p>
          <p class="mb-0 float-right">'.$userObject->timeInAgo($row['createdAt']).'</p>
          <div class="clearfix"></div>
        </div>';
      }
      echo $output;
    }
    else{
      echo '<h3 class="text-center text-secondary mt-5">No any new notification!</h3>';
    }
  }

  //handle fetch supplier notification
  if (isset($_POST['action']) && $_POST['action'] == 'fetchSupplierNotification') {
    $notification = $userObject->fetchSupplierNotification($userId);
    $output = '';

    if ($notification) {
      foreach ($notification as $row) {
        $output .= '<div class="alert alert-success" role="alert">
          <button type="button" id="'.$row['id'].'" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="alert-heading">Notification</h4>
          <p class="mb-0 lead">'.$row['message'].'</p>
           <a href="#" id="'.$row['resourceID'].'" class="badge badge-primary infoBtn" >View Resources</a>&nbsp;
          <hr class="my-2">
          <p class="mb-0 float-left">Reply from '.$row['type'].'</p>
          <p class="mb-0 float-right">'.$userObject->timeInAgo($row['createdAt']).'</p>
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
  if (isset($_POST['action']) && $_POST['action'] == 'checkSupplierNotification') {
    if ($userObject->checkSupplierNotification($userId)) {
      echo '<i class="fas fa-circle fa-sm text-danger"></i>';
    }
    else{
      echo "";
    }
  }

  //check notification
  if (isset($_POST['action']) && $_POST['action'] == 'checkNotification') {
    if ($userObject->fetchNotification($userId)) {
      echo '<i class="fas fa-circle fa-sm text-danger"></i>';
    }
    else{
      echo "";
    }
  }

   

  //remove notification
  if (isset($_POST['notificationId'])) {
    $id=$_POST['notificationId'];
    $userObject->removeNotification($id);
  }

  //remove supplier notification
  if (isset($_POST['supplierNotificationId'])) {
    $id=$_POST['supplierNotificationId'];
    $userObject->removeSupplierNotification($id);
  }

  //handle fetch all departmental requests
     if (isset($_POST['department'])) {
    
    $output = '';
     $department =  $userObject->test_input($_POST['department']);
    $requests = $userObject->fetchAllDepartmentalRequests($department);
   

    if ($requests) {
      $output .= '<table class="table table-striped table-bordered text-center">
                  <thead>
                  <tr>
                  
                  <th>Initiator</th>
                  <th>E-Mail</th>
                  <th>Department</th>
                  <th>Request</th>
                  
                  <th>Requested On</th>
                  <th>Action</th>
                  </tr>
                  </thead><tbody>';
                  foreach ($requests as $row) {
                   
                    $output .='<tr>
                               
                               <td>'.$row['name'].'</td>
                               <td>'.$row['email'].'</td>
                                <td>'.$row['department'].'</td>
                               <td>'.$row['itemName'].'</td>
                               
                               <td>'.$row['createdAt'].'</td>

                               <td>
                               
                               <a href="#" id="'.$row['id'].'" class="btn btn-danger HODcommentRequestIcon" data-toggle="modal" data-target="#commentRequestModal">Reject</a>&nbsp;

                               <a href="#" id="'.$row['id'].'" title="Approve" class="btn btn-success ApproveRequestIcon">Approve</a>
                    
                               </td>
                               </tr>';
                  }
                  $output .= '</tbody>
                              </table>';
                  
                  
                  echo $output;
    }
    else{
      echo '<h3 class="text-center text-secondary">No New request available!</h3>';
    }
  }

  //handle request departmental approval ajax request
  if (isset($_POST['action']) && $_POST['action']=='departmentalApproval'){
    $approvedId = $_POST['approvedId'];
     $name = $_POST['name'];
     $role = $_POST['role'];

     

    echo $userObject->departmentalApproval($approvedId,$name, $role);
  }

 //handle requests intended for the dean ajax request
  if(isset($_POST['action']) && $_POST['action'] =='fetchDeanIntendedRequests') {
    
    $output = '';
    $requests = $userObject->fetchDeanIntendedRequests();
   

    if ($requests) {
      $output .= '<table class="table table-striped table-bordered text-center">
                  <thead>
                  <tr>
                  
                  <th>Initiator</th>
                  <th>E-Mail</th>
                  <th>Department</th>
                  <th>Request</th>
                  
                  <th>Requested On</th>
                   <th>Signed By</th>
                  <th>Action</th>
                  </tr>
                  </thead><tbody>';
                  foreach ($requests as $row) {
                   
                    $output .='<tr>
                               
                               <td>'.$row['name'].'</td>
                               <td>'.$row['email'].'</td>
                                <td>'.$row['department'].'</td>
                               <td>'.$row['itemName'].'</td>
                               
                               <td>'.$row['createdAt'].'</td>
                               <td>'.$row['hod_commentBy'].'(HOD)</td>

                               <td>

                                <a href="#" id="'.$row['id'].'" class="btn btn-danger DeanCommentRequestIcon" data-toggle="modal" data-target="#commentRequestModal">Reject</a>&nbsp;

                                <a href="#" id="'.$row['id'].'" class="btn btn-success ApproveRequestIcon">Approve</a>
                    
                               </td>
                               </tr>';
                  }
                  $output .= '</tbody>
                              </table>';
                  
                  
                  echo $output;
    }
    else{
      echo '<h3 class="text-center text-secondary">No new request available!</h3>';
    }
  }

   //handle request dean approval ajax request
  if (isset($_POST['action']) && $_POST['action'] == 'deanApproveRequest'){
    $deanApprovedId = $_POST['deanApprovedId'];
    $name = $_POST['name'];
     $role = $_POST['role'];
    $userObject->deanApproval($deanApprovedId,$name,$role);
  }
  
  //handle get user ID for comment
  if(isset($_POST['userId'])){

  $id = $_POST['userId'];

  $row = $userObject->getUserId($id);
  echo json_encode($row);
}

 //handle get supplier user ID
  if(isset($_POST['supplierId'])){
   

  $id =  $userObject->test_input($_POST['supplierId']);

  $row = $userObject->getSupplierUserID($id);
  echo json_encode($row);
}

//handle HOD comment request ajax request
if(isset($_POST['action']) && $_POST['action'] =='commentRequest') {
  $id = $userObject->test_input($_POST['id']);
  $uid = $userObject->test_input($_POST['uid']);
  $title = $userObject->test_input($_POST['title']);
  $message = $userObject->test_input($_POST['message']);
   $role = $userObject->test_input($_POST['role']);
    $name = $_POST['fullName'];

    $userObject->notification($uid,$role,$message,$id);
  $userObject->HODcommentRequest($id,$uid,$title,$message, $name);
}

//handle dean comment request ajax request
if(isset($_POST['action']) && $_POST['action'] =='DeanCommentRequest') {
  $id = $userObject->test_input($_POST['id']);
  $uid = $userObject->test_input($_POST['uid']);
  $title = $userObject->test_input($_POST['title']);
  $message = $userObject->test_input($_POST['message']);
  $role = $userObject->test_input($_POST['role']);

    $userObject->notification($uid,$role,$message,$id);
  $userObject->DeanCommentRequest($id,$uid,$title,$message);
}

//display all feedback of a user
if(isset($_POST['action']) && $_POST['action'] =='displayAllFeedback'){
$output = '';

$feedback = $userObject->getFeedback($userId);
if ($feedback) {
  $output .='<table class="table table-striped text-center">
          <thead>
            <tr>
              
              <th>Title</th>
              <th>Body</th>
              <th>Action</th>
              
            </tr>
          </thead>
          <tbody>';
          foreach ($feedback as $row) {
            $output .= '<tr>
              <td>'.$row['title'].'</td>
              <td>'.$row['message'].'</td>

              <td>
              <a href="#" id="'.$row['id'].'" title="Delete feedback" class="text-danger deleteFeedbackIcon"><i class="fas fa-trash-alt fa-lg"></i></a>&nbsp;&nbsp;
              </td>
              
                </tr>';
          }
          $output .= '</tbody></table>';
          echo $output;
}
else{
  echo '<h3 class="text-center text-secondary">No feedback available!</h3>';
}

}

//delete feedback of a user
  if (isset($_POST['deleteFeedbackId'])) {
    $id=$_POST['deleteFeedbackId'];
    $userObject->deleteFeedback($id);
  }

  //Handle insert budget ajax request
if(isset($_POST['action']) && $_POST['action'] =='insertBudget')

{ 
  $budget = $userObject->test_input($_POST['budget']);
  $department = $userObject->test_input($_POST['department']);

  $userObject->insertBudget($budget,$department);
}
 
 //handle check balance ajax request
  if (isset($_POST['departmentBalance'])) {
    
    $department = $userObject->test_input($_POST['departmentBalance']);
     $result = $userObject->checkBalance($department);
     echo json_encode($result);
  }

  //handle requests intended for the registrar ajax request
  if(isset($_POST['action']) && $_POST['action'] =='fetchRegistrarIntendedRequests') {
    
    $output = '';
    $requests = $userObject->fetchRegistrarIntendedRequests();
   

    if ($requests) {
      $output .= '<table class="table table-striped table-bordered text-center">
                  <thead>
                  <tr>
                  
                  <th>Initiator</th>
                  <th>E-Mail</th>
                  <th>Department</th>
                  <th>Request</th>
                  
                  <th>Requested On</th>
                  <th>Sign By</th>
                  <th>Action</th>
                  </tr>
                  </thead><tbody>';
                  foreach ($requests as $row) {
                   
                    $output .='<tr>
                               
                               <td>'.$row['name'].'</td>
                               <td>'.$row['email'].'</td>
                                <td>'.$row['department'].'</td>
                               <td>'.$row['itemName'].'</td>
                              
                               <td>'.$row['createdAt'].'</td>
                                <td>'.$row['hod_commentBy'].'(HOD),'.$row['dean_commentBy'].'(Dean)</td>

                               <td>
                               
                                <a href="#" id="'.$row['id'].'" class="btn btn-danger RegistrarCommentRequestIcon" data-toggle="modal" data-target="#commentRequestModal">Reject</a>&nbsp;

                               <a href="#" id="'.$row['id'].'" class="btn btn-success ApproveRequestIcon">Approve</a>
                    
                               </td>
                               </tr>';
                  }
                  $output .= '</tbody>
                              </table>';
                  
                  
                  echo $output;
    }
    else{
      echo '<h3 class="text-center text-secondary">No new request available!</h3>';
    }
  }

  //handle request registrar approval ajax request
  if (isset($_POST['action']) && $_POST['action'] == 'registrarApproveRequest'){
    $registrarApprovedId = $_POST['registrarApprovedId'];
     $name=$_POST['name'];
      $role=$_POST['role'];
    $userObject->registrarApproval($registrarApprovedId,$name,$role);
  }

  //handle registrar comment request ajax request
if(isset($_POST['action']) && $_POST['action'] =='registrarCommentRequest') {
  $id = $userObject->test_input($_POST['id']);
  $uid = $userObject->test_input($_POST['uid']);
  $title = $userObject->test_input($_POST['title']);
  $message = $userObject->test_input($_POST['message']);
  $role = $userObject->test_input($_POST['role']);
  $name = $_POST['fullName'];
     $userObject->notification($uid,$role,$message,$id);
  $userObject->registrarCommentRequest($id,$uid,$title,$message,$name);
}

//handle requests intended for the Vice chancellor ajax request
  if(isset($_POST['action']) && $_POST['action'] =='fetchViceChancellorIntendedRequests') {
    
    $output = '';
    $requests = $userObject->fetchViceChancellorIntendedRequests();
   

    if ($requests) {
      $output .= '<table class="table table-striped table-bordered text-center">
                  <thead>
                  <tr>
                  
                  <th>Initiator</th>
                  <th>E-Mail</th>
                  <th>Department</th>
                  <th>Request</th>
                  
                  <th>Requested On</th>
                 <th>Signed By</th>
                  <th>Action</th>
                  </tr>
                  </thead><tbody>';
                  foreach ($requests as $row) {
                   
                    $output .='<tr>
                               
                               <td>'.$row['name'].'</td>
                               <td>'.$row['email'].'</td>
                                <td>'.$row['department'].'</td>
                               <td>'.$row['itemName'].'</td>
                              
                               <td>'.$row['createdAt'].'</td>
                               <td>'.$row['hod_commentBy'].'(HOD), '.$row['dean_commentBy'].'(Dean), '.$row['registrar_commentBy'].'(Registrar)</td>

                               <td>
                               
                               <a href="#" id="'.$row['id'].'" class="btn btn-danger viceChancellorCommentRequestIcon" data-toggle="modal" data-target="#commentRequestModal">Reject</a>&nbsp;

                               <a href="#" id="'.$row['id'].'" class="btn btn-success ApproveRequestIcon">Approve</a>
                    
                               </td>
                               </tr>';
                  }
                  $output .= '</tbody>
                              </table>';
                  
                  
                  echo $output;
    }
    else{
      echo '<h3 class="text-center text-secondary">No new request available!</h3>';
    }
  }

  //handle request vice chancellor approval ajax request
  if (isset($_POST['action'])&& $_POST['action'] =='viceChancellorApproveRequest'){
    $viceChancelorApprovedId = $_POST['viceChancelorApprovedId'];
    $name = $_POST['name'];
    $role = $_POST['role'];
    $userObject->viceChancelorApproval($viceChancelorApprovedId,$name,$role);
  }

   //handle request procurement officer approval ajax request
 if(isset($_POST['action']) && $_POST['action'] =='procurementApproval') {
    $procureApprovedId = $_POST['procureApprovedId'];
    $name=$_POST['name'];
    $role=$_POST['role'];
    $userObject->procurementOfficerApproval($procureApprovedId,$name,$role);
  }

  //handle vice chancellor comment request ajax request
if(isset($_POST['action']) && $_POST['action'] =='viceChancellorCommentRequest') {
  $id = $userObject->test_input($_POST['id']);
  $uid = $userObject->test_input($_POST['uid']);
  $title = $userObject->test_input($_POST['title']);
  $message = $userObject->test_input($_POST['message']);
  $role = $userObject->test_input($_POST['role']);
  $name=$_POST['fullName'];

    $userObject->notification($uid,$role,$message,$id);
  $userObject->viceChancellorCommentRequest($id,$uid,$title,$message,$name);
}

//handle requests intended for the procurement officer ajax request
  if(isset($_POST['action']) && $_POST['action'] =='fetchProcurementOfficerIntendedRequests') {
    
    $output = '';
    $requests = $userObject->fetchProcurementOfficerIntendedRequests();
   

    if ($requests) {
      $output .= '<table class="table table-striped table-bordered text-center">
                  <thead>
                  <tr>
                  
                  <th>Initiator</th>
                  <th>E-Mail</th>
                  <th>Department</th>
                  <th>Phone Number</th>
                  <th>Request</th>
                  
                  <th>Requested On</th>
                  <th>Signed By</th>
                  <th>Action</th>
                  </tr>
                  </thead><tbody>';
                  foreach ($requests as $row) {
                   
                    $output .='<tr>
                               
                               <td>'.$row['name'].'</td>
                               <td>'.$row['email'].'</td>
                                <td>'.$row['department'].'</td>
                                 <td>'.$row['phone'].'</td>
                               <td>'.$row['itemName'].'</td>
                              
                               <td>'.$row['createdAt'].'</td>
                               <td>'.$row['hod_commentBy'].'(HOD), '.$row['dean_commentBy'].'(Dean), '.$row['registrar_commentBy'].'(Registrar), '.$row['viceChancellor_commentBy'].'(VC)</td>
                               

                               <td>
                               
                                <a href="#" id="'.$row['id'].'" class="btn btn-danger viceChancellorCommentRequestIcon" data-toggle="modal" data-target="#commentRequestModal">Reject</a>&nbsp;

                               <a href="#" id="'.$row['id'].'" class="btn btn-success ApproveRequestIcon">Recommend</a>
                    
                               </td>
                               </tr>';
                  }
                  $output .= '</tbody>
                              </table>';
                  
                  
                  echo $output;
    }
    else{
      echo '<h3 class="text-center text-secondary">No new request available!</h3>';
    }
  }

   //handle add new resource ajax request
if(isset($_POST['action']) && $_POST['action'] =='addResource'){
  
    $name = $userObject->test_input($_POST['itemName']);
    $quantity = $userObject->test_input($_POST['itemQuantity']);
   $quality = $userObject->test_input($_POST['itemQuality']);

    $cost = $userObject->test_input($_POST['itemCost']);
     $department = $userObject->test_input($_POST['department']);
  print_r($department);
  $userObject->addNewResource($userId, $name, $quantity,$quality, $cost,$department);
  
    
  }

   //handle display all resources of a supplier
if(isset($_POST['action']) && $_POST['action'] =='displayResource'){
$output = '';

$resources = $userObject->displayResource($userId);
if ($resources) {
  $output .='<table class="table table-striped text-center">
          <thead>
            <tr>
              
              <th>Reources</th>
             
              <th>Cost</th>
               <th>Date sent</th>
              
            </tr>
          </thead>
          <tbody>';
          foreach ($resources as $row) {
            $output .= '<tr>
              <td>'.$row['resourceName'].'</td>
             
              <td>'.$row['resourceCost'].'</td>
              <td>'.$row['dateSent'].'</td>
              
            </tr>';
          }
          $output .= '</tbody></table>';
          echo $output;
}
else{
  echo '<h3 class="text-center text-secondary">You have not yet sent any resource!</h3>';
}

}

//handle delete resource supply of a user
if (isset($_POST['deleteResourceId'])) {

 $id =$_POST['deleteResourceId'];

  $userObject->deleteResourceSupply($id);
  

}

//handle fetch all resources from supliers ajax request
  if(isset($_POST['action']) && $_POST['action'] =='fetchAllResources') {
    
    $output = '';
    $requests = $userObject->fetchAllResources();
   

    if ($requests) {
      $output .= '<table class="table table-striped table-bordered text-center">
                  <thead>
                  <tr>
                  
                  <th>Supplier Name</th>
                  <th>E-Mail</th>
                  <th>Phone Number</th>
                  <th>Resource</th>
                 
                  <th> Cost</th>
                  <th>Sent On</th>
                 
                  <th>Action</th>
                  </tr>
                  </thead><tbody>';
                  foreach ($requests as $row) {
                   
                    $output .='<tr>
                               
                               <td>'.$row['name'].'</td>
                               <td>'.$row['email'].'</td>
                               <td>'.$row['phone'].'</td>
                               <td>'.$row['resourceName'].'</td>
                              
                               <td>'.$row['resourceCost'].'</td>
                               <td>'.$row['dateSent'].'</td>
                               

                               <td>
                               
                                <a href="#" id="'.$row['id'].'" class="btn btn-danger procureRejectIcon" data-toggle="modal" data-target="#rejectResourceModal">Reject</a>&nbsp;

                               <a href="#" id="'.$row['id'].'" class="btn btn-success contactSupplierIcon" data-toggle="modal" data-target="#contactSupplierModal">Contact</a>
                    
                               </td>
                               </tr>';
                  }
                  $output .= '</tbody>
                              </table>';
                  
                  
                  echo $output;
    }
    else{
      echo '<h3 class="text-center text-secondary">No resource available!</h3>';
    }
  }

  //handle fetch all Suppliers ajax request
  if (isset($_POST['action']) && $_POST['action'] == 'fetchAllSuppliers') {
    
    $output = '';
    $data = $userObject->fetchAllSuppliers(0);
    $path = '../assets/php/';

    if ($data) {
      $output .= '<table class="table table-striped table-bordered text-center">
                  <thead>
                  <tr>
                  
                  <th>Image</th>
                  <th>Name</th>
                  <th>E-Mail</th>
                  <th>Phone</th>
                  <th>Gender</th>
                 
                 
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
                               
                               <td><img src="'.$photo.'" class="rounded-circle" width="40px"></td>
                               <td>'.$row['name'].'</td>
                               <td>'.$row['email'].'</td>
                               <td>'.$row['phone'].'</td>
                               <td>'.$row['gender'].'</td>
                               
                               
                               <td>'.$row['verified'].'</td>
                               <td>
                               <a href="#" id="'.$row['id'].'" title="View Details" class="text-primary userDetailsIcon" data-toggle="modal" data-target="#showUserDetailModal"><i class="fas fa-info-circle fa-lg"></i></a>&nbsp;&nbsp;



                               <a href="#" id="'.$row['id'].'" title="Delete User" class="text-danger deleteUserIcon"><i class="fas fa-trash-alt fa-lg"></i></a>&nbsp;&nbsp;
                               </td>
                               </tr>';
                  }
                  $output .= '</tbody>
                              </table>';
                  
                  
                  echo $output;
    }
    else{
      echo '<h3 class="text-center text-secondary">No Supplier available!</h3>';
    }
  }
 
 // handle notify supplier ajax request
 if (isset($_POST['action']) && $_POST['action'] == 'contactSupplier') {
  $id=$_POST['supplierId'];
  
     
 $data = $userObject->getSupplierID($id);
  echo json_encode($data);
 }
  
  //handle fetch receipt data
   if (isset($_POST['action']) && $_POST['action'] == 'fetchReport') {
   $output = '';
   $data = $userObject->fetchReport();

   if ($data) {
      $output .= '<table class="table table-striped table-bordered text-center">
                  <thead>
                  <tr>
                  
                  <th>Supplier Name</th>
                  <th>E-Mail</th>
                  <th>Phone Number</th>
                  <th>Resources</th>
                  
                  <th>Cost</th>
                  <th>Sent On</th>
                 
                  <th>Action</th>
                  </tr>
                  </thead><tbody>';
                  foreach ($data as $row) {
                   
                    $output .='<tr>
                               
                               <td>'.$row['name'].'</td>
                               <td>'.$row['email'].'</td>
                               <td>'.$row['phone'].'</td>
                               <td>'.$row['resourceName'].'</td>
                               
                               <td>'.$row['resourceCost'].'</td>
                               <td>'.$row['dateSent'].'</td>
                               

                               <td>
                                           

          

                               <a href="#"  id="'.$row['id'].'" class="btn btn-secondary generateReportIcon" data-toggle="modal" data-target="#generateReportModal">Receipt</a>
                    
                               </td>
                               </tr>';
                  }
                  $output .= '</tbody>
                              </table>';
                  
                  
                  echo $output;
    }
    else{
      echo '<h3 class="text-center text-secondary">No data for receipt!</h3>';
    }
  }

 //handle fetch data for reort
 if (isset($_POST['reportId'])) {
    
    $reportId = $_POST['reportId'];
     $result = $userObject->fetchDataForReport($reportId);
     echo json_encode($result);
  }
  
  //handle reject resource ajax requst 
 if (isset($_POST['rejectResourceId'])){
    $rejectResourceId = $userObject->test_input($_POST['rejectResourceId']);

   $row= $userObject->getRejectedResourceId($rejectResourceId);
     
  echo json_encode($row);
  }

  

  //handle requests intended for the director of finance  ajax request
  if(isset($_POST['action']) && $_POST['action'] =='fetchDirectorOfFinanceIntendedRequests') {
    
    $output = '';
    $requests = $userObject->fetchDirectorOfFinanceIntendedRequests();
   

    if ($requests) {
      $output .= '<table class="table table-striped table-bordered text-center">
                  <thead>
                  <tr>
                  
                  
                  
                  <th>Resources</th>
                  
                  <th>Cost</th>
                  <th>Date Sent</th>
                 <th>Signed By</th>
                  
                 
                  <th>Action</th>
                  </tr>
                  </thead><tbody>';
                  foreach ($requests as $row) {
                   
                    $output .='<tr>
                               
                               
                            
                               <td>'.$row['resourceName'].'</td>
                              
                              <td>'.$row['resourceCost'].'</td>
                               <td>'.$row['dateSent'].'</td>
                                <td>'.$row['procurementOfficer_commentBy'].'(Procurement Officer)</td>
                               
                               

                               <td>
                               
                                <a href="#" id="'.$row['id'].'" class="btn btn-danger viceChancellorCommentRequestIcon" data-toggle="modal" data-target="#commentRequestModal">Reject</a>&nbsp;

                               <a href="#" id="'.$row['id'].'" class="btn btn-success financeApproveRequestIcon">Recommend</a>
                    
                               </td>
                               </tr>';
                  }
                  $output .= '</tbody>
                              </table>';
                  
                  
                  echo $output;
    }
    else{
      echo '<h3 class="text-center text-secondary">No new request available!</h3>';
    }
  }

   //handle fetch fetch messages
  if (isset($_POST['action']) && $_POST['action'] == 'fetchMessages') {
    $messages = $userObject->fetchMessages();
    $output = '';

    if ($messages) {
      foreach ($messages as $row) {
        $output .= '<div class="alert alert-secondary" role="alert">
          <button type="button" id="'.$row['id'].'" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="alert-heading">Message</h4>
          <p class="mb-0 lead">'.$row['text'].'</p>
          <hr class="my-4">
          <p class="mb-0 float-left">From '.$row['sender'].'</p>
          <p class="mb-0 float-right">'.$userObject->timeInAgo($row['date']).'</p>
          <div class="clearfix"></div>
        </div>';
      }
      echo $output;
    }
    else{
      echo '<h3 class="text-center text-secondary mt-5">No any new message!</h3>';
    }
  }

  //handle fetch data for reort
 if (isset($_POST['deleteMessageID'])) {
    
    $deleteMessageID = $userObject->test_input($_POST['deleteMessageID']);
     $result = $userObject->deleteMessage($deleteMessageID);
     
  }
  
  
//handle fetch department approved requests
  if (isset($_POST['action']) && $_POST['action']=='fetchHODApprovedRequests') {
    
    $output = '';
     $department =  $userObject->test_input($_POST['departmentApproved']);
     $name = $_POST['name'];

    $requests = $userObject->fetchAllDepartmentalApprovedRequests($department,$name);
   

    if ($requests) {
      $output .= '<table class="table table-striped table-bordered text-center">
                  <thead>
                  <tr>
                  
                  <th>Initiator</th>
                  <th>E-Mail</th>
                  <th>Department</th>
                  <th>Request</th>
                  <th>Signed By</th>
                  <th>Requested On</th>
                  
                  </tr>
                  </thead><tbody>';
                  foreach ($requests as $row) {
                   
                    $output .='<tr>
                               
                               <td>'.$row['name'].'</td>
                               <td>'.$row['email'].'</td>
                                <td>'.$row['department'].'</td>
                               <td>'.$row['itemName'].'</td>
                                <td>'.$row['hod_commentBy'].'(HOD)</td>
                               <td>'.$row['createdAt'].'</td>

                               
                               </tr>';
                  }
                  $output .= '</tbody>
                              </table>';
                  
                  
                  echo $output;
    }
    else{
      echo '<h3 class="text-center text-secondary">No approved request available!</h3>';
    }
  }

//handle fetch all departmental rquests rejected requests
   if (isset($_POST['action']) && $_POST['action'] == 'fetchHODrejectedRequests') {
    
    $output = '';
     $department =  $userObject->test_input($_POST['departmentRejected']);
     $name= $_POST['name'];
    $requests = $userObject->fetchAllDepartmentalRejectedRequests($department,$name);
   

    if ($requests) {
      $output .= '<table class="table table-striped table-bordered text-center">
                  <thead>
                  <tr>
                  
                  <th>Initiator</th>
                  <th>E-Mail</th>
                  <th>Department</th>
                  <th>Request</th>
                  <th>Signed By</th>
                  <th>Requested On</th>
                  
                  </tr>
                  </thead><tbody>';
                  foreach ($requests as $row) {
                   
                    $output .='<tr>
                               
                               <td>'.$row['name'].'</td>
                               <td>'.$row['email'].'</td>
                                <td>'.$row['department'].'</td>
                               <td>'.$row['itemName'].'</td>
                              <td>'.$row['hod_commentBy'].'(HOD)</td>
                               <td>'.$row['createdAt'].'</td>

                              
                               </tr>';
                  }
                  $output .= '</tbody>
                              </table>';
                  
                  
                  echo $output;
    }
    else{
      echo '<h3 class="text-center text-secondary">No rejected request available!</h3>';
    }
  }

  //handle fetch all rejected requests by dean ajax request
  if(isset($_POST['action']) && $_POST['action'] =='fetchDeanrejectedRequests') {
    
    $output = '';
    $name = $_POST['name'];
    $requests = $userObject->fetchDeanrejectedRequests($name);
   

    if ($requests) {
      $output .= '<table class="table table-striped table-bordered text-center">
                  <thead>
                  <tr>
                  
                  <th>Initiator</th>
                  <th>E-Mail</th>
                  <th>Department</th>
                  <th>Request</th>
                 
                  <th>Requested On</th>
                  <th>Signed By</th>
                
                  </tr>
                  </thead><tbody>';
                  foreach ($requests as $row) {
                   
                    $output .='<tr>
                               
                               <td>'.$row['name'].'</td>
                               <td>'.$row['email'].'</td>
                                <td>'.$row['department'].'</td>
                               <td>'.$row['itemName'].'</td>
                               
                               <td>'.$row['createdAt'].'</td>
                               <td>'.$row['hod_commentBy'].'(HOD)</td>

                              
                               </tr>';
                  }
                  $output .= '</tbody>
                              </table>';
                  
                  
                  echo $output;
    }
    else{
      echo '<h3 class="text-center text-secondary">No rejected request available!</h3>';
    }
  }

  //handle fetch all approved requests by dean ajax request
  if(isset($_POST['action']) && $_POST['action'] =='fetchDeanApprovedRequests') {
    
    $output = '';
    $name = $_POST['name'];
    $requests = $userObject->fetchDeanApprovedRequests($name);
   

    if ($requests) {
      $output .= '<table class="table table-striped table-bordered text-center">
                  <thead>
                  <tr>
                  
                  <th>Initiator</th>
                  <th>E-Mail</th>
                  <th>Department</th>
                  <th>Request</th>
                  
                  <th>Requested On</th>
                  <th>Signed By</th>
                  
                  </tr>
                  </thead><tbody>';
                  foreach ($requests as $row) {
                   
                    $output .='<tr>
                               
                               <td>'.$row['name'].'</td>
                               <td>'.$row['email'].'</td>
                                <td>'.$row['department'].'</td>
                               <td>'.$row['itemName'].'</td>
                               
                               <td>'.$row['createdAt'].'</td>
                               <td>'.$row['hod_commentBy'].'(HOD), '.$row['dean_commentBy'].'(Dean)</td>

                              
                               </tr>';
                  }
                  $output .= '</tbody>
                              </table>';
                  
                  
                  echo $output;
    }
    else{
      echo '<h3 class="text-center text-secondary">No approved request available!</h3>';
    }
  }

  //handle fetch appoved requests by the registrar ajax request
  if(isset($_POST['action']) && $_POST['action'] =='fetchRegistrarApprovedRequests') {
    
    $output = '';
    $name = $_POST['name'];
    $requests = $userObject->fetchRegistrarApprovedRequests($name);
   

    if ($requests) {
      $output .= '<table class="table table-striped table-bordered text-center">
                  <thead>
                  <tr>
                  
                  <th>Initiator</th>
                  <th>E-Mail</th>
                  <th>Department</th>
                  <th>Request</th>
                  
                  <th>Requested On</th>
                 <th>Signed By</th>
                 
                  </tr>
                  </thead><tbody>';
                  foreach ($requests as $row) {
                   
                    $output .='<tr>
                               
                               <td>'.$row['name'].'</td>
                               <td>'.$row['email'].'</td>
                                <td>'.$row['department'].'</td>
                               <td>'.$row['itemName'].'</td>
                              
                               <td>'.$row['createdAt'].'</td>
                                <td>'.$row['hod_commentBy'].'(HOD), '.$row['dean_commentBy'].'(Dean), '.$row['registrar_commentBy'].'(Registrar)</td>

                               
                               </tr>';
                  }
                  $output .= '</tbody>
                              </table>';
                  
                  
                  echo $output;
    }
    else{
      echo '<h3 class="text-center text-secondary">No approved request available!</h3>';
    }
  }

  //handle requests intended for the registrar ajax request
  if(isset($_POST['action']) && $_POST['action'] =='fetchRegistrarRejectedRequests') {
    
    $output = '';
    $name = $_POST['name'];
    $requests = $userObject->fetchRegistrarRejectedRequests($name);
   

    if ($requests) {
      $output .= '<table class="table table-striped table-bordered text-center">
                  <thead>
                  <tr>
                  
                  <th>Initiator</th>
                  <th>E-Mail</th>
                  <th>Department</th>
                  <th>Request</th>
                 
                  <th>Requested On</th>
                 <th>Signed By</th>
                  
                  </tr>
                  </thead><tbody>';
                  foreach ($requests as $row) {
                   
                    $output .='<tr>
                               
                               <td>'.$row['name'].'</td>
                               <td>'.$row['email'].'</td>
                                <td>'.$row['department'].'</td>
                               <td>'.$row['itemName'].'</td>
                               
                               <td>'.$row['createdAt'].'</td>
                               <td>'.$row['hod_commentBy'].'(HOD), '.$row['dean_commentBy'].'(Dean), '.$row['registrar_commentBy'].'(Registrar)</td>

                              
                               </tr>';
                  }
                  $output .= '</tbody>
                              </table>';
                  
                  
                  echo $output;
    }
    else{
      echo '<h3 class="text-center text-secondary">No rejected request available!</h3>';
    }
  }

  //handle fetch requests approved by the Vice chancellor ajax request
  if(isset($_POST['action']) && $_POST['action'] =='fetchViceChancellorApprovedRequests') {
    
    $output = '';
    $name= $_POST['name'];
    $requests = $userObject->fetchViceChancellorApprovedRequests($name);
   

    if ($requests) {
      $output .= '<table class="table table-striped table-bordered text-center">
                  <thead>
                  <tr>
                  
                  <th>Initiator</th>
                  <th>E-Mail</th>
                  <th>Department</th>
                  <th>Request</th>
                  
                  <th>Requested On</th>
                 <th>Signed By</th>
                  
                  </tr>
                  </thead><tbody>';
                  foreach ($requests as $row) {
                   
                    $output .='<tr>
                               
                               <td>'.$row['name'].'</td>
                               <td>'.$row['email'].'</td>
                                <td>'.$row['department'].'</td>
                               <td>'.$row['itemName'].'</td>
                               
                               <td>'.$row['createdAt'].'</td>
                               <td>'.$row['hod_commentBy'].'(HOD), '.$row['dean_commentBy'].'(Dean), '.$row['registrar_commentBy'].'(Registrar), '.$row['viceChancellor_commentBy'].'(VC)</td>

                              
                               </tr>';
                  }
                  $output .= '</tbody>
                              </table>';
                  
                  
                  echo $output;
    }
    else{
      echo '<h3 class="text-center text-secondary">No approved request available!</h3>';
    }
  }

  //handle fetch rejected requests by the Vice chancellor ajax request
  if(isset($_POST['action']) && $_POST['action'] =='fetchViceChancellorRejectedRequests') {
    
    $output = '';
    $name =$_POST['name'];
    $requests = $userObject->fetchViceChancellorRejectedRequests($name);
   

    if ($requests) {
      $output .= '<table class="table table-striped table-bordered text-center">
                  <thead>
                  <tr>
                  
                  <th>Initiator</th>
                  <th>E-Mail</th>
                  <th>Department</th>
                  <th>Request</th>
                  
                  <th>Requested On</th>
                 <th>Signed By</th>
                  
                  </tr>
                  </thead><tbody>';
                  foreach ($requests as $row) {
                   
                    $output .='<tr>
                               
                               <td>'.$row['name'].'</td>
                               <td>'.$row['email'].'</td>
                                <td>'.$row['department'].'</td>
                               <td>'.$row['itemName'].'</td>
                               
                               <td>'.$row['createdAt'].'</td>
                               <td>'.$row['hod_commentBy'].'(HOD), '.$row['dean_commentBy'].'(Dean), '.$row['registrar_commentBy'].'(Registrar)</td>

                              
                               </tr>';
                  }
                  $output .= '</tbody>
                              </table>';
                  
                  
                  echo $output;
    }
    else{
      echo '<h3 class="text-center text-secondary">No rejected request available!</h3>';
    }
  }

  //handle fetch approved requests by the procurement officer ajax request
  if(isset($_POST['action']) && $_POST['action'] =='fetchProcurementOfficerApprovedRequests') {
    
    $output = '';
    $name =$_POST['name'];
    $requests = $userObject->fetchProcurementOfficerApprovedRequests($name);
   

    if ($requests) {
      $output .= '<table class="table table-striped table-bordered text-center">
                  <thead>
                  <tr>
                  
                  <th>Initiator</th>
                  <th>E-Mail</th>
                  <th>Department</th>
                  <th>Request</th>
                 
                  <th>Requested On</th>
                 <th>Signed By</th>
                  
                  </tr>
                  </thead><tbody>';
                  foreach ($requests as $row) {
                   
                    $output .='<tr>
                               
                               <td>'.$row['name'].'</td>
                               <td>'.$row['email'].'</td>
                                <td>'.$row['department'].'</td>
                               <td>'.$row['itemName'].'</td>
                              
                               <td>'.$row['createdAt'].'</td>
                               <td>'.$row['hod_commentBy'].'(HOD), '.$row['dean_commentBy'].'(Dean), '.$row['registrar_commentBy'].'(Registrar), '.$row['viceChancellor_commentBy'].'(VC), '.$row['procurementOfficer_commentBy'].'(Procurement Officer)</td>

                              
                               </tr>';
                  }
                  $output .= '</tbody>
                              </table>';
                  
                  
                  echo $output;
    }
    else{
      echo '<h3 class="text-center text-secondary">No approved request available!</h3>';
    }
  }

  //handle fetch rejected requests by the procurement officer ajax request
  if(isset($_POST['action']) && $_POST['action'] =='fetchProcurementOfficerRejectedRequests') {
    
    $output = '';
    $name =$_POST['name'];
    $requests = $userObject->fetchProcurementOfficerRejectedRequests($name);
   

    if ($requests) {
      $output .= '<table class="table table-striped table-bordered text-center">
                  <thead>
                  <tr>
                  
                  <th>Initiator</th>
                  <th>E-Mail</th>
                  <th>Department</th>
                  <th>Request</th>
                 
                  <th>Requested On</th>
                 <th>Signed By</th>
                  
                  </tr>
                  </thead><tbody>';
                  foreach ($requests as $row) {
                   
                    $output .='<tr>
                               
                               <td>'.$row['name'].'</td>
                               <td>'.$row['email'].'</td>
                                <td>'.$row['department'].'</td>
                               <td>'.$row['itemName'].'</td>
                               
                               <td>'.$row['createdAt'].'</td>
                                <td>'.$row['hod_commentBy'].'(HOD), '.$row['dean_commentBy'].'(Dean), '.$row['registrar_commentBy'].'(Registrar), '.$row['viceChancellor_commentBy'].'(VC), '.$row['procurementOfficer_commentBy'].'(Procurement Officer)</td>

                              
                               </tr>';
                  }
                  $output .= '</tbody>
                              </table>';
                  
                  
                  echo $output;
    }
    else{
      echo '<h3 class="text-center text-secondary">No rejected request available!</h3>';
    }
  }
 
 //handle send approve resource message ajax request
 if (isset($_POST['action']) && $_POST['action'] == 'sendApproveMessage') {
  $role = $_POST['role'];
   $name = $_POST['fullName'];
   $id = $_POST['id'];
   $uid = $_POST['uid'];
  $message = $_POST['message'];
   $userObject->supplierNotification($uid,$role,$message,$id);
   $userObject->approveSupply($id,$name);
 }

 //handle fetch all bought resources
 if(isset($_POST['action']) && $_POST['action'] =='fetchAllBoughtResources') {
    $output = '';
    $requests = $userObject->fetchAllBoughtResources();
   

    if ($requests) {
      $output .= '<table class="table table-striped table-bordered text-center">
                  <thead>
                  <tr>
                  
                  <th>Supplier Name</th>
                  <th>E-Mail</th>
                  <th>Phone Number</th>
                  <th>Resource</th>
                 
                  <th> Cost</th>
                  <th>Sent On</th>
                 
                  
                  </tr>
                  </thead><tbody>';
                  foreach ($requests as $row) {
                   
                    $output .='<tr>
                               
                               <td>'.$row['name'].'</td>
                               <td>'.$row['email'].'</td>
                               <td>'.$row['phone'].'</td>
                               <td>'.$row['resourceName'].'</td>
                              
                               <td>'.$row['resourceCost'].'</td>
                               <td>'.$row['dateSent'].'</td>
                               

                            
                               </tr>';
                  }
                  $output .= '</tbody>
                              </table>';
                  
                  
                  echo $output;
    }
    else{
      echo '<h3 class="text-center text-secondary">No resource available!</h3>';
    }
 }

//handle send reject resource message ajax request
 if (isset($_POST['action']) && $_POST['action'] == 'sendRejectMessage') {
  $role = $_POST['role'];
   $name = $_POST['fullName'];
   $id = $_POST['Id'];
   $uid = $_POST['Uid'];
  $message = $_POST['Message'];
  echo $role, $name, $id,$uid,$message;
   $userObject->supplierNotification($uid,$role,$message,$id);
   $userObject->rejectSupply($id,$name);
 }

 //handle fetch all rejected resources
 if(isset($_POST['action']) && $_POST['action'] =='fetchRejectedResources') {
    $output = '';
    $requests = $userObject->fetchAllRejectedResources();
   

    if ($requests) {
      $output .= '<table class="table table-striped table-bordered text-center">
                  <thead>
                  <tr>
                  
                  <th>Supplier Name</th>
                  <th>E-Mail</th>
                  <th>Phone Number</th>
                  <th>Resource</th>
                 
                  <th> Cost</th>
                  <th>Sent On</th>
                 
                  
                  </tr>
                  </thead><tbody>';
                  foreach ($requests as $row) {
                   
                    $output .='<tr>
                               
                               <td>'.$row['name'].'</td>
                               <td>'.$row['email'].'</td>
                               <td>'.$row['phone'].'</td>
                               <td>'.$row['resourceName'].'</td>
                              
                               <td>'.$row['resourceCost'].'</td>
                               <td>'.$row['dateSent'].'</td>
                               

                            
                               </tr>';
                  }
                  $output .= '</tbody>
                              </table>';
                  
                  
                  echo $output;
    }
    else{
      echo '<h3 class="text-center text-secondary">No resource available!</h3>';
    }
 }


 //handle advert ajax request
   if(isset($_POST['action']) && $_POST['action'] =='fetchAdvert') {
    
     $output = '';
    $advert = $userObject->fetchAdvertData();
   

    if ($advert) {
      $output .= '<table class="table table-striped table-bordered text-center">
                  <thead>
                  <tr>
                  
                  
                  <th>Resources</th>
                  
                 <th>Action</th>
                 
                  
                  </tr>
                  </thead><tbody>';
                  foreach ($advert as $row) {
                   
                    $output .='<tr>
                               
                               
                               <td>'.$row['itemName'].'</td>
                               
                               
                                <td>
                                 <a href="#" id="'.$row['id'].'" class="btn btn-success supplyIcon" data-toggle="modal" data-target="#addResourceModal">Supply</a>&nbsp;
                                </td>

                              
                               </tr>';
                  }
                  $output .= '</tbody>
                              </table>';
                  
                  
                  echo $output;
    }
    else{
      echo '<h3 class="text-center text-secondary">No new advert available!</h3>';
    }
  }

//handle supply ajax request
   if(isset($_POST['supplyId'])){
   

  $id =  $userObject->test_input($_POST['supplyId']);

  $row = $userObject->getResourceReference($id);
  echo json_encode($row);
}

  //handle finance approval ajax request
   if(isset($_POST['action']) && $_POST['action'] =='financeAproval') {
    $financeId = $_POST['financeId'];
     $name = $_POST['name'];
    // $name = $_POST['name'];
    //  $role = $_POST['role'];
   $result= $userObject->financeApproval($financeId,$name);
   echo json_encode($result);
  }

//fetch finance approved requests
  if(isset($_POST['action']) && $_POST['action'] =='fetchOfficerOfFinanceApprovedRequests') {
    
    $output = '';
    $name = $_POST['name'];
    $requests = $userObject->fetchOfficerOfFinanceApprovedRequests($name);
   

    if ($requests) {
      $output .= '<table class="table table-striped table-bordered text-center">
                  <thead>
                  <tr>
                  
                  
                  
                  <th>Resources</th>
                  
                  <th>Cost</th>
                  <th>Date Sent</th>
                 <th>Signed By</th>
                  
                 
                  
                  </tr>
                  </thead><tbody>';
                  foreach ($requests as $row) {
                   
                    $output .='<tr>
                               
                               
                            
                               <td>'.$row['resourceName'].'</td>
                              
                              <td>'.$row['resourceCost'].'</td>
                               <td>'.$row['dateSent'].'</td>
                                <td>'.$row['procurementOfficer_commentBy'].'(Procurement Officer), '.$row['directorOfFinance_commentBy'].'(Director of fince)</td>
                               
                               

                              
                               </tr>';
                  }
                  $output .= '</tbody>
                              </table>';
                  
                  
                  echo $output;
    }
    else{
      echo '<h3 class="text-center text-secondary">No Approved requests!</h3>';
    }
  }

?>