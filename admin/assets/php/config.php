<?php
   class Database{
       
      const USERNAME = 'piliran@gmail.com';
      const PASSWORD = '1997pjaz';

   	private $dsn = "mysql:host=localhost;dbname=procure";
   	private $dbuser = "root";
   	private $dbpass = "";

   	public $conn;

   	public function __construct(){
   		try{
   			 $this->conn = new pdo($this->dsn,$this->dbuser,$this->dbpass);
   		
   		}
   		catch (PDOException $e ){
   			echo 'Error : ' .$e->getMessage();
   		}
   		  return $this->conn;
   	}

      //check input
      public function test_input($data){
         $data = trim($data);
         $data = stripslashes($data);
         $data = htmlspecialchars($data);
         return $data;
      }

      //Error success messae
      public function showMessage($type,$message){
         return '<div class=" alert alert-'.$type.'alert-dismissible">
         <button type="button" class="close" data-dismiss="alert">&times;</buton>
         <strong class="text-center">'.$message.'</strong>
         </div>';

      }
   }
 
?>