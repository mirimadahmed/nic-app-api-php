<?php
include '../database.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    $user_id = $_GET['user_id'];
    $startup_id = $_GET['startup_id'];

    $stmt = $con->prepare('SELECT * from favorites where startup_id = ? AND user_id = ? ');
    $stmt->bindParam(1, $startup_id, PDO::PARAM_INT);
    $stmt->bindParam(2, $user_id, PDO::PARAM_INT);
	$stmt->execute();
	if ($stmt->rowCount() <= 0) 
	{
	    $stmt = $con->prepare('insert into favorites(startup_id,user_id) VALUES(?,?)');
        $stmt->bindParam(1, $startup_id, PDO::PARAM_INT);
        $stmt->bindParam(2, $user_id, PDO::PARAM_INT);
        $stmt->execute();
        
        $temp = array();
    	$temp['error'] = 0;
    	$temp['message']="Added to favorite";
    	echo json_encode($temp);
	}
	else{
	    $temp = array();
    	$temp['error'] = 1;
    	$temp['message']="Already Favorite";
    	echo json_encode($temp);   
	}

}
else
{
    $temp = array();
	$temp['error'] = 1;
	$temp['message']="Invalid request type";
	echo json_encode($temp);
}
        
?>