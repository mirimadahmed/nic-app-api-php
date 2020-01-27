<?php
include 'database.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    // if(isset($_GET['user_id']))
    // {
    
        $all_data = array();
    
        $stmt = $con->prepare('SELECT * from main');
    // 	$stmt->bindParam(1, $user_id, PDO::PARAM_INT);
    // 	$stmt->bindParam(2, $type, PDO::PARAM_STR);
    	$stmt->execute();
    	if ($stmt->rowCount() > 0) 
    	{
    		while($row = $stmt->fetchObject()) 
    		{
    		    
    		    $values = array();
    		    $stmt1 = $con->prepare('SELECT * from data where main_id = ?');
            	$stmt1->bindParam(1, $row->id, PDO::PARAM_INT);
            	$stmt1->execute();
            	if ($stmt1->rowCount() > 0) 
            	{
            		while($row1 = $stmt1->fetchObject()) 
            		{
    		            array_push($values,$row1);
            		}
            	}
            	$temp = array("emp_id"=>$row->emp_id, "station"=>$row->station, "asset_number"=>$row->asset_number, "vehicle_type"=>$row->vehicle_type,"checkList"=>$values);
            	array_push($all_data,$temp);
    		}
    	}
    echo json_encode($all_data);
}
else{
    $temp = array();
	$temp['error'] = 1;
	$temp['message']="Invalid request type";
	echo json_encode($temp);
}
    
    
?>