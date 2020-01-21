<?php
include '../database.php';
$email = $_GET['email'];
$password = $_GET['password'];
$stmt = $con->prepare("SELECT id,name,email,type from users where email = ? AND password = ?");
$stmt->bindParam(1, $email, PDO::PARAM_STR);
$stmt->bindParam(2, $password, PDO::PARAM_STR);
$stmt->execute();
if($stmt->rowCount() > 0)
{
	while ($row = $stmt->fetchObject()) 
	{
		echo json_encode($row);
	}
}
else
{
	$temp = array();
	$temp['error']=1;
	$temp['message'] = "Invalid login details";
	echo html_entity_decode(json_encode($temp));
}
?>