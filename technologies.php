<?php
include 'database.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    // if(isset($_GET['user_id']))
    // {
    
        $technologies = array();
        $stmt = $con->prepare('SELECT * from technologies');
    // 	$stmt->bindParam(1, $_GET['emp_id'], PDO::PARAM_INT);
    // 	$stmt->bindParam(2, $password, PDO::PARAM_STR);
    	$stmt->execute();
    	if ($stmt->rowCount() > 0) 
    	{
    	    while($row = $stmt->fetchObject()) 
		    {
                array_push($technologies,$row);
		    }
    	}
    	echo json_encode($technologies);
}
else{
    $temp = array();
	$temp['error'] = 1;
	$temp['message']="Invalid request type";
	echo json_encode($temp);
}
    
    
?>