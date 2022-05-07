<?php
require_once 'config.php';

/**
 * 
 */
class Auth extends Database
{
	
	//register new user
	public function register($role, $name, $email,$phone,$gender,$department, $password){
		$sql = "INSERT INTO users (role,name, email, phone,gender,department, password) VALUES (:role, :name, :email, :phone, :gender, :department, :pass)";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['role'=>$role, 'name'=>$name, 'email'=>$email, 'phone'=>$phone, 'gender'=>$gender, 'department'=>$department, 'pass'=>$password]);
		return true;
	}

	//check if user already registered
    public function user_exist($email){
    	$sql =  "SELECT email from users WHERE email = :email";
    	$stmt = $this->conn->prepare($sql);
    	$stmt->execute(['email'=>$email]);
    	$result = $stmt->fetch(PDO::FETCH_ASSOC);
    	return $result;
    }

    //login existing user
    public function login($email){
    	$sql =  "SELECT email, password, role FROM users WHERE email = :email"; 
    	$stmt = $this->conn->prepare($sql);
    	$stmt->execute(['email'=>$email]);
    	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    	return $row;
    }

    //Current in session
    public function currentUser($email){
    	$sql =  "SELECT * FROM users WHERE email = :email";
    	$stmt = $this->conn->prepare($sql);
    	$stmt->execute(['email'=>$email]);
    	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    	 return $row;
    }

    //forgot password
    public function forgot_password($token,$email){
        $sql ="UPDATE users SET token = :token, token_expire = DATE_ADD(NOW(), INTERVAL 10 MINUTE) WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['token'=>$token,'email'=>$email]);
        return true;
    }

    //reset password user auth
    public function reset_pass_auth($email,$token){
       $sql = "SELECT id FROM users WHERE email = :email AND token = :token AND token_expire > NOW()";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['token'=>$token,'email'=>$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $row;

    }

    //update new password 
    public function update_new_pass($pass,$email){
        $sql = "UPDATE users SET token = '', password = :pass WHERE email = :email";
      $stmt = $this->conn->prepare($sql);
       $stmt->execute(['pass'=>$pass,'email'=>$email]);

       return true;
    }

    //Add new request
    public function add_new_request($uid,$itemName, $itemQuantity, $itemQuality){
        $sql = "INSERT INTO request(uid, itemName, itemQuantity, itemQuality) VALUES (:uid, :itemName, :itemQuantity, :itemQuality)";
        $stmt = $this->conn->prepare($sql);
         $stmt->execute(['uid'=>$uid, 'itemName'=>$itemName, 'itemQuantity'=>$itemQuantity,'itemQuality'=>$itemQuality]);
         return true;


    }

    //fetch all requests of a user
    public function get_resource_requests($uid){
        $sql = "SELECT * FROM request WHERE uid = :uid";
       $stmt = $this->conn->prepare($sql);
       $stmt->execute(['uid'=>$uid]);
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $row; 

    }

    //view resource request of a user
    public function viewRequest($id){
        $sql = "SELECT * FROM request WHERE id = :id";
       $stmt = $this->conn->prepare($sql);
       $stmt->execute(['id'=>$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    }

     //view resource request of a user
    public function viewSuppliedResource($id){
        $sql = "SELECT * FROM resource WHERE id = :id";
       $stmt = $this->conn->prepare($sql);
       $stmt->execute(['id'=>$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    }

    //update resource request of a user
    public function update_resource_request($id, $itemName, $itemQuantity, $itemQuality){
        $sql = "UPDATE request SET itemName = :itemName, itemQuantity = :itemQuantity, itemQuality = :itemQuality, updated_at = NOW() WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
      $stmt->execute(['itemName'=>$itemName, 'itemQuantity'=>$itemQuantity,'itemQuality'=>$itemQuality, 'id'=>$id]);
      return true;
    }

    //delete resource request of a user
    public function delete_resource_request($id){
        $sql = "DELETE FROM request WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);
        return true;
    }

    //update profile a user
    public function update_profile($photo,$name,$gender,$phone,$department,$id){
        $sql = "UPDATE users SET photo =:photo, name =:name, gender= :gender, phone=:phone, department= :department WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['photo'=>$photo, 'name'=>$name,'gender'=>$gender, 'phone'=>$phone, 'department'=>$department,'id'=>$id]);
        return true;
    }

    //insert notification
    public function notification($uid,$type,$message,$id){
        $sql = "INSERT INTO notification (uid, type, message,requestID) VALUES (:uid, :type, :message, :requestID)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['uid'=>$uid,'type'=>$type, 'message'=>$message, 'requestID'=>$id]);
        return true;
    }

     //insert notification for supplier
    public function supplierNotification($uid,$type,$message,$id){
        $sql = "INSERT INTO notifications (uid, type, message,resourceID) VALUES (:uid, :type, :message, :resourceID)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['uid'=>$uid,'type'=>$type, 'message'=>$message, 'resourceID'=>$id]);
        return true;
    }

    //fetch supplier notification
    public function checkSupplierNotification($uid){
         $sql = "SELECT * FROM notifications WHERE uid = :uid";
         $stmt = $this->conn->prepare($sql);
         $stmt->execute(['uid'=>$uid]);

         $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

         return $result;
    }

     //fetch initiator notification
    public function fetchNotification($uid){
         $sql = "SELECT * FROM notification WHERE uid = :uid";
         $stmt = $this->conn->prepare($sql);
         $stmt->execute(['uid'=>$uid]);

         $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

         return $result;
    }

     //fetch notification
    public function fetchSupplierNotification($uid){
         $sql = "SELECT * FROM notifications WHERE uid = :uid";
         $stmt = $this->conn->prepare($sql);
         $stmt->execute(['uid'=>$uid]);

         $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

         return $result;
    }
     

    //remove notification
    public function removeNotification($id){
        $sql = "DELETE FROM notification WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);
        return true;
    }

    //remove notification
    public function removeSupplierNotification($id){
        $sql = "DELETE FROM notifications WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);
        return true;
    }
     
     //fetch all departmental requests
      public function fetchAllDepartmentalRequests($department){
       $sql = "SELECT request.id, request.itemName, request.itemQuantity, request.itemQuality, request.createdAt, users.name, users.email,users.department FROM request INNER JOIN users ON request.uid = users.id WHERE department = :department AND hod_comment = ''";
     $stmt = $this->conn->prepare($sql);
     $stmt->execute(['department'=>$department]);
     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

     return $result;
     }

     //update request departmental approval
     public function departmentalApproval($id,$name,$role){
        $sql = "UPDATE request SET hod_comment = 'approved',hod_commentBy=:name WHERE id =:id";
        $stmt = $this->conn->prepare($sql);
       $result= $stmt->execute(['id'=>$id,'name'=>$name]);
        if ($result) {
            $sql = "SELECT uid FROM request WHERE id=:id";
             $stmt = $this->conn->prepare($sql);
             $stmt->execute(['id'=>$id]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

             
            if ($result) {
                
                $message = 'Your request has been approved by the Head of department now it is in the Dean`s office';
                foreach ($result as $row) {
                   global $userID;
                   $userID = $row['uid'];
                }
                
               $sql = "INSERT INTO notification (uid, type, message,requestID) VALUES (:uid, :type, :message, :requestID)";
                $stmt = $this->conn->prepare($sql);
                 $stmt->execute(['uid'=>$userID, 'type'=>$role, 'message'=>$message, 'requestID'=>$id]);

                 return true;
            }
        }
     }

     //fetch requests for the Dean
          public function fetchDeanIntendedRequests(){
       $sql = "SELECT request.id, request.itemName, request.itemQuantity, request.itemQuality, request.createdAt, users.name, users.email,users.department, request.hod_commentBy, request.dean_commentBy FROM request INNER JOIN users ON request.uid = users.id WHERE hod_comment = 'approved' AND hod_commentBy != '' AND dean_comment=''";
     $stmt = $this->conn->prepare($sql);
     $stmt->execute();
     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

     return $result;
     }
     
     //update request dean approval
     public function deanApproval($id,$name,$role){
        $sql = "UPDATE request SET dean_comment = 'approved',dean_commentBy=:name WHERE id =:id";
        $stmt = $this->conn->prepare($sql);
         $result=$stmt->execute(['id'=>$id,'name'=>$name]);
       
         if ($result) {
            $sql = "SELECT uid FROM request WHERE id=:id";
             $stmt = $this->conn->prepare($sql);
             $stmt->execute(['id'=>$id]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

             
            if ($result) {
                
                $message = 'Your request has been approved by the Dean now it is in the office of the Registrar';
                foreach ($result as $row) {
                   global $userID;
                   $userID = $row['uid'];
                }
                
               $sql = "INSERT INTO notification (uid, type, message,requestID) VALUES (:uid, :type, :message, :requestID)";
                $stmt = $this->conn->prepare($sql);
                 $stmt->execute(['uid'=>$userID,'type'=>$role, 'message'=>$message, 'requestID'=>$id]);

                 return true;
            }
        }
     }

      //get user ID 
      public function getUserId($id){
        $sql = "SELECT * FROM request WHERE id = :id";
       $stmt = $this->conn->prepare($sql);
       $stmt->execute(['id'=>$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    }

    //HOD comment request
    public function HODcommentRequest($id,$uid,$title,$message,$name){
        $sql = "INSERT INTO feedback(uid, title, message) VALUES (:uid, :title, :message)";
        $stmt = $this->conn->prepare($sql);
        $result= $stmt->execute(['uid'=>$uid,'title'=>$title, 'message'=>$message]);
        if ($result) {
        $sql = "UPDATE request SET hod_comment = 'rejected',hod_commentBy=:name WHERE id =:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id,'name'=>$name]);
        return true;
        }
        
    }

     //dean comment request
    public function DeanCommentRequest($id,$uid,$title,$message){
        $sql = "INSERT INTO feedback(uid, title, message) VALUES (:uid, :title, :message)";
        $stmt = $this->conn->prepare($sql);
        $result= $stmt->execute(['uid'=>$uid,'title'=>$title, 'message'=>$message]);
        if ($result) {
         $sql = "UPDATE request SET dean_comment = 'rejected' WHERE id =:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);
        return true;
        }
        
    }
    
    //get all feedback of a user
    public function getFeedback($uid){
        $sql= "SELECT * FROM feedback WHERE uid = :uid ";
        $stmt =$this->conn->prepare($sql);
        $stmt->execute(['uid'=>$uid]);
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $row;

    }

    //delete feedback of a user
    public function deleteFeedback($id){
        $sql = "DELETE FROM feedback WHERE id= :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);
        return true;
    }

    //insert budget
    public function insertBudget($budget,$departmentName){
        $sql = "INSERT INTO department(departmentName, budget) VALUES (:departmentName, :budget)";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(['departmentName'=>$departmentName,'budget'=>$budget]);
        return true;
    }

    //check balance
    public function checkBalance($department){
        $sql = "SELECT budget FROM department WHERE departmentName = :departmentName";
         $stmt= $this->conn->prepare($sql);
        $stmt->execute(['departmentName'=>$department]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

     //fetch requests intended for the registrar
          public function fetchRegistrarIntendedRequests(){
       $sql = "SELECT request.id, request.itemName, request.itemQuantity, request.itemQuality, request.createdAt, users.name, users.email,users.department, request.hod_commentBy,request.dean_commentBy FROM request INNER JOIN users ON request.uid = users.id WHERE hod_comment = 'approved' AND dean_comment='approved' AND registrar_comment=''";
     $stmt = $this->conn->prepare($sql);
     $stmt->execute();
     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

     return $result;
     }

     //update request registrar approval
     public function registrarApproval($id,$name,$role){
        $sql = "UPDATE request SET registrar_comment = 'approved',registrar_commentBy=:name WHERE id =:id";
        $stmt = $this->conn->prepare($sql);
        $result=$stmt->execute(['id'=>$id,'name'=>$name]);
        
        if ($result) {
            $sql = "SELECT uid FROM request WHERE id=:id";
             $stmt = $this->conn->prepare($sql);
             $stmt->execute(['id'=>$id]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

             
            if ($result) {
                
                $message = 'Your request has been approved by the Registrar now it is in the office of the Vice Chancellor';
                foreach ($result as $row) {
                   global $userID;
                   $userID = $row['uid'];
                }
                
               $sql = "INSERT INTO notification (uid, type, message,requestID) VALUES (:uid, :type, :message, :requestID)";
                $stmt = $this->conn->prepare($sql);
                 $stmt->execute(['uid'=>$userID,'type'=>$role, 'message'=>$message, 'requestID'=>$id]);

                 return true;
            }
        }
     }

     //registrar comment request
    public function registrarCommentRequest($id,$uid,$title,$message,$name){
        $sql = "INSERT INTO feedback(uid, title, message) VALUES (:uid, :title, :message)";
        $stmt = $this->conn->prepare($sql);
        $result= $stmt->execute(['uid'=>$uid,'title'=>$title, 'message'=>$message]);
        if ($result) {
         $sql = "UPDATE request SET registrar_comment = 'rejected',registrar_commentBy=:name WHERE id =:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id,'name'=>$name]);
        return true;
        }
      }

      //fetch requests intended for the vice chancellor
          public function fetchViceChancellorIntendedRequests(){
       $sql = "SELECT request.id, request.itemName, request.itemQuantity, request.itemQuality, request.createdAt, users.name, users.email,users.department, request.hod_commentBy,request.dean_commentBy,request.registrar_commentBy FROM request INNER JOIN users ON request.uid = users.id WHERE hod_comment = 'approved' AND dean_comment='approved' AND registrar_comment='approved' AND registrar_commentBy !=''  AND viceChancellor_comment=''";
     $stmt = $this->conn->prepare($sql);
     $stmt->execute();
     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

     return $result;
     }

     //update request vice chancellor approval
     public function viceChancelorApproval($id,$name,$role){
        $sql = "UPDATE request SET viceChancellor_comment = 'approved', viceChancellor_commentBy=:name WHERE id =:id";
        $stmt = $this->conn->prepare($sql);
        $result=$stmt->execute(['id'=>$id,'name'=>$name]);
        
         if ($result) {
            $sql = "SELECT uid FROM request WHERE id=:id";
             $stmt = $this->conn->prepare($sql);
             $stmt->execute(['id'=>$id]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

             
            if ($result) {
                
                $message = 'Your request has been approved by the Vice Chancellor now it is in the office of the procurement';
                foreach ($result as $row) {
                   global $userID;
                   $userID = $row['uid'];
                }
                
               $sql = "INSERT INTO notification (uid, type, message,requestID) VALUES (:uid, :type, :message, :requestID)";
                $stmt = $this->conn->prepare($sql);
                 $stmt->execute(['uid'=>$userID,'type'=>$role, 'message'=>$message, 'requestID'=>$id]);

                 return true;
            }
        }
     }

     //update request procurement officer approval
     public function procurementOfficerApproval($id,$name,$role){
        $sql = "UPDATE request SET procurementOfficer_comment = 'approved', procurementOfficer_commentBy =:name WHERE id =:id";
        $stmt = $this->conn->prepare($sql);
        $result=$stmt->execute(['id'=>$id,'name'=>$name]);
        
         if ($result) {
            $sql = "SELECT uid FROM request WHERE id=:id";
             $stmt = $this->conn->prepare($sql);
             $stmt->execute(['id'=>$id]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

             
            if ($result) {
                
                $message = 'Your items have been procured, please go and collect to the stores ';
                foreach ($result as $row) {
                   global $userID;
                   $userID = $row['uid'];
                }
                
               $sql = "INSERT INTO notification (uid, type, message,requestID) VALUES (:uid, :type, :message,:requestID)";
                $stmt = $this->conn->prepare($sql);
                 $stmt->execute(['uid'=>$userID,'type'=>$role, 'message'=>$message, 'requestID'=>$id]);

                 return true;
            }
        }
     }

      //vice chancellor comment request
    public function viceChancellorCommentRequest($id,$uid,$title,$message,$name){
        $sql = "INSERT INTO feedback(uid, title, message) VALUES (:uid, :title, :message)";
        $stmt = $this->conn->prepare($sql);
        $result= $stmt->execute(['uid'=>$uid,'title'=>$title, 'message'=>$message]);
        if ($result) {
         $sql = "UPDATE request SET viceChancellor_comment = 'rejected', viceChancellor_commentBy=:name WHERE id =:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id,'name'=>$name]);
        return true;
        }
      }

      //fetch requests intended for procurement officer
          public function fetchProcurementOfficerIntendedRequests(){
       $sql = "SELECT request.id, request.itemName, request.itemQuantity, request.itemQuality, request.createdAt, users.name, users.email,users.department, users.phone,request.hod_commentBy, request.dean_commentBy, request.registrar_commentBy, request.viceChancellor_commentBy FROM request INNER JOIN users ON request.uid = users.id WHERE hod_comment = 'approved' AND dean_comment='approved' AND registrar_comment='approved'  AND viceChancellor_comment='approved' AND viceChancellor_commentBy !='' AND procurementOfficer_comment=''";
     $stmt = $this->conn->prepare($sql);
     $stmt->execute();
     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

     return $result;
     }

     //Add new resource
    public function addNewResource($uid,$resourceName, $resourceQuantity,$resourceQuality, $resourceCost,$department){
        $sql = "INSERT INTO resource(uid, resourceName, resourceQuantity, resourceQuality, resourceCost,department) VALUES (:uid, :resourceName, :resourceQuantity, :resourceQuality, :resourceCost,:department)";
        $stmt = $this->conn->prepare($sql);
         $stmt->execute(['uid'=>$uid, 'resourceName'=>$resourceName, 'resourceQuantity'=>$resourceQuantity,'resourceQuality'=>$resourceQuality, 'resourceCost'=>$resourceCost,'department'=>$department]);
         return true;
    }

    //fetch all resources of a user
    public function displayResource($uid){
        $sql = "SELECT * FROM resource WHERE uid = :uid";
       $stmt = $this->conn->prepare($sql);
       $stmt->execute(['uid'=>$uid]);
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $row; 

    }

    //delete resource supply of a user
    public function deleteResourceSupply($id){
        $sql = "DELETE FROM resource WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);
        return true;
    }

    //fetch all resources of suppliers
          public function fetchAllResources(){
       $sql = "SELECT resource.id, resource.resourceName, resource.resourceQuantity, resource.resourceQuality, resource.resourceCost, resource.dateSent, users.name, users.email,users.phone FROM resource INNER JOIN users ON resource.uid = users.id WHERE status=''";
     $stmt = $this->conn->prepare($sql);
     $stmt->execute();
     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

     return $result;
     }

      //fetch all suppliers users
     public function fetchAllSuppliers($val){
      $sql = "SELECT * FROM users WHERE role = 'supplier' AND deleted != $val";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      return $result;
     }

     //get phone number of a supplier
     public function getSupplierUserID($id){
         $sql = "SELECT * FROM resource WHERE id = :id";
       $stmt = $this->conn->prepare($sql);
       $stmt->execute(['id'=>$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
     }

     //fetch advert
     public function fetchAdvert(){
        $sql = "SELECT  itemName FROM request WHERE procurementOfficer_comment = 'approved' AND  procurementOfficer_commentBy != '' AND directorOfFinance_comment=''";
     $stmt = $this->conn->prepare($sql);
     $stmt->execute();
     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

     return $result;
     }

     //fetch report
      public function fetchReport(){
        $sql = "SELECT resource.id, resource.resourceName, resource.resourceCost, resource.dateSent, users.name, users.email,users.phone FROM resource INNER JOIN users ON resource.uid = users.id WHERE status = 'selected'";
     $stmt = $this->conn->prepare($sql);
     $stmt->execute();
     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

     return $result;
     }
     
     //fetch data for report 
      public function fetchDataForReport($id){
        $sql = "SELECT * FROM resource  WHERE id= :id";
     $stmt = $this->conn->prepare($sql);
     $stmt->execute(['id'=>$id]);
     $result = $stmt->fetch(PDO::FETCH_ASSOC);

     return $result;
     }

     //reject resource
     public function getRejectedResourceId($id){
        $sql = "SELECT * FROM resource  WHERE id =:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

     return $result;
     }

      //fetch director of finance intended requests
      public function fetchDirectorOfFinanceIntendedRequests(){
        $sql = "SELECT * FROM resource WHERE procurementOfficer_commentBy !='' AND directorOfFinance_commentBy=''";
     $stmt = $this->conn->prepare($sql);
     $stmt->execute();
     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

     return $result;
     }

     //fetch messages
      public function fetchMessages(){
        $sql = "SELECT * FROM receivedmessages";
     $stmt = $this->conn->prepare($sql);
     $stmt->execute();
     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

     return $result;
     }

     //delete message
    public function deleteMessage($id){
        $sql = "DELETE FROM receivedmessages WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);
        return true;
    }

     public function printReportData($id){
        $sql = "SELECT resource.id, resource.resourceName, resource.resourceCost, resource.dateSent,resource.photo,resource.directorOfFinance_commentBy,resource.procurementOfficer_commentBy, users.name, users.email,users.phone FROM resource INNER JOIN users ON resource.uid = users.id WHERE resource.directorOfFinance_commentBy!='' AND resource.id = :id";
     $stmt = $this->conn->prepare($sql);
     $stmt->execute(['id'=>$id]);
     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

     return $result;
     }

     //fetch all departmental rejected requests
      public function fetchAllDepartmentalRejectedRequests($department,$name){
       $sql = "SELECT request.id, request.itemName, request.itemQuantity, request.itemQuality, request.createdAt, users.name, users.email,users.department,request.hod_commentBy  FROM request INNER JOIN users ON request.uid = users.id WHERE department = :department AND hod_comment = 'rejected' AND hod_commentBy=:name";
     $stmt = $this->conn->prepare($sql);
     $stmt->execute(['department'=>$department,'name'=>$name]);
     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

     return $result;
     }

     //fetch all departmental approved requests
      public function fetchAllDepartmentalApprovedRequests($department,$name){
       $sql = "SELECT request.id, request.itemName, request.itemQuantity, request.itemQuality, request.createdAt, users.name, users.email,users.department,request.hod_commentBy FROM request INNER JOIN users ON request.uid = users.id WHERE department = :department AND hod_comment = 'approved' AND hod_commentBy=:name";
     $stmt = $this->conn->prepare($sql);
     $stmt->execute(['department'=>$department,'name'=>$name]);
     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

     return $result;
     }

     //fetch requests rejected by the Dean
          public function fetchDeanrejectedRequests($name){
       $sql = "SELECT request.id, request.itemName, request.itemQuantity, request.itemQuality, request.createdAt, users.name, users.email,users.department, request.hod_commentBy,request.dean_commentBy FROM request INNER JOIN users ON request.uid = users.id WHERE hod_comment = 'approved' AND dean_comment='rejected' AND dean_commentBy = :name";
     $stmt = $this->conn->prepare($sql);
    $stmt->execute(['name'=>$name]);
     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

     return $result;
     }

     //fetch requests approved by the Dean
          public function fetchDeanApprovedRequests($name){
       $sql = "SELECT request.id, request.itemName, request.itemQuantity, request.itemQuality, request.createdAt, users.name, users.email,users.department, request.hod_commentBy,request.dean_commentBy FROM request INNER JOIN users ON request.uid = users.id WHERE hod_comment = 'approved' AND dean_comment='approved' AND dean_commentBy=:name";
     $stmt = $this->conn->prepare($sql);
     $stmt->execute(['name'=>$name]);
     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

     return $result;
     }

      //fetch registrar approved requests
          public function fetchRegistrarApprovedRequests($name){
       $sql = "SELECT request.id, request.itemName, request.itemQuantity, request.itemQuality, request.createdAt, users.name, users.email,users.department, request.hod_commentBy,request.dean_commentBy,request.registrar_commentBy FROM request INNER JOIN users ON request.uid = users.id WHERE hod_comment = 'approved' AND dean_comment='approved' AND registrar_comment='approved' AND registrar_commentBy=:name";
     $stmt = $this->conn->prepare($sql);
     $stmt->execute(['name'=>$name]);
     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

     return $result;
     }

      //fetch registrar rejected requests
          public function fetchRegistrarRejectedRequests($name){
       $sql = "SELECT request.id, request.itemName, request.itemQuantity, request.itemQuality, request.createdAt, users.name, users.email,users.department, request.hod_commentBy,request.dean_commentBy,request.registrar_commentBy FROM request INNER JOIN users ON request.uid = users.id WHERE hod_comment = 'approved' AND dean_comment='approved' AND registrar_comment='rejected' AND registrar_commentBy=:name";
     $stmt = $this->conn->prepare($sql);
      $stmt->execute(['name'=>$name]);
     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

     return $result;
     }

     //fetch requests approved by the vice chancellor
          public function fetchViceChancellorApprovedRequests($name){
       $sql = "SELECT request.id, request.itemName, request.itemQuantity, request.itemQuality, request.createdAt, users.name, users.email,users.department, request.hod_commentBy, request.dean_commentBy, request.registrar_commentBy, request.viceChancellor_commentBy FROM request INNER JOIN users ON request.uid = users.id WHERE hod_comment = 'approved' AND dean_comment='approved' AND registrar_comment='approved'  AND viceChancellor_comment='approved' AND viceChancellor_commentBy=:name";
     $stmt = $this->conn->prepare($sql);
      $stmt->execute(['name'=>$name]);
     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

     return $result;
     }

     //fetch requests rejected by the vice chancellor
          public function fetchViceChancellorRejectedRequests($name){
       $sql = "SELECT request.id, request.itemName, request.itemQuantity, request.itemQuality, request.createdAt, users.name, users.email,users.department, request.hod_commentBy, request.dean_commentBy, request.registrar_commentBy, request.viceChancellor_commentBy FROM request INNER JOIN users ON request.uid = users.id WHERE hod_comment = 'approved' AND dean_comment='approved' AND registrar_comment='approved'  AND viceChancellor_comment='rejected' AND viceChancellor_commentBy=:name";
     $stmt = $this->conn->prepare($sql);
     $stmt->execute(['name'=>$name]);
     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

     return $result;
     }
    
    //fetch requests approved by the procurement officer
      public function fetchProcurementOfficerApprovedRequests($name){
       $sql = "SELECT request.id, request.itemName, request.itemQuantity, request.itemQuality, request.createdAt, users.name, users.email,users.department, users.phone,request.hod_commentBy, request.dean_commentBy, request.registrar_commentBy, request.viceChancellor_commentBy, request.procurementOfficer_commentBy FROM request INNER JOIN users ON request.uid = users.id WHERE hod_comment = 'approved' AND dean_comment='approved' AND registrar_comment='approved'  AND viceChancellor_comment='approved' AND viceChancellor_commentBy !='' AND procurementOfficer_comment='approved' AND procurementOfficer_commentBy=:name";
     $stmt = $this->conn->prepare($sql);
    $stmt->execute(['name'=>$name]);
     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

     return $result;
     }

      //fetch requests rejected by the procurement officer
      public function fetchProcurementOfficerRejectedRequests($name){
       $sql = "SELECT request.id, request.itemName, request.itemQuantity, request.itemQuality, request.createdAt, users.name, users.email,users.department, users.phone,request.hod_commentBy, request.dean_commentBy, request.registrar_commentBy, request.viceChancellor_commentBy, request.procurementOfficer_commentBy FROM request INNER JOIN users ON request.uid = users.id WHERE hod_comment = 'approved' AND dean_comment='approved' AND registrar_comment='approved'  AND viceChancellor_comment='approved' AND viceChancellor_commentBy !='' AND procurementOfficer_comment='rejected' AND procurementOfficer_commentBy=:name";
     $stmt = $this->conn->prepare($sql);
    $stmt->execute(['name'=>$name]);
     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

     return $result;
     }

     //get supplier id
     // public function getSupplierID($id){

     //     $sql = "SELECT * FROM resource WHERE id = :id";
     //   $stmt = $this->conn->prepare($sql);
     //   $stmt->execute(['id'=>$id]);
     //    $row = $stmt->fetch(PDO::FETCH_ASSOC);

     //    return $row;
       
            
     //    }

        //approve supply
     public function approveSupply($id,$name){
          $sql = "UPDATE resource SET status= 'selected', procurementOfficer_commentBy=:name WHERE id =:id";
           $stmt = $this->conn->prepare($sql);
          $stmt->execute(['id'=>$id,'name'=>$name]);
          return true;

     }

     //fetch all bought resources 
          public function fetchAllBoughtResources(){
       $sql = "SELECT resource.id, resource.resourceName, resource.resourceQuantity, resource.resourceQuality, resource.resourceCost, resource.dateSent, users.name, users.email,users.phone FROM resource INNER JOIN users ON resource.uid = users.id WHERE status='selected'";
     $stmt = $this->conn->prepare($sql);
     $stmt->execute();
     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

     return $result;
     }

      //reject supply
     public function rejectSupply($id,$name){
          $sql = "UPDATE resource SET status= 'rejected', procurementOfficer_commentBy=:name WHERE id =:id";
           $stmt = $this->conn->prepare($sql);
          $stmt->execute(['id'=>$id,'name'=>$name]);
          return true;

     }

      //fetch all rejected resources of suppliers
          public function fetchAllRejectedResources(){
       $sql = "SELECT resource.id, resource.resourceName, resource.resourceQuantity, resource.resourceQuality, resource.resourceCost, resource.dateSent, users.name, users.email,users.phone FROM resource INNER JOIN users ON resource.uid = users.id WHERE status='rejected'";
     $stmt = $this->conn->prepare($sql);
     $stmt->execute();
     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

     return $result;
     }

     //count total number of users
     public function totalCount($tableName){
      $sql = "SELECT * FROM $tableName";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      $count = $stmt->rowCount();

      return $count;
     }
     

     //fetch advert
     public function fetchAdvertData(){
        $sql = "SELECT id, itemName FROM request WHERE procurementOfficer_comment = 'approved' AND  procurementOfficer_commentBy != '' AND directorOfFinance_comment=''";
     $stmt = $this->conn->prepare($sql);
     $stmt->execute();
     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

     return $result;
     }

     //get resource reference
      public function getResourceReference($id){
         $sql = "SELECT request.id, request.itemName,users.name, users.email,users.department FROM request INNER JOIN users ON request.uid = users.id WHERE request.id=:id";
       $stmt = $this->conn->prepare($sql);
       $stmt->execute(['id'=>$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
     }

     //finance approval
      public function financeApproval($id,$name){
        $sql = "SELECT * FROM resource WHERE id = :id";
       $stmt = $this->conn->prepare($sql);
       $stmt->execute(['id'=>$id]);
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
       // return $row;

        if ($row) {
            foreach ($row as $value) {
              
                     global $cost;
                $cost = $value['resourceCost'];
                global $resourceName;
                 $resourceName=$value['resourceName'];
                global $department;
                $department=$value['department'];
                
            }

           $sql = "SELECT * FROM department WHERE departmentName = :department";
           $stmt = $this->conn->prepare($sql);
           $stmt->execute(['department'=>$department]);
           $row2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
              
           
            if ($row2) {
            foreach ($row2 as $value) {
                global $budget;
                $budget = $value['budget'];
                global $departmentName;
                
                $departmentName=$value['departmentName'];
                
            }
            
            $balance = $budget - $cost;
             $sql = "UPDATE department SET budget= :balance WHERE departmentName =:departmentName";
            $stmt = $this->conn->prepare($sql);
           $result= $stmt->execute(['departmentName'=>$departmentName,'balance'=>$balance]);
           
           if ($result) {
              $sql = "UPDATE request SET directorOfFinance_comment= 'approved',directorOfFinance_commentBy=:name WHERE procurementOfficer_commentBy!=''";
            $stmt = $this->conn->prepare($sql);
           $result2= $stmt->execute(['name'=>$name]);
            
            if ($result2) {
                 $sql = "UPDATE resource SET directorOfFinance_commentBy =:name WHERE department!=''";
                 $stmt = $this->conn->prepare($sql);
                  $stmt->execute(['name'=>$name]);
                  return true;
            }
           }
        }


        }
    }

    //fetch director of finance approved requests
      public function fetchOfficerOfFinanceApprovedRequests($name){
        $sql = "SELECT * FROM resource WHERE directorOfFinance_commentBy=:name";
     $stmt = $this->conn->prepare($sql);
    $stmt->execute(['name'=>$name]);
     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

     return $result;
     }

     //fetch approved requests for report
     public function generateApprovedRequestsReport(){
       $sql = "SELECT request.id, request.itemName,request.createdAt, users.name, users.email,users.department, users.phone,request.hod_commentBy, request.dean_commentBy, request.registrar_commentBy, request.viceChancellor_commentBy, request.procurementOfficer_commentBy,request.directorOfFinance_commentBy FROM request INNER JOIN users ON request.uid = users.id WHERE request.directorOfFinance_commentBy!=''";
     $stmt = $this->conn->prepare($sql);
    $stmt->execute();
     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

     return $result;
     }
}
?>