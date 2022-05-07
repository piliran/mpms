<?php
  require_once 'config.php';

  
  class Admin extends Database
  {
  	
  	//admin login
     public function adminLogin($userName,$password){
     	$sql = "SELECT userName, password FROM admin WHERE userName = :userName AND password = :password";
     	$stmt = $this->conn->prepare($sql);
     	$stmt->execute(['userName'=>$userName, 'password'=>$password]);
     	$row = $stmt->fetch(PDO::FETCH_ASSOC);

     	return $row;

     }

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

     //count total number of users
     public function totalCount($tableName){
      $sql = "SELECT * FROM $tableName";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      $count = $stmt->rowCount();

      return $count;
     }

     //total number of verified/unverified
     public function verifiedUsers($status){
       $sql = "SELECT * FROM users WHERE verified = :status";
       $stmt = $this->conn->prepare($sql);
       $stmt->execute(['status'=>$status]);
       $count = $stmt->rowCount();

       return $count;
     }

     //fetch all registered users
     public function fetchAllUsers($val){
      $sql = "SELECT * FROM users WHERE deleted != $val";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      return $result;
     }

     //fetch user's details by id 
     public function fetchUserDetails($id){
      $sql = "SELECT * FROM users WHERE id = :id AND deleted != 0";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['id'=>$id]);

      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      return $result;
     }

     //delete user
     public function userAction($id, $val){
      $sql = "UPDATE users SET deleted = $val WHERE id = :id";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['id'=>$id]);

      return true;
     }

     //fetch all requests
     public function fetchAllRequests(){
       $sql = "SELECT request.id, request.itemName, request.itemQuantity, request.itemQuality, request.createdAt, users.name, users.email FROM request INNER JOIN users ON request.uid = users.id";
     $stmt = $this->conn->prepare($sql);
     $stmt->execute();
     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

     return $result;
     }

     //delete request by admin
     public function deleteRequest($id){
      $sql = "DELETE FROM request WHERE id = :id";
      $stmt= $this->conn->prepare($sql);
      $stmt->execute(['id'=>$id]);

      return true;
     }

     //fetch notification
     public function fetchNotification(){
      $sql = "SELECT notifications.id, notifications.message, notifications.createdAt, users.name, users.email FROM notifications INNER JOIN users ON notifications.uid = users.id WHERE type = 'admin' ORDER BY notifications.id DESC LIMIT 5";
      $stmt = $this->conn->prepare($sql);
     $stmt->execute();
     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

     return $result;

     }

     //display time in ago
      public function timeInAgo($timestamp){
         date_default_timezone_set("Africa/Blantyre");

         $timestamp = strtotime($timestamp) ? strtotime($timestamp) : $timestamp; 
         $time = time() - $timestamp;

         switch ($time) {
            //seconds
            case $time<=60:
               return 'Just Now';
            //minutes
            case $time>=60 && $time < 3600:
               return (round($time/60)==1) ? 'a minute ago' : round($time/60).' minutes ago';
            //hours
            case $time>=3600 && $time < 86400:
            return (round($time/3600)==1) ? 'an hour ago' : round($time/3600).' hours ago';

            //days
            case $time>=86400 && $time < 604800:
            return (round($time/86400)==1) ? 'a day ago': round($time/86400).' days ago'; 
            
            //weeks
            case $time>=604800 && $time < 2600640:
               return (round($time/604800)==1) ? 'a week ago' : round($time/604800).' weeks ago';

          //months
            case $time>=2600640 && $time < 31207680:
            return (round($time/2600640)==1) ? 'a month ago' : round($time/2600640).' months ago';

            //years
            case $time>=31207680:
            return (round($time/31207680)==1) ? 'a year ago' : round($time/31207680).' years ago'; 

         }
      }

      //remove notification
      public function removeNotification($id){
        $sql = "DELETE FROM notifications WHERE id = :id AND type = 'admin'";
       $stmt= $this->conn->prepare($sql);
      $stmt->execute(['id'=>$id]);

      return true; 
      }

       //fetch departmental requests
     public function fetchDepartmentalRequests($departmentName){
       $sql = "SELECT request.itemName, request.itemQuantity, request.itemQuality, request.createdAt, users.name, users.email, department.name FROM((request INNER JOIN users ON request.uid = users.id) INNER JOIN department ON request.departmentId=department.departmentId) WHERE departmentName = : departmentName";
     $stmt = $this->conn->prepare($sql);
     $stmt->execute(['departmentName'=>$departmentName]);
     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

     return $result;
     }

     //generate random password
     function generateRandomPassword($length,$count,$characters){
      $symbols =array();
      $password=array();
      $usedSymbols='';
      $pass = '';
      
      $symbols['lowerCase'] ="abcdefghijklmnopqrstuvwxyz";
      $symbols['upperCase'] = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
      $symbols['numbers'] = "0123456789";
      $symbols['specialSymbols'] = "!?-@#_+<>[]{}~";

      $characters = split(",", $characters);
      foreach ($characters as $key => $value) {
        $usedSymbols .=$symbols[$value];
      }
      $symbolsLength = strlen($usedSymbols) -1;
     
       
       for ($p=0; $p < $count; $p++) { 
         $pass = '';
         for ($i=0; $i < length ; $i++) { 
           $n = rand(0,$symbolsLength);
           $pass .= $usedSymbols[$n];
         }
         $passwords[] = $pass;
       }
       return json_encode($passwords);
    
  }

  //get password
  function getPassword(){
    $string = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@#";

    $result = substr(str_shuffle($string),0,6);

    echo $result;
  }
}

?>