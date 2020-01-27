<?php
include 'database.php';
$email = $_GET['email'];
$password = $_GET['password'];
$type = "SuperAdmin12345__";
$stmt = $con->prepare("SELECT id from users where email = ? AND password = ? AND type = ?");
$stmt->bindParam(1, $email, PDO::PARAM_STR);
$stmt->bindParam(2, $password, PDO::PARAM_STR);
$stmt->bindParam(3, $type, PDO::PARAM_STR);
$stmt->execute();
if($stmt->rowCount() > 0)
{
	while ($row = $stmt->fetchObject()) 
	{
        $response = array();
        $response->error=0;
        echo json_encode($response);
		// echo json_encode($row);
	}
}
else
{
	$temp = array();
	$temp['error']=1;
	$temp['message'] = "Invalid login details";
	echo json_encode($temp);
}
?>