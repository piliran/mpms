<?php

//insert.php

$connect = new PDO("mysql:host=localhost;dbname=procurement", "root", "");

$query = "
INSERT INTO request 
(itemName, description) 
VALUES (:first_name, :last_name)
";

for($count = 0; $count<count($_POST['hidden_first_name']); $count++)
{
	$data = array(
		':first_name'	=>	$_POST['hidden_first_name'][$count],
		':last_name'	=>	$_POST['hidden_last_name'][$count]
	);
	$statement = $connect->prepare($query);
	$statement->execute($data);
}

?>