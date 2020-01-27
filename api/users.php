<?php
include 'database.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    // if(isset($_GET['user_id']))
    // {
    
        $users = array();
        $stmt = $con->prepare('SELECT id, name, email, type,picture, contact from users');
    // 	$stmt->bindParam(1, $_GET['emp_id'], PDO::PARAM_INT);
    // 	$stmt->bindParam(2, $password, PDO::PARAM_STR);
    	$stmt->execute();
    	if ($stmt->rowCount() > 0) 
    	{
    	    while($row = $stmt->fetchObject()) 
		    {
                array_push($users,$row);
		    }
    	}
    	echo json_encode($users);
}
else{
    $temp = array();
	$temp['error'] = 1;
	$temp['message']="Invalid request type";
	echo json_encode($temp);
}
    
    
?>