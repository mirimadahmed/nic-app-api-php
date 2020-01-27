<?php
include '../database.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        
        $user_id = $_GET['user_id'];
        $startup_id = $_GET['startup_id'];
    
	    $stmt = $con->prepare('delete from favorites where user_id = ? AND startup_id = ?');
        $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
        $stmt->bindParam(2, $startup_id, PDO::PARAM_INT);
        $stmt->execute();
        
        $temp = array();
    	$temp['error'] = 0;
    	$temp['message']="Removed from favorites";
    	echo json_encode($temp);
}
else
{
    $temp = array();
	$temp['error'] = 1;
	$temp['message']="Invalid request type";
	echo json_encode($temp);
}
        
?>